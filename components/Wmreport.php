<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
#ini_set("soap.wsdl_cache_enabled", 0);
include_once( Yii::getPathOfAlias('ext.nusoap.nusoap') . '.php' );

class Wmreport extends Report {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column_report';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    // report name
    public function getReportName() {
        return '';
    }

    // comment
    public function getReportComment() {
        $text = "";
        return $text;
    }

    // Filter Report
    public function getFilterReport() {
        return array();
    }

    // Credit
    public function getReportCredit() {
        $text = "SilasoftThailand.com";
        return $text;
    }

    //ชื่อรายงาน
    public $reportInfo = array();
    //ชื่อรายงาน
    public $reportOption = array(
        'viewdetail' => true
    );

    /*
     * แสดงรายการใน Controller ของ Module
     */

    public function getReportListModule($rpt_source = array()) {
        $array_report = array();
        //อ่าน Controller แบบอัตโนมัติ

        foreach (glob('./protected/modules/' . $rpt_source . '/controllers/*.php') as $full_name) {
            $class_name = pathinfo($full_name, PATHINFO_FILENAME);
            # ชื่อ Router url
            $controller_name = str_replace('Controller', '', $class_name);

            if (!class_exists($class_name, false))
                require($full_name);

            if (!class_exists($class_name, false) || !is_subclass_of($class_name, 'Wmreport'))
                continue;

            if (!method_exists($class_name, 'getReportName'))
                continue;
            else
                $getReportName = @call_user_func(array($class_name, 'getReportName'));

            if (!method_exists($class_name, 'getReportName') || trim($getReportName) == '')
                continue;

            if (!method_exists($class_name, 'getReportComment'))
                continue;
            else
                $getReportComment = @call_user_func(array($class_name, 'getReportComment'));

            if (!method_exists($class_name, 'getReportComment') || trim($getReportComment) == '')
                continue;

# ชื่อรายงาน
            $array_report[$controller_name]['title'] = $getReportName;
            $array_report[$controller_name]['comment'] = $getReportComment;

            //md5_file เพื่อตรวจสอบ files
            $array_report[$controller_name]['md5_client'] = md5_file($full_name);
            $array_report[$controller_name]['update_client'] = filemtime($full_name);
            $array_report[$controller_name]['controller'] = $controller_name;
        }

        //ตรวจสอบ update จาก SilasoftThailand.com
        //$checkUpdate = @Wmreport::wmCheckUpdate($rpt_source);
//รวม Array เพื่อตรวจสอบการ Update
        //if (count($checkUpdate) > 0)
        //$array_report = Report::array_replace_recursive($checkUpdate, $array_report);
        return $array_report;
    }

    /*
     * แสดงรายการใน Module
     */

    public static function getModuleList($name = '*') {
        $array_module = array();
        foreach (glob('./protected/modules/' . $name) as $module_fullname) {
            $module = str_replace('./protected/modules/', '', $module_fullname);
            if ($module == 'rights' || $module == 'wmupdate')
                continue;

            if (Yii::app()->hasComponent($module))
                continue;

            //if (Yii::app()->hasModule($module))
            //continue;

            foreach (glob($module_fullname . '/*.php') as $filename) {

                //นำเข้าเพื่อใช้เป็น Menu
                require_once($filename);
                $class_name = pathinfo($filename, PATHINFO_FILENAME);
                $module_name = str_replace('.php', '', $filename); # ชื่อ Module

                if (!method_exists($class_name, 'getTitleName'))
                    continue;
                else
                    $getTitleName = @call_user_func(array($class_name, 'getTitleName'));

                $array_module[$module]['title'] = $getTitleName;
                $array_module[$module]['update_client'] = date('F d Y H:i:s.', filemtime($filename));
                $array_module[$module]['module'] = $module;


                $array_module[$module]['hasModule'] = '1';
            }
        }
//ตรวจสอบ update จาก SilasoftThailand.com
        //$checkUpdate = @Wmreport::wmCheckUpdateModule();
//รวม Array เพื่อตรวจสอบการ Update
        //if (count($checkUpdate) > 0)
        //$array_module = Report::array_replace_recursive($checkUpdate, $array_module);

        return $array_module;
    }

//ตรวจสอบมาใหม่
    public function wmCheckUpdate($rpt_source = '') {

        $client = new nusoap_client(Yii::app()->params['url_webservice'] . "/app/index.php/wmupdate/update/report", false);
        $client->setHTTPEncoding('deflate, gzip');
        $client->response_timeout = 5;
        $return = $client->call('report', array(
            'module' => $rpt_source,
            'secretkey' => Yii::app()->params['secretkey'],
            'username' => Yii::app()->params['webservice_username'],
            'password' => Yii::app()->params['webservice_password'],
        ));

        if (!$client->getError()) {
            $return = base64_decode($return);
            $return = unserialize($return);
        } else {
            $return = array(); #$client;
        }

        return $return;
    }

    //ตรวจสอบมาใหม่
    public function wmCheckUpdateModule() {

        $client = new nusoap_client(Yii::app()->params['url_webservice'] . "/app/index.php/wmupdate/update/update", false);
        $client->setHTTPEncoding('deflate, gzip');
        $client->response_timeout = 5;
        $return = $client->call('update', array(
            'module' => '',
            'secretkey' => Yii::app()->params['secretkey'],
            'username' => Yii::app()->params['webservice_username'],
            'password' => Yii::app()->params['webservice_password'],
        ));

        if (!$client->getError()) {
            $return = base64_decode($return);
            $return = unserialize($return);
        } else {
            $return = array();
        }

        return $return;
    }

}
