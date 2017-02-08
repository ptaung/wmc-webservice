<?php

namespace app\components;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TeerapatFunction {

    public function getThaimonth() {
        return;
    }

    public static function getHospName($id = NULL) {
        switch (Yii::app()->params['wmsystem_mode']) {
            case 'client' :
                $db = yii::app()->db;
                $sql = "select hospitalcode as hospcode,hospitalname as hospname,'' as hospcode_cup from opdconfig;";
                break;
            case 'hospital' :
                $db = yii::app()->db;
                $sql = "select hospitalcode as hospcode,hospitalname as hospname,'' as hospcode_cup from opdconfig;";
                break;
            case 'server' :
                $db = yii::app()->dbReport;
                break;
        }

        $sql = "select name as hospname from hospcode where hospcode ='" . $id . "';";
        $result = $db->createCommand($sql)->queryRow();
        return $result['hospname'];
    }

    public function level_userid() {
        $level_userid = "staff==ผู้ดูแลระบบ;ssj==ระดับ สสจ.;sso==ระดับ สสอ.;so==ระดับ รพ.สต.;hos==ระดับ รพ.";
    }

    public static function getListHospcode($viewMode = array(), $cup_hospcode = '', $pcu_code = '') {

        switch (Yii::app()->params['wmsystem_mode']) {
            case 'client' :
                $db = yii::app()->db;
                $sql = "select hospitalcode as hospcode,hospitalname as hospname,'' as hospcode_cup from opdconfig;";

                break;
            case 'hospital' :
                $db = yii::app()->db;
                $sql = "select hospitalcode as hospcode,hospitalname as hospname,'' as hospcode_cup from opdconfig;";

                break;
            case 'server' :
                $db = yii::app()->dbReport;
                $filterSQL = '';
                if ($cup_hospcode <> '' && $pcu_code == '')
                    $filterSQL .= "and pha.hospcode_amp = '{$cup_hospcode}' ";

                if ($cup_hospcode <> '' && $pcu_code <> '')
                    $filterSQL .= "and pha.hospcode = '{$pcu_code}' ";

                if (in_array('pcu', (array) $viewMode) && in_array('hos', (array) $viewMode)) {
                    $view = '';
                } elseif (in_array('pcu', (array) $viewMode)) {
                    $view = 'and pha.hospcode <> pha.hospcode_cup ';
                } elseif (in_array('hos', (array) $viewMode)) {
                    $view = 'and pha.hospcode = pha.hospcode_cup ';
                } else {
                    $view = '';
                }

                $sql = "select pha.hospcode ,concat(h.hosptype,h.name) as hospname,pha.hospcode_cup
            from pcu_hos_allow pha
            left join  hospcode h on pha.hospcode = h.hospcode
            where 1=1
            {$view}{$filterSQL}
            order by pha.hospcode asc";
                break;
        }



        $result = $db->createCommand($sql)->queryAll();
        return $result;
    }

    public static function getUserOnline() {
        $db = yii::app()->dbReport;
        $sql = "SELECT * FROM useronline";
        $result = $db->createCommand($sql)->queryAll();
        return $result;
    }

    public static function getWmOnline() {
        $db = yii::app()->dbService;
        $sql = "SELECT * FROM hospital_base_status";
        $result = $db->createCommand($sql)->queryAll();
        return $result;
    }

    public static function getWmNode() {
        $db = yii::app()->dbService;
        $sql = "SELECT * FROM hospital_base_status";
        $result = $db->createCommand($sql)->queryAll();
        return $result;
    }

    public static function getWmEtlOnline() {
        $db = yii::app()->dbService;
        $sql = "SELECT
                concat(hc.hospcode,' ',hc.name) as hname
                ,h1.hbs_time
                ,if(TIMEDIFF(NOW(),h1.hbs_time) <= 300,1,0) as etl
                FROM hospital_base_status h1
                LEFT OUTER JOIN pcu_hos_allow h2 ON h1.hbs_hospital_id = h2.hospcode
                LEFT OUTER JOIN hospcode hc ON hc.hospcode = h1.hbs_hospital_id
                #WHERE TIMEDIFF(NOW(),h1.hbs_time) < 300
                ORDER BY hbs_time DESC
                ";
        $result = $db->createCommand($sql)->queryAll();
        return $result;
    }

    public static function getNewRegis() {
        $db = yii::app()->dbReport;
        $sql = "SELECT COUNT(*) AS cc
		FROM userWebservice uws
		LEFT OUTER JOIN  hospcode hc ON hc.hospcode = uws.department_id
		LEFT OUTER JOIN  pcu_hos_allow pha ON pha.hospcode = uws.department_id
		WHERE (uws.user_status <>'Y' OR uws.user_status IS NULL )
		#AND hc.amppart = ''
		AND (pha.hospcode <> pha.hospcode_cup OR pha.hospcode IS NULL)";
        $result = $db->createCommand($sql)->queryAll();
        return $result;
    }

