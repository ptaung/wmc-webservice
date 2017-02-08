<?php

namespace app\modules\webclient\components;

use linslin\yii2\curl;
use Yii;

#use app\models\Chospital;

class Cwebclient {
    /*
      ดึงข้อมูลตาราง T จาก HDC
     */

    public static function getDataHdc($table, $hospcode, $areacode = '') {
        if ($areacode == '')
            $areacode = Yii::$app->params['ampcode'];
        //Load items from webservice
        $link = Yii::$app->params['wsDataHdcUrl'] . '/transdata/data';

        //Init curl
        $curl = new curl\Curl();
        $response = $curl->setOption(
                        CURLOPT_POSTFIELDS, http_build_query(
                                [
                                    'param' => [
                                        'hoscode' => Yii::$app->params['codebase'],
                                        'hospcode' => $hospcode, #หน่วยบริการ
                                        'table' => $table, #ชื่อตารางที่ต้องการ
                                        'areacode' => $areacode, #ชื่อตารางที่ต้องการ
                                    ]
                                ]
                ))
                ->setOption(CURLOPT_USERPWD, Yii::$app->params['wsUsername'] . ":" . Yii::$app->params['wsPassword'])
                ->setOption(CURLOPT_ENCODING, 'gzip')
                ->setOption(CURLOPT_TIMEOUT, 300)
                ->post($link);
        #if ($table === NULL) {
        return $ref = json_decode($response, TRUE);
        #} else {
        #return $ref['data'][0];
        #}
    }

//วันที่
    public static function getThaiDate($scode, $rtype = 'S', $showtime = '') {
        $thaimtS = array('00' => '', '01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค.', '04' => 'เม.ย.', '05' => 'พ.ค.', "06" => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.');
        $thaimtL = array('00' => '', '01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

        if (empty($scode)) {
            return '';
        }
        $day = (integer) substr($scode, 8, 2);
        $mt = substr($scode, 5, 2);
        $time = substr($scode, 10, 12);
        $year = (integer) substr($scode, 0, 4) + 543;
        if (strtoupper($rtype) == 'L') {
            $tmt = $thaimtL;
            return $day . ' ' . $tmt[$mt] . ' ' . $year . ' : ' . ($showtime <> '' ? $time : '');
        } else {
            $tmt = $thaimtS;
            return $day . ' ' . $tmt[$mt] . ' ' . substr($year, 2, 4) . ' ' . ($showtime <> '' ? $time : '');
        }
    }

    public static function getReportSerive($item_id = NULL, $item_gid = NULL, $search = NULL, $link = NULL) {
        //Load items from webservice
        if (is_null($link)) {
            $link = \Yii::$app->params['webserviceUrl'] . '/report/items';
        } else {
            $link = 'http://127.0.0.1/wmc/web/index.php/report/items';
        }

        //Init curl
        $curl = new curl\Curl();
        $response = $curl->setOption(
                        CURLOPT_POSTFIELDS, http_build_query(
                                [
                                    'param' => [
                                        'hoscode' => Yii::$app->params['codebase'],
                                        'item_id' => $item_id,
                                        'item_gid' => $item_gid,
                                        'search' => $search
                                    ]
                                ]
                ))
                ->setOption(CURLOPT_USERPWD, Yii::$app->params['cusername'] . ":" . Yii::$app->params['cpassword'])
                ->setOption(CURLOPT_ENCODING, 'gzip')
                ->post($link);
        $ref = json_decode($response, TRUE);

        if ($item_id === NULL) {
            return $ref;
        } else {
            return $ref['data'][0];
        }
    }

//แสดงผลข้อมูล EPI
    public static function thaiformat($data, $epi, $label = '') {
        $data = explode(',', $data);
        $ref = '';
        if (count($data) > 0) {

            foreach ($data as $value) {
                list($hospcode, $thaidate, $etc, $place) = explode('|', $value);

                if ($etc == 'elsewhere') {
                    $ss = $place;
                    if (empty($place))
                        $place = 'ไม่ระบุ';
                    $etc = 'รับที่อื่น <b>[' . $place . ']</b>';
                    $color = 'info';
                } else {
                    $etc = 'ให้บริการ';
                    $color = 'success';
                }


                if ($epi == 0)
                    $color = 'warning';

                if (!empty($hospcode)) {
                    #$ref .= Cwebclient::getThaiDate($thaidate) . '| ' . $hospcode . '<br>' . $hospcode . ' ' . $etc . '<hr>';


                    $ref .= '<div class="list-group-item list-group-item-' . $color . '">';
                    $ref .= '<h5 class="list-group-item-heading" style="white-space: nowrap;">';
                    $ref .= ' <i>[' . $label . ']</i> ' . Cwebclient::getThaiDate($thaidate);
                    $ref .= '</h5>';
                    $ref .='<p class="list-group-item-text small">';
                    $ref .= $hospcode . ' ' . $etc;
                    $ref .= '</p>';
                    $ref .= '</div>';
                }
            }
            return $ref;
        } else {
            return $ref;
        }
    }

    //แสดงผลข้อมูล EPI
    public static function displayEpi($data, $epi) {
        if ($data[$epi] > 0) {
            if ($data['c_' . $epi] == 0) {
                $color = 'info';
            } else {
                $color = 'success';
            }
            $message = $message . Cwebclient::thaiformat($data['d_' . $epi], $data['c_' . $epi], $epi);
            #$message = '<div class="btn btn-xs btn-' . $color . '">' . $message . '</div>';
        } else {
            $message = '<div class="btn btn-xs btn-default">ยังไม่ได้รับ  <i>[' . $epi . ']</i></div>';
            $color = 'default';
        }

        #return "<div class='btn-group'>{$message}</div>";

        return '<div class="bs-example small" data-example-id="list-group-custom-content">
            <div class="list-group">
            ' . $message . '
            </div> </div>';
    }

    public static function displayAnc($data, $index, $check = null) {
        if (!empty($data[$index])) {
            if (empty($data[$index])) {
                $color = 'info';
            } else {
                $color = 'success';
            }
            $message = $message . Cwebclient::displayAncFormat($data[$index], $check);
        } else {
            if (empty($check)) {
                $message = '<div class="btn btn-xs btn-default">ยังไม่ได้รับ</div>';
                $color = 'default';
            }
        }

        return '<div class="bs-example small" data-example-id="list-group-custom-content">
            <div class="list-group">
            ' . $message . '
            </div> </div>';
    }

//แสดงผลข้อมูล ANC
    public static function displayAncFormat($data, $check = null) {
        $date = explode(',', $data);
        $ref = '';

        if (count($date) > 0) {

            foreach ($date as $key => $value) {
                list($hospcode, $thaidate, $etc, $place) = explode('|', $value);

                if ($etc == 'other_precare') {
                    if (empty($place))
                        $place = 'ไม่ระบุ';
                    $etc = 'รับที่อื่น <b>[' . $place . ']</b>';
                    $color = 'info';
                } else {
                    $etc = 'ให้บริการ';
                    $color = 'success';
                }


                if (!empty($check)) {
                    $color = 'danger';
                    $message = '<br>จำนวนวันให้บริการหลังคลอด' . $place . ' วัน';
                }

                if (!empty($hospcode)) {
                    $ref .= '<div class="list-group-item list-group-item-' . $color . '">';
                    $ref .= '<h5 class="list-group-item-heading" style="white-space: nowrap;">';
                    $ref .= Cwebclient::getThaiDate($thaidate);
                    $ref .= '</h5>';
                    $ref .='<p class="list-group-item-text small">';
                    $ref .= $hospcode . ' ' . $etc . @$message;
                    $ref .= '</p>';
                    $ref .= '</div>';
                }
            }
            return $ref;
        } else {
            return $ref;
        }
    }

    //แสดงผลข้อมูล ANC
    public static function displayAncPlaceFormat($data) {
        $date = explode(',', $data);
        $ref = '';
        if (count($date) > 0) {
            foreach ($date as $key => $value) {
                list($hospcode, $thaidate) = explode('|', $value);

                $color = 'default';
                if (!empty($hospcode)) {
                    $ref .= '<div class="list-group-item list-group-item-' . $color . '">';
                    $ref .= '<h5 class="list-group-item-heading" style="white-space: nowrap;">';
                    $ref .= Cwebclient::getThaiDate($thaidate);
                    $ref .= '</h5>';
                    $ref .='<p class="list-group-item-text small">';
                    $ref .= Cwebclient::getHoscode($hospcode);
                    $ref .= '</p>';
                    $ref .= '</div>';
                }
            }

            return '<div class="bs-example small" data-example-id="list-group-custom-content">
            <div class="list-group">
            ' . $ref . '
            </div> </div>';
        } else {
            return '';
        }
    }

    //แสดงผลข้อมูล ANC
    public static function displayAncLaborPlaceFormat($data) {
        $date = explode(',', $data);
        $ref = '';
        if (count($date) > 0) {
            foreach ($date as $key => $value) {
                list($hospcode, $thaidate, $regplace) = explode('|', $value);

                $color = 'default';
                if (!empty($hospcode)) {
                    $ref .= '<div class="list-group-item list-group-item-' . $color . '">';
                    $ref .= '<h5 class="list-group-item-heading" style="white-space: nowrap;">';
                    $ref .= Cwebclient::getThaiDate($thaidate);
                    $ref .= '</h5>';
                    $ref .='<p class="list-group-item-text small">';
                    $ref .= Cwebclient::getHoscode($hospcode);
                    $ref .= '</p>';
                    $ref .='<p class="list-group-item-text small">INPUT-';
                    $ref .= $regplace;
                    $ref .= '</p>';
                    $ref .= '</div>';
                }
            }

            return '<div class="bs-example small" data-example-id="list-group-custom-content">
            <div class="list-group">
            ' . $ref . '
            </div> </div>';
        } else {
            return '';
        }
    }

    public static function getHoscode($data) {
        $sql = "SELECT
                    concat(hoscode,' ',hosname) as hname
                    FROM chospital
                    WHERE hoscode='{$data}'";
        try {
            $data = Yii::$app->db_datacenter->createCommand($sql)->cache(3600)->queryOne();
        } catch (\Exception $exc) {
            $data = [];
        }
        #$model = Chospital::findOne($data);
        #$model = Yii::$app->db->cache(function ($db) {
        #return Chospital::findOne($data);
        #});

        return $data['hname'];
    }

}
