<?php

class Ucolumn {

    public static function getColumnMenu() {
        //Load ข้อมูลสถานะเจ้าหน้าที่
        $staff = (isset(Yii::app()->user->level_userid) ? Yii::app()->user->level_userid : '');
        $moduleReport = array();
        $moduleReportSubmenu = array();

        foreach (Wmreport::getModuleList() as $module) {
            if (!Yii::app()->hasModule($module['module']))
                continue;
            $moduleReportSubmenu[] = array(
                'text' => $module['title'],
                'url' => (isset($module['module']) ? Yii::app()->createUrl('/listMenu/show', array('module' => $module['module'])) : '')
            );
        }

        $moduleReport = array(
            'header' => 'รายงาน',
            'url' => '#',
            'icon' => 'fa-list icon-bar-chart-o',
            'visible' => 1,
            'submenu' => $moduleReportSubmenu
        );


        return array(
            array(
                'header' => 'Home',
                'url' => Yii::app()->createUrl('/'),
                'order' => '',
                'icon' => 'fa-home icon-home',
                'visible' => 1,
                'submenu' => array()
            ),
            array(
                'header' => 'Dashboard',
                'url' => '',
                'order' => '',
                'icon' => 'fa-dashboard icon-dashboard',
                'visible' => 0,
                'submenu' => array(
                    array('text' => 'พีระมิดประชากร', 'url' => Yii::app()->createUrl('/dashboard/dashboard/poppyramid')),
                    array('text' => 'ANC', 'url' => Yii::app()->createUrl('/dashboard/dashboard')),
                    array('text' => 'OPPP', 'url' => Yii::app()->createUrl('/dashboard/dashboard/oppp')),
                    array('text' => 'EPI', 'url' => Yii::app()->createUrl('/dashboard/dashboard/epi')),
                    array('text' => 'NCD', 'url' => Yii::app()->createUrl('/dashboard/dashboard/ncd')),
                ),
            ),
            array(
                'header' => 'ข่าวประชาสัมพันธ์ <span class="badge badge-success badge-sm" id="news-count"></span>',
                'url' => Yii::app()->createUrl('/wmnews'),
                'order' => '',
                'icon' => 'fa-bullhorn icon-bullhorn',
                'visible' => 1,
                'submenu' => array()
            ),
            array(
                'header' => 'EMR System',
                'url' => Yii::app()->createUrl('/wmemr'),
                'order' => '',
                'icon' => 'icon-bullhorn fa-plane',
                'visible' => (Yii::app()->hasModule('wmemr')),
                'submenu' => array()
            ),
            /*
              array(
              'header' => 'CVD Risk',
              'url' => '',
              'icon' => 'fa-group icon-list',
              'visible' => 1,
              'submenu' => array(
              #array('text' => 'ทะเบียนคัดกรอง DMHT=>35 ปี', 'url' => Yii::app()->createUrl('/wmregister/regisDmht'), 'visible' => 1,),
              #array('text' => 'ผล LAB ผู้ป่วยเบาหวามความดัน', 'url' => Yii::app()->createUrl('/wmregister/regisNcdlab'), 'visible' => (Yii::app()->params['wmsystem_mode'] <> 'client'),),
              array('text' => 'ผู้ป่วย DMHT CVD Risk', 'url' => Yii::app()->createUrl('/wmcvdrisk/ncdCvdrisk/'), 'visible' => (Yii::app()->hasModule('wmcvdrisk')),),
              ),
              ),
             * 
             */
            array(
                'header' => 'ทะเบียน',
                'url' => '',
                'icon' => 'fa-group icon-list',
                'visible' => 1,
                'submenu' => array(
                    #array('text' => 'ข้อมูลประชากร', 'url' => Yii::app()->createUrl('/wmregister/regisPerson'), 'visible' => 0,),
                    #array('text' => 'ทะเบียนคัดกรอง DMHT=>35 ปี', 'url' => Yii::app()->createUrl('/wmregister/regisDmht'), 'visible' => 1,),
                    #array('text' => 'ผล LAB ผู้ป่วยเบาหวามความดัน', 'url' => Yii::app()->createUrl('/wmregister/regisNcdlab'), 'visible' => (Yii::app()->params['wmsystem_mode'] <> 'client'),),
                    array('text' => 'ทะเบียนหญิงตั้งครรภ์', 'url' => Yii::app()->createUrl('/wmregister/regisAnc'), 'visible' => (Yii::app()->hasModule('wmregister')),),
                    #array('text' => 'ทะเบียนหญิงตั้งครรภ์', 'url' => Yii::app()->createUrl('/wmregister/exchangeAnc'), 'visible' => (Yii::app()->hasModule('wmregister')),),
                    #array('text' => 'ติดตามหญิงตั้งครรภ์', 'url' => Yii::app()->createUrl('/wmregister/exchangeAnc/follow'), 'visible' => (Yii::app()->hasModule('wmregister')),),
                    #array('text' => 'รายชื่อหญิงตั้งครรภ์', 'url' => Yii::app()->createUrl('/wmregister/exchangeAnc'), 'visible' => (Yii::app()->hasModule('wmregister')),),
                    array('text' => 'ผู้ป่วย DMHT CVD Risk', 'url' => Yii::app()->createUrl('/wmcvdrisk/ncdCvdrisk/'), 'visible' => (Yii::app()->hasModule('wmcvdrisk')),),
                    array('text' => 'คลินิกเบาหวานความดัน', 'url' => Yii::app()->createUrl('/wmregister/exchangeClinic/'), 'visible' => (Yii::app()->hasModule('wmregister')),),
                    array('text' => 'ทะเบียนข้อมูลประชากร', 'url' => Yii::app()->createUrl('/wmregister/TPerson/'), 'visible' => (Yii::app()->hasModule('wmregister')),),
#array('text' => 'ทะเบียนวัคซีนเด็ก 0-5 ปี', 'url' => Yii::app()->createUrl('/wmregister/regisEPI05'), 'visible' => 0,),
                #array('text' => 'หญิงตั้งครรภ์และหญิงหลังคลอด 6 สัปดาห์', 'url' => Yii::app()->createUrl('/hosxppcu/List2'), 'visible' => 1,),
                #array('text' => 'งานอนามัยแม่และเด็ก 0-11 เดือน 29 วัน', 'url' => Yii::app()->createUrl('#'), 'visible' => 1,),
                #array('text' => 'งานโภชนาการสร้างเสริมภูมิคุ้มกันโรคเด็ก 1-5 ปี 11 เดือน 29 วัน', 'url' => Yii::app()->createUrl('#'), 'visible' => 1,),
                #array('text' => 'งานอนามัยเด็กวัยเรียน', 'url' => Yii::app()->createUrl('#'), 'visible' => 1,),
                #array('text' => 'งานวางแผนครอบครัว', 'url' => Yii::app()->createUrl('#'), 'visible' => 1,),
                #array('text' => 'งานอนามัยเด็กวัยเรียน', 'url' => Yii::app()->createUrl('#'), 'visible' => 1,),
                ),
            ),
            array(
                'header' => 'เว็บเซอร์วิส',
                'url' => '',
                'icon' => 'fa-desktop icon-rss',
                'visible' => !(Yii::app()->params['webservice_active'] == 0),
                'submenu' => array(
                    #array('text' => 'สถานะการรับส่งข้อมูล', 'url' => Yii::app()->createUrl('/wmclient/client/clientProcess/showprocess'), 'visible' => (Yii::app()->params['wmsystem_mode'] <> 'server'),),
                    array('text' => 'สถานะการรับส่งข้อมูล', 'url' => Yii::app()->createUrl('/client/api'), 'visible' => (Yii::app()->hasModule('client')),),
                    array('text' => 'สถานะหน่วยบริการเชื่อมต่อ Webservice', 'url' => Yii::app()->createUrl('/webservice/server/manage'), 'visible' => (Yii::app()->params['wmsystem_mode'] == 'server' && $staff == 'staff'),),
                    array('text' => 'จัดการหน่วยบริการ', 'url' => Yii::app()->createUrl('/webservice/hospitalBaseStatus/admin'), 'visible' => (Yii::app()->params['wmsystem_mode'] == 'server' && $staff == 'staff'),),
                    array('text' => 'สถานะการ Sync ข้อมูล', 'url' => Yii::app()->createUrl('/dshosxp/DwsyncRealtime'), 'visible' => (Yii::app()->hasModule('dshosxp')),),
                ),
            ),
            $moduleReport,
            array(
                'header' => 'วิเคราะห์ข้อมูล',
                'url' => Yii::app()->createUrl('/'),
                'order' => '',
                'icon' => 'fa-home icon-home',
                'visible' => 0,
                'submenu' => array()
            ),
            array(
                'header' => 'Data exchange',
                'url' => Yii::app()->createUrl('listMenu/show', array('module' => 'wmdataexchange')),
                'order' => '',
                'icon' => 'fa-random icon-random',
                'visible' => (Yii::app()->hasModule('wmdataexchange') && (Yii::app()->params['webservice_active'] == 1)),
                'submenu' => array()
            ),
            array(
                'header' => 'Data Processing',
                'url' => Yii::app()->createUrl('listMenu/show', array('module' => 'wmdataexchange')),
                'order' => '',
                'icon' => 'fa-retweet icon-retweet',
                'visible' => (Yii::app()->hasModule('wmdataprocess')),
                'submenu' => array()
            ),
            array(
                'header' => 'GIS Health',
                'url' => Yii::app()->createUrl('wmgis/gis'),
                'order' => '',
                'icon' => 'fa-map-marker icon-maps',
                'visible' => 0, //(Yii::app()->hasModule('wmgis')),
                'submenu' => array()
            ),
            array(
                'header' => 'ตั้งค่า',
                'url' => '',
                'order' => '',
                'icon' => 'fa-gears icon-gears',
                'visible' => ($staff == 'staff' || Yii::app()->params['wmsystem_mode'] == 'client'),
                'submenu' => array(
                    array('text' => 'ตั้งค่าระบบหลัก', 'url' => Yii::app()->createUrl('/configParam')),
                    array('text' => 'ระบบจัดการสมาชิก', 'url' => Yii::app()->createUrl('/user/admin'), 'visible' => (Yii::app()->params['wmsystem_mode'] <> 'client')),
                    array('text' => 'สถานะ Mysql', 'url' => Yii::app()->createUrl('/endprocess/mysql/processlist'), 'visible' => (Yii::app()->params['wmsystem_mode'] <> 'client')),
                    array('text' => 'ระบบประมวลผล', 'url' => Yii::app()->createUrl('/webservice/alter/index')),
                    array('text' => 'update โปรแกรม', 'url' => Yii::app()->createUrl('/UpdateSoftware/upSystem')),
                ),
            ),
        );
    }

}
