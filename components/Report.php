<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Report extends Controller {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @var string
     */
    public $prefixDbName = 'dw_';

    /**
     * @var string
     */
    public $dbSource = '';

    /**
     * @var int
     */
    public $pageSize = 100;

    /**
     * @var string
     */
    public $dbName = '';

    /**
     * @set dbSource for report center
     */
    public function init() {

        try {
            //ปรับ mode การทำงาน
            switch (Yii::app()->params['wmsystem_mode']) {
                case 'client' :
                    $this->dbSource = Yii::app()->db;
                    $this->prefixDbName = Yii::app()->params['db_db'];
                    break;
                case 'hospital' :
                    $this->dbSource = Yii::app()->db;
                    $this->prefixDbName = Yii::app()->params['db_db'];
                    break;
                case 'server' :
                    $this->dbSource = Yii::app()->dbReport;
                    $this->prefixDbName = Yii::app()->params['prefix_wm'];
                    break;
            }
        } catch (CDbException $exc) {
            throw new CHttpException(2003, $exc->getMessage());
        }
    }

    /**
     * @param string
     */
    public function setPrefixNodeDB($dbselect) {

        switch (Yii::app()->params['wmsystem_mode']) {
            case 'client' :
                $this->dbName = Yii::app()->params['db_db'];
                break;
            case 'server' :
                $this->dbName = $this->prefixDbName . $dbselect;
                break;
        }
    }

    public function getDetailMenu($id) {
        $model = MenuWm::model()->with('menu_wm_subgroup', 'menu_wm_group')->findByPk($id);
        return $model;
    }

    /**
     * @param string
     * @param int $timeCache
     * @param object $db
     * @return array
     */
    public function getDataCeche($sqlQueryString, $timeCache = 60, $db = '') {
        $_dataceche = Yii::app()->cache->get(md5($sqlQueryString));
        if ($_dataceche === false) {
            try {
                if ($db == '')
                    $db = $this->dbSource;

                $result = $db->createCommand($sqlQueryString)->queryAll();
                Yii::app()->cache->set(md5($sqlQueryString), $result, $timeCache, new CFileCacheDependency(md5($sqlQueryString)));
                $_dataceche = Yii::app()->cache->get(md5($sqlQueryString));
            } catch (CDbException $e) {
                if (Yii::app()->params['database_debug'])
                    throw new CHttpException($e->getCode(), "SQL-ERROR กรุณาติดต่อ " . $e->getMessage()); //$e->getMessage()
                else
                    throw new CHttpException($e->getCode(), "SQL-ERROR กรุณาติดต่อ " . Yii::app()->params['adminEmail']); //$e->getMessage()
            }
        }
        return $_dataceche;
    }

    /**
     * @return array
     * loop ข้อมูลตามหน่วยบริการ แล้วรวมเป็นอำเภอและหน่วยบริการ
     */
    public function manageArray($fieldGroup = '') {
        $arr = array();
        $arrcup = array();
        $arrcup_cup = array();
        $arrcup_hos = array();
        $amplist = array();
        $arrForDataProvider = array();
        $r = array();
        $dataAll = array();
        if (isset($_POST['cup_hospcode'])) {

            $listHospcode = TeerapatFunction::getListHospcode(@$_POST['viewMode'], @$_POST['cup_hospcode'], @$_POST['pcu_code']);
            $returnAll = array();
            foreach ($listHospcode as $index) { // Loop รายหน่วยบริการ
                $result = $this->callDataQuery($index['hospcode']);

                foreach ((array) $result as $idx => $datafield) { // Loop รายงาน
                    foreach ($datafield as $field => $fieldvalue) {
                        @$arrcup[$field][$index['hospcode_cup']] += $datafield[$field];
                        if ($index['hospcode_cup'] == $index['hospcode'])
                            @$arrcup_hos[$field][$index['hospcode_cup']] += $datafield[$field]; //แยก รพ. สสอ.

                        if ($index['hospcode_cup'] <> $index['hospcode'])
                            @$arrcup_cup[$field][$index['hospcode_cup']] += $datafield[$field]; //แยก รพ. สสอ.

                        $r[$field] = $datafield[$field]; //เพิ่มข้อมูลในแต่ละหน้วยบริการ 

                        if ($fieldGroup <> '') {//ต้องการจัดกลุ่มข้อมูล
                            @$returnAll[$datafield[$fieldGroup]][$field] += $datafield[$field]; //เพิ่มข้อมูลในแต่ละหน้วยบริการทั้งหมด   
                        } else {
                            $returnAll[$idx][$field] = $datafield[$field]; //เพิ่มข้อมูลในแต่ละหน้วยบริการทั้งหมด 
                        }
                    }

                    $r['hospcode'] = $index['hospcode'];
                    $r['hospname'] = $index['hospname'];
                }
                $arrForDataProvider[] = $r;
                $dataAll = array_merge($dataAll, $returnAll);
            }
        }
        return array($arrForDataProvider, $arrcup, $arrcup_hos, $arrcup_cup, $dataAll);
    }

    public function array_replace_recursive($array, $array1) {
// handle the arguments, merge one by one
        $args = func_get_args();
        $array = $args[0];
        if (!is_array($array)) {
            return $array;
        }
        for ($i = 1; $i < count($args); $i++) {
            if (is_array($args[$i])) {
                $array = Report::recurse($array, $args[$i]);
            }
        }
        return $array;
    }

    public function recurse($array, $array1) {
        foreach ($array1 as $key => $value) {
// create new key in $array, if it is empty or not an array
            if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key]))) {
                $array[$key] = array();
            }

// overwrite the value in the base array
            if (is_array($value)) {
                $value = Report::recurse($array[$key], $value);
            }
            $array[$key] = $value;
        }
        return $array;
    }

//คืนค่าหน่วยบริการที่รับผิดชอบ
    public function getHospcode() {

        $sqlQuery = "select a.*,b.name as hname from pcu_hos_allow a,hospcode b where a.hospcode = b.hospcode order by a.hospcode asc;";
        return $result = $this->getDataCeche($sqlQuery, 3600);
    }

}