    public static function getEtlOnline() {
        $db = yii::app()->dbReport;
        $sql = "SELECT d.last_etl_active
                FROM " . Yii::app()->params['db_datacenter'] . ".dw_hospcode_allow d
                LEFT OUTER JOIN " . Yii::app()->params['db_datacenter'] . ".online_etl e ON e.hospcode = d.hospcode
                WHERE TIMEDIFF(NOW(),d.last_etl_active) < 300";
        $result = $db->createCommand($sql)->queryAll();
        return $result;
    }

    public function getReferOnline() {
        $db = yii::app()->dbReport;
        $sql = "SELECT refer.hospcode,IF(refer.online_datetime IS NOT NULL,'online','offline') AS status_refer
                FROM " . Yii::app()->params['db_wm'] . ".pcu_hos_allow pha
                LEFT OUTER JOIN (SELECT r.online_datetime,r.hospcode FROM " . Yii::app()->params['db_refer'] . ".refer_center_online r WHERE TIMEDIFF(NOW(),r.online_datetime) < 300) AS refer ON pha.hospcode = refer.hospcode
                WHERE pha.hospcode = pha.hospcode_cup AND refer.hospcode IS NOT NULL";
        $result = $db->createCommand($sql)->queryAll();
        return $result;
    }

    public function getListMenu() {
        $dataProvider = MenuWmGroup::model()->findAll();
        return $dataProvider;
    }

    public static function getListAmp() {

        if (Yii::app()->params['wmsystem_mode'] == 'server') {
            try {
                $db = yii::app()->dbReport;
                $sql = "select pha.hospcode_amp,h.hospcode ," . (Yii::app()->params['viewMode'] == 'amp' ? "concat('อ.',t2.name)" : "concat(h.hosptype,' ',h.name)") . " as hosname
                        from hospcode h
                        inner join pcu_hos_allow pha on pha.hospcode = h.hospcode
                        left outer join thaiaddress t1 on t1.chwpart = h.chwpart and t1.codetype='1'
                        left outer join thaiaddress t2 on t2.chwpart = h.chwpart and t2.amppart = h.amppart and t2.codetype = '2'
                        where pha.hospcode = pha.hospcode_cup order by pha.hospcode_amp asc";
                $result = $db->createCommand($sql)->queryAll();
            } catch (CDbException $exc) {
                throw new CHttpException(2003, $exc->getMessage());
            }

            /*
              } catch (Exception $e) {
              //echo $e->getMessage();
              $result = array();
              }
             *
             */
        } else {
            $result = array();
        }

        return $result;
    }

    public function getListPcu($id) {

        $db = yii::app()->dbReport;

        if ($id <> '') {
            $_hospcodeLookup = " where pha.hospcode_amp = '" . $id . "' ";
        } else {
            $_hospcodeLookup = "";
        }

        $sql = "select  h.hospcode ,concat(h.hospcode,' ',h.hosptype,' ',h.name) as hosname,hospcode_amp,if(pha.hospcode=pha.hospcode_cup,0,1) as c,h.hosptype from hospcode h INNER JOIN pcu_hos_allow pha ON h.hospcode = pha.hospcode {$_hospcodeLookup}  order by c asc ,h.hospcode asc";
        $result = $db->createCommand($sql)->queryAll();
        $list = CHtml::ListData($result, 'hospcode', 'hosname', 'hosptype');
        header('Content-Type: text/html; charset=utf-8');
        echo CHtml::dropDownList('pcu_code', (isset($_POST['pcu_code']) ? $_POST['pcu_code'] : null), $list, array('empty' => 'เลือกทุกสถานบริการ', 'size' => 'small'));
    }

    public function getColumnList($table) {
        try {
            $db = yii::app()->db;
            $sql = "SHOW COLUMNS FROM " . $table;
            $result = $db->createCommand($sql)->queryAll();
            $result = CHtml::listData($result, 'Field', 'Field');
        } catch (Exception $exc) {
            $result = array();
        }

        return $result;
    }

    //เข้ารหัสข้อมูล
    public function generalKey($string) {
        $encryptedString = Yii::app()->encrypter->encrypt($string);
        return $encryptedString;
    }

    // format file size
    public static function formatBytes($bytes, $force_unit = NULL, $format = NULL, $si = TRUE) {
        // Format string
        $format = ($format === NULL) ? '%01.2f %s' : (string) $format;

        // IEC prefixes (binary)
        if ($si == FALSE OR strpos($force_unit, 'i') !== FALSE) {
            $units = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
            $mod = 1024;
        }
        // SI prefixes (decimal)
        else {
            $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
            $mod = 1000;
        }

        // Determine unit to use
        if (($power = array_search((string) $force_unit, $units)) === FALSE) {
            $power = ($bytes > 0) ? floor(log($bytes, $mod)) : 0;
        }

        return sprintf($format, $bytes / pow($mod, $power), $units[$power]);
    }

    public static function explodeString($str) {
        $servicePlace = explode('|', $str);
        $res = '';
        foreach ($servicePlace as $data) {
            $res .= $data . '<br>';
        }
        $res = rtrim($res, '<br>');
        return $res;
    }

    //update รหัสพิกัดจาก สนย.
    #public static function updateGis() {
    #}
}
