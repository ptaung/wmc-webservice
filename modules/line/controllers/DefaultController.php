<?php

namespace app\modules\line\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use yii\httpclient\Client;
use app\modules\line\components\lineBot;

class DefaultController extends Controller {

    public function actionIndex() {
        $sql = "SELECT
                    ampurname as n
                    ,group_concat(distinct if(result10 = 0,hospcode,'') order by hospcode asc) as m10
                    ,group_concat(distinct if(result11 = 0,hospcode,'') order by hospcode asc) as m11
                    ,group_concat(distinct if(result12 = 0,hospcode,'') order by hospcode asc) as m12
                    ,group_concat(distinct if(result01 = 0,hospcode,'') order by hospcode asc) as m01
                    ,group_concat(distinct if(result02 = 0,hospcode,'') order by hospcode asc) as m02
                    ,group_concat(distinct if(result03 = 0,hospcode,'') order by hospcode asc) as m03
                    ,group_concat(distinct if(result04 = 0,hospcode,'') order by hospcode asc) as m04
                    ,group_concat(distinct if(result05 = 0,hospcode,'') order by hospcode asc) as m05
                    ,group_concat(distinct if(result06 = 0,hospcode,'') order by hospcode asc) as m06
                    ,group_concat(distinct if(result07 = 0,hospcode,'') order by hospcode asc) as m07
                    ,group_concat(distinct if(result08 = 0,hospcode,'') order by hospcode asc) as m08
                    ,group_concat(distinct if(result09 = 0,hospcode,'') order by hospcode asc) as m09
FROM
    s_monitor s
    LEFT JOIN chospital h ON h.hoscode = s.hospcode
    LEFT JOIN campur a ON a.ampurcodefull = concat(provcode,distcode)
WHERE
    b_year = (SELECT yearprocess+543 FROM sys_config LIMIT 1) AND tb = 'service'
    and (result10 = 0
    or result11 = 0
    or result12 = 0
    or result01 = 0
    or result02 = 0
    or result03 = 0
    or result04 = 0
    or result05 = 0
    or result06 = 0
    or result07 = 0
    or result08 = 0
    or result09 = 0
    )
    group by h.distcode asc
";
        $hdata = \Yii::$app->db_hdc->createCommand($sql)->queryAll();
        $mdata = [ '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม', '01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน'];
        $mess = '';
        foreach ($mdata as $key => $value) {
            $no = 0;
            $mess_hospcode = '';
            foreach ($hdata as $rows) {
                $cc2 = explode(',', $rows['m' . $key]);
                if (count($cc2) > 1) {
                    $mess_hospcode .= $rows['n'] . '[' . $rows['m' . $key] . ']' . "\n";
                    ++$no;
                }
            }

            if ($no > 0)
                $mess .= '***เดือน' . $value . "***\n" . $mess_hospcode;

            if ($key == date('m'))
                break;
        }

        $linebot = new lineBot();
        $link = "http://spb.hdc.moph.go.th/hdc/reports/m_report.php?source=s_monitor/monitor_service_send.php";
        $message = "ติดตามการรับส่งข้อมูล HDC ล่าช้า \n$mess \nให้รีบดำเนินการด่วน ! ค่ะ ตาม LINK นี้เลยค่ะ $link";
        $linebot->send($message);
    }

}
