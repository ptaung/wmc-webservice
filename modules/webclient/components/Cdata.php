<?php

/*
 * พัฒนาโดย ศิลา กลั่นแกล้ว สสจ.สุพรรณบุรี
 *
 */

namespace app\modules\webclient\components;

use app\modules\news\models\News;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;

class Cdata {
# Lookup ระดับสถานบริการ

    public static function levelLookupType() {
        $hospcode = \Yii::$app->user->identity->profile->hospcode;
        try {
            $data = \Yii::$app->db_datacenter->createCommand("SELECT hoscode,hostype,provcode,distcode,subdistcode FROM chospital WHERE hoscode = '{$hospcode}'")->cache(3600)->queryOne();
            if (in_array($data['hostype'], ['01'])) {
                $return = "SSJ";
            } elseif (in_array($data['hostype'], ['02'])) {
                $return = "SSO";
            } else {
                $return = "HOS";
            }
        } catch (\Exception $exc) {
            $return = "";
        }

        return $return;
    }

# Lookup สถานบริการ

    public static function levelLookup($amp = '') {
        $hospcode = \Yii::$app->user->identity->profile->hospcode;
        if (empty($amp)) {
            $addQuery = "hoscode = '{$hospcode}'";
        } else {
            $addQuery = "concat(provcode,distcode) = '{$amp}'";
        }
        try {
            $data = \Yii::$app->db_datacenter->createCommand("SELECT hoscode,hostype,provcode,distcode,subdistcode FROM chospital WHERE {$addQuery} ")->cache(3600)->queryOne();
            if (in_array($data['hostype'], ['01'])) {
                $return = "SELECT hospcode FROM pcu_hos_allow";
            } elseif (in_array($data['hostype'], ['02'])) {
                $return = "SELECT hoscode FROM chospital WHERE provcode = '{$data['provcode']}' and distcode = '{$data['distcode']}' /*and hostype not in ('01','02')*/";
            } else {
                $return = "'$hospcode'";
            }
        } catch (\Exception $exc) {
            $return = "";
        }

        return $return;
    }

    public static function getThaimonth($m) {
        $month = ['01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค.', '04' => 'เม.ย.', '05' => 'พ.ค.', "06" => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.'];
        return $month[$m];
    }

    public static function getdata($sql) {
        try {
#$data = \Yii::$app->db_datacenter->createCommand($sql)->queryAll();
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        return $data;
    }

    public static function getReporttypeare() {
        $sql = "SELECT
    COUNT(DISTINCT pid) AS cc,
    IF(check_typearea IS NOT NULL AND check_typearea <> '',
        CONCAT('TypeArea ', check_typearea),
        'ไม่ระบุ') AS typearea
    FROM
        t_person_cid
    WHERE
        BINARY hospcode in (" . self::levelLookup() . ") AND
        discharge = 9
    GROUP BY check_typearea ASC";
        $chart = [];
        try {
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        foreach ($data as $key => $value) {
            $chart[] = [$value['typearea'], (int) $value['cc']];
        }

        return [['name' => 'typearea', 'data' => $chart]];
    }

    public static function getHosxpversion() {
        $sql = "SELECT count(*) as cc,hosxp_version from hosxpversion_view where BINARY hcode in (" . self::levelLookup() . ") group by hosxp_version";
        $chart = [];
        try {
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        foreach ($data as $key => $value) {
            $chart[] = [$value['hosxp_version'], (int) $value['cc']];
        }

        return [['name' => 'จำนวน Client', 'data' => $chart]];
    }

    public static function getKpiChildev1830($order = 'DESC', $limit = 10) {

        $sql = "
            SELECT * FROM(
            SELECT *, (@no := @no + 1)  AS num
            FROM
            (SELECT a.hospcode
                ,CONCAT(a.hospcode,' ',h.hosname) AS hospname
                ,round((SUM(result)/SUM(target))*100,2) AS p
                ,SUM(target) AS ss_target
                ,SUM(result) AS ss_result
                ,LEFT(areacode,4) AS areacode
                FROM ws_kpi_childev_prov a
                LEFT JOIN chospital h ON a.hospcode = h.hoscode
                WHERE b_year = (SELECT yearprocess+543 FROM wmc_config LIMIT 1)
                GROUP BY a.hospcode
                ORDER BY p desc
                ) t,(SELECT @no :=0) tt

            ORDER BY num {$order}) t1
            WHERE hospcode in (" . self::levelLookup() . ")
                ORDER BY num {$order}
            LIMIT " . $limit . ";";
        $chart = [];
        try {
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        foreach ($data as $value) {
            $chart[] = ['name' => 'อันดับ ' . $value['num'] . ' |' . $value['hospname'], 'y' => (double) $value['p']];
        }

        return [['name' => 'ผลงาน', 'data' => $chart]];
    }

    public static function getDmRetina($order = 'DESC', $limit = 10) {

        $sql = "
            SELECT * FROM(
            SELECT *, (@no := @no + 1)  AS num
            FROM
            (SELECT a.hospcode
                ,CONCAT(a.hospcode,' ',h.hosname) AS hospname
                ,round((SUM(result)/SUM(target))*100,2) AS p
                ,SUM(target) AS ss_target
                ,SUM(result) AS ss_result
                ,LEFT(areacode,4) AS areacode
                FROM ws_dm_retina a
                LEFT JOIN chospital h ON a.hospcode = h.hoscode
                WHERE b_year = (SELECT yearprocess+543 FROM wmc_config LIMIT 1)
                GROUP BY a.hospcode
                ORDER BY p desc
                ) t,(SELECT @no :=0) tt

            ORDER BY num {$order}) t1
            WHERE hospcode in (" . self::levelLookup() . ")
                ORDER BY num {$order}
            LIMIT " . $limit . ";";
        $chart = [];
        try {
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        foreach ($data as $value) {
            $chart[] = ['name' => 'อันดับ ' . $value['num'] . ' |' . $value['hospname'], 'y' => (double) $value['p']];
        }

        return [['name' => 'ผลงาน', 'data' => $chart]];
    }

    public static function getDmControl($order = 'DESC', $limit = 10) {

        $sql = "
            SELECT * FROM(
            SELECT *, (@no := @no + 1)  AS num
            FROM
            (SELECT a.hospcode
                ,CONCAT(a.hospcode,' ',h.hosname) AS hospname
                ,round((SUM(result)/SUM(target))*100,2) AS p
                ,SUM(target) AS ss_target
                ,SUM(result) AS ss_result
                ,LEFT(areacode,4) AS areacode
                FROM ws_dm_control a
                LEFT JOIN chospital h ON a.hospcode = h.hoscode
                WHERE b_year = (SELECT yearprocess+543 FROM wmc_config LIMIT 1)
                GROUP BY a.hospcode
                ORDER BY p desc
                ) t,(SELECT @no :=0) tt

            ORDER BY num {$order}) t1
            WHERE hospcode in (" . self::levelLookup() . ")
                ORDER BY num {$order}
            LIMIT " . $limit . ";";
        $chart = [];
        try {
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        foreach ($data as $value) {
            $chart[] = ['name' => 'อันดับ ' . $value['num'] . ' |' . $value['hospname'], 'y' => (double) $value['p']];
        }

        return [['name' => 'ผลงาน', 'data' => $chart]];
    }

    public static function getKpiAnc5($order = 'DESC', $limit = 10) {

        $sql = " SELECT * FROM(
            SELECT *, (@no := @no + 1)  AS num
            FROM
            (SELECT a.hospcode
                ,CONCAT(a.hospcode,' ',h.hosname) AS hospname
                ,round((SUM(result)/SUM(target))*100,2) AS p
                ,SUM(target) AS ss_target
                ,SUM(result) AS ss_result
                ,LEFT(areacode,4) AS areacode
                FROM ws_anc a
                LEFT JOIN chospital h ON a.hospcode = h.hoscode
                WHERE b_year = (SELECT yearprocess+543 FROM wmc_config LIMIT 1)
                GROUP BY a.hospcode
                ORDER BY p desc
                ) t,(SELECT @no :=0) tt
            ORDER BY num {$order}) t1
            WHERE hospcode in (" . self::levelLookup() . ")
                ORDER BY num {$order}
            LIMIT " . $limit . ";";
        $chart = [];
        try {
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        foreach ($data as $value) {
            $chart[] = ['name' => 'อันดับ ' . $value['num'] . ' |' . $value['hospname'], 'y' => (double) $value['p']];
        }

        return [['name' => 'ผลงาน', 'data' => $chart]];
    }

    public static function getKpiAnc12($order = 'DESC', $limit = 10) {

        $sql = " SELECT * FROM(
            SELECT *, (@no := @no + 1)  AS num
            FROM
            (SELECT a.hospcode
                ,CONCAT(a.hospcode,' ',h.hosname) AS hospname
                ,round((SUM(result)/SUM(target))*100,2) AS p
                ,SUM(target) AS ss_target
                ,SUM(result) AS ss_result
                ,LEFT(areacode,4) AS areacode
                FROM ws_kpi_anc12 a
                LEFT JOIN chospital h ON a.hospcode = h.hoscode
                INNER JOIN pcu_hos_allow h2 ON h2.hospcode = a.hospcode 
                WHERE b_year = (SELECT yearprocess+543 FROM wmc_config LIMIT 1)
                GROUP BY a.hospcode
                ORDER BY p desc
                ) t,(SELECT @no :=0) tt
            ORDER BY num {$order}) t1
            WHERE hospcode in (" . self::levelLookup() . ")
                ORDER BY num {$order}
            LIMIT " . $limit . ";";
        $chart = [];
        try {
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        foreach ($data as $value) {
            $chart[] = ['name' => 'อันดับ ' . $value['num'] . ' |' . $value['hospname'], 'y' => (double) $value['p']];
        }

        return [['name' => 'ผลงาน', 'data' => $chart]];
    }

    public static function getDmhtCkdScreen($order = 'DESC', $limit = 10) {

        $sql = " SELECT * FROM(
            SELECT *, (@no := @no + 1)  AS num
            FROM
            (SELECT a.hospcode
                ,CONCAT(a.hospcode,' ',h.hosname) AS hospname
                ,round((SUM(result)/SUM(target))*100,2) AS p
                ,SUM(target) AS ss_target
                ,SUM(result) AS ss_result
                ,LEFT(areacode,4) AS areacode
                FROM ws_kpi_ckd_screen a
                LEFT JOIN chospital h ON a.hospcode = h.hoscode
                INNER JOIN pcu_hos_allow h2 ON h2.hospcode = a.hospcode #AND h2.hospcode = h2.hospcode_cup
                WHERE b_year = (SELECT yearprocess+543 FROM wmc_config LIMIT 1)
                GROUP BY a.hospcode
                ORDER BY p desc
                ) t,(SELECT @no :=0) tt
            ORDER BY num {$order}) t1
            WHERE hospcode in (" . self::levelLookup() . ")
                ORDER BY num {$order}
            LIMIT " . $limit . ";";
        $chart = [];
        try {
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        foreach ($data as $value) {
            $chart[] = ['name' => 'อันดับ ' . $value['num'] . ' |' . $value['hospname'], 'y' => (double) $value['p']];
        }

        return [['name' => 'ผลงาน', 'data' => $chart]];
    }

    public static function getReportservice() {
        $sql = "select concat(yy,mm) as yymm ,yy,mm,sum(cc) as cc,sum(times) as times ,reg_date "
                . "from report_service "
                . "where hcode in (" . self::levelLookup() . ")"
                . "group by yy,mm order by yymm desc limit 12";
        $chart = [];
        $chart2 = [];
        try {
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        foreach ($data as $value) {
            $chart[] = ['name' => Cdata::getThaimonth($value['mm']) . ($value['yy'] + 543), 'y' => (double) $value['cc']];
            $chart2[] = ['name' => Cdata::getThaimonth($value['mm']) . ($value['yy'] + 543), 'y' => (double) $value['times']];
#echo Cdata::getThaimonth($value['mm']) . ($value['yy'] + 543), '<br>';
        }

#return [['name' => 'จำนวนครั้งการให้บริการผู้ป่วยนอก', 'type' => 'column', 'colorByPoint' => true, 'data' => $chart], ['name' => 'จำนวนผู้ป่วยมารับบริการผู้ป่วยนอก', 'type' => 'spline', 'data' => $chart2]];
        return [['name' => 'จำนวนครั้งการให้บริการผู้ป่วยนอก', 'data' => $chart], ['name' => 'จำนวนผู้ป่วยมารับบริการผู้ป่วยนอก', 'data' => $chart2]];
    }

    public static function getReportservice298() {

        $sql = "SELECT
                    groupcode298
                    ,g.icd10
                    ,t_name
                    ,sum(cc) as cc
                    ,sum(cc_times) as times
                    FROM report_ovstdiag r
                    INNER JOIN cicd298group c ON c.icd10 = r.pdx
                    INNER JOIN cgroup298disease g ON g.cgroup_id = c.groupcode298
                    WHERE concat(yy,mm) between date_format( DATE_SUB('" . date("Ymd") . "',INTERVAL + 12 MONTH),'%Y%m') and '" . date("Ym") . "'
                    AND groupcode298 NOT BETWEEN 268 AND 270
                    AND groupcode298 NOT in(243)
                    AND groupcode298 NOT BETWEEN 290 AND 298
                    AND hcode in (" . self::levelLookup() . ")
                    GROUP BY groupcode298
                    ORDER BY cc DESC
                    limit 20";
        $chart = [];
        $chart2 = [];
        try {
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        foreach ($data as $value) {
            $chart[] = ['name' => $value['t_name'], 'y' => (double) $value['cc']];
            $chart2[] = ['name' => $value['t_name'], 'y' => (double) $value['times']];
#echo Cdata::getThaimonth($value['mm']) . ($value['yy'] + 543), '<br>';
        }

#return [['name' => 'จำนวนครั้งการให้บริการผู้ป่วยนอก', 'type' => 'column', 'colorByPoint' => true, 'data' => $chart], ['name' => 'จำนวนผู้ป่วยมารับบริการผู้ป่วยนอก', 'type' => 'spline', 'data' => $chart2]];
        return [['name' => 'จำนวนครั้งการให้บริการผู้ป่วยนอก', 'data' => $chart], ['name' => 'จำนวนผู้ป่วยมารับบริการผู้ป่วยนอก', 'data' => $chart2]];
    }

    public static function getReporttop10op() {

        $sql = "SELECT
    CONCAT(yy, mm) AS yymm,
    SUM(cc_times) AS times,
    SUM(cc) AS cc,
    pdx
        FROM
            report_top10opd
            WHERE CONCAT(yy, mm) between  date_format( DATE_SUB('" . date("Ymd") . "',INTERVAL + 2 MONTH),'%Y%m') and '" . date("Ym") . "'
            AND LEFT(pdx,3) NOT IN ('Z00','Z01', 'Z02', 'Z10', 'Z11', 'Z12', 'Z13','Z20','Z21','Z22','Z23','Z24','Z25','Z26','Z27','Z28','Z29','Z30','Z31','Z32','Z33','Z34','Z35','Z36','Z37','Z38','Z39','Z53','Z55','Z56','Z57','Z58','Z59','Z60','Z61','Z62','Z63','Z64','Z65','Z80','Z81','Z82','Z83','Z84','Z85','Z86','Z87','Z88','Z89','Z90','Z91','Z92','Z98','Z99')
            AND hcode in (" . self::levelLookup() . ")
            AND LEFT(pdx,1) BETWEEN 'A' AND 'Z'
    GROUP BY pdx
        ORDER BY times desc
        limit 10";
        $chart = [];
        $chart2 = [];
        try {
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        foreach ($data as $value) {
            $chart[] = ['name' => $value['pdx'], 'y' => (double) $value['times']];
            $chart2[] = ['name' => $value['pdx'], 'y' => (double) $value['cc']];
        }

        return [['name' => 'จำนวนครั้ง', 'data' => $chart], ['name' => 'จำนวนผู้ป่วย', 'data' => $chart2]];  #'colorByPoint' => true,
    }

    public static function getReportkpi() {

        $sql = "SELECT
                    a2.wmc_procedure_name
                    ,concat(a2.wmc_procedure_comment ,' ','(',sum(ss_target),'/',sum(ss_result),')') as procedures
                    ,a2.wmc_procedure_comment
                    ,sum(ss_target) as target
                    ,sum(ss_result) as result
                    ,ROUND((SUM(ss_result)/SUM(ss_target))*100,2) AS p
                FROM
                    xws_summary a1
                        LEFT JOIN  wmc_procedure a2 ON MD5(wmc_procedure_name) = a1.ws_md5
                WHERE  hospcode in (" . self::levelLookup() . ")
                    AND b_year = (SELECT yearprocess+543 FROM wmc_config LIMIT 1)
                GROUP BY a1.ws_md5
                ORDER BY p DESC
";
        $chart = [];
        try {
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        foreach ($data as $value) {
            $chart[] = ['name' => $value['procedures'], 'y' => (double) $value['p']];
        }

        return [['name' => 'ผลงาน', 'data' => $chart], ['name' => 'จำนวนผู้ป่วย', 'data' => $chart2]];  #'colorByPoint' => true,
    }

    public static function getReporttop10pp() {

        $sql = "SELECT
                    CONCAT(yy, mm) AS yymm,
                    SUM(cc_times) AS times,
                    SUM(cc_times) AS cc
                    ,pdx
                        FROM
                            report_top10opd
                            WHERE  CONCAT(yy, mm) between date_format( DATE_SUB('" . date("Ymd") . "',INTERVAL + 2 MONTH),'%Y%m') and '" . date("Ym") . "'
                            AND LEFT(pdx,3) IN ('Z00','Z01', 'Z02', 'Z10', 'Z11', 'Z12', 'Z13','Z20','Z21','Z22','Z23','Z24','Z25','Z26','Z27','Z28','Z29','Z30','Z31','Z32','Z33','Z34','Z35','Z36','Z37','Z38','Z39','Z53','Z55','Z56','Z57','Z58','Z59','Z60','Z61','Z62','Z63','Z64','Z65','Z80','Z81','Z82','Z83','Z84','Z85','Z86','Z87','Z88','Z89','Z90','Z91','Z92','Z98','Z99')
                            AND hcode in (" . self::levelLookup() . ")
                            AND LEFT(pdx,1) BETWEEN 'A' AND 'Z'
                        GROUP BY pdx
                        ORDER BY times desc
                        limit 10";
        $chart = [];
        try {
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        foreach ($data as $value) {
            $chart[] = ['name' => $value['pdx'], 'y' => (double) $value['times']];
            $chart2[] = ['name' => $value['pdx'], 'y' => (double) $value['cc']];
        }

        return [['name' => 'จำนวนครั้ง', 'data' => $chart], ['name' => 'จำนวนผู้ป่วย', 'data' => $chart2]];  #'colorByPoint' => true,
    }

    public static function getReportSync() {

        $sql = "SELECT
table_name
,last_complete
,complete_percent
,timestampdiff(day,last_complete,now()) AS m
FROM dw_" . \Yii::$app->user->identity->profile->hospcode . ".etl_table_status

where table_name in (
'labor',
'iptadm',
'an_stat',
'vn_stat',
'ovst',
'ovstdiag',
'ovst_vaccine',
'opdscreen',
'opdscreen_fbs',
'clinic',
'clinic_visit',
'clinicmember',
'clinicmember_cormobidity_screen',
'clinicmember_cormobidity_eye',
'clinicmember_cormobidity_foot',
'clinicmember_cormobidity_eye_screen',
'clinicmember_cormobidity_foot_screen',
'ipt',
'iptoprt',
'ipt_newborn',
'ipt_labour',
'ipt_labour_infant',
'ipt_pregnancy',
'iptdiag',
'person',
'person_anc',
'epi_vaccine',
'patient',
'person_anc_other_precare',
'person_anc_preg_care',
'person_anc_service',
'person_anc_service_detail',
'person_anc_screen',
'person_deformed',
'person_epi',
'person_epi_nutrition',
'person_epi_vaccine',
'person_epi_vaccine_list',
'person_labour',
'person_vaccine',
'person_vaccine_list',
'person_wbc',
'person_wbc_nutrition',
'person_wbc_post_care',
'person_wbc_post_care_screen',
'person_wbc_service',
'person_wbc_vaccine_detail',
'wbc_vaccine',
'person_vaccine_elsewhere',
'person_dmht_screen_summary',
'person_dmht_cormobidity_screen_detail',
'person_dmht_nhso_screen',
'person_dmht_risk_screen_head',
'person_dmht_risk_service',
'person_dmht_screen_summary',
'person_ht_risk_bp_screen',
'person_dm_fgc_screen',
'person_dm_risk_screen_detail',
'sys_var',
'village_student',
'village_student_screen',
'village_student_vaccine',
'village_student_vaccine_list',
'student_vaccine',
#'opitemrece',
'wbc_vaccine',
'person_dm_fgc_screen',
'person_dm_risk_screen_detail',
'person_dmht_cormobidity_screen_detail',
'person_dmht_screen_summary',
'depression_screen',
'person_dmht_risk_screen_head',
'person_vaccine_elsewhere',
'ovst_seq'
)
and timestampdiff(day,last_complete,now())  > 15
order by last_complete asc,complete_percent asc
";
        $chart = [];
        try {
            $data = self::cache($sql);
        } catch (\Exception $exc) {
            $data = [];
        }
        foreach ($data as $value) {
            $chart[] = ['name' => $value['table_name'], 'y' => (double) $value['m']];
        }

        return [['name' => 'จำนวนวัน', 'data' => $chart]];  #'colorByPoint' => true,
    }

    public static function getNews() {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find(),
        ]);

        return $dataProvider;
    }

    public function cache($query) {
        $db = \Yii::$app->db_datacenter;
        return $db->createCommand($query)->cache(3600)->queryAll();
    }

    public static function getSyncStauts() {
        $sql = "SELECT hospital_base_status.*
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_sync_start)) <= 150 AND hbs_sync_start != '0000-00-00 00:00:00',1,0) AS syncing
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= 150,1,0) AS connect
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= 150,1,0) AS realtime
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= 150,'ONLINE','OFFLINE') AS online
                # 24 ชั่วโมง
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= (60*60*24),1,0) AS status_online
                # 2 วัน
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= (60*60*24*3),1,0) AS status_sync
                ,CONCAT(hoscode,' ',hosname) AS fullname
                ,CONCAT(IF(TIMESTAMPDIFF(DAY,hbs_sync_start,hbs_sync_finish) <> 0,CONCAT(TIMESTAMPDIFF(DAY,hbs_sync_start,hbs_sync_finish),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(HOUR,hbs_sync_start,hbs_sync_finish), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(HOUR,hbs_sync_start,hbs_sync_finish), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(MINUTE,hbs_sync_start,hbs_sync_finish), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(MINUTE,hbs_sync_start,hbs_sync_finish), 60),' นาที '),'')
                ) AS usetime
                ,CONCAT(IF(TIMESTAMPDIFF(DAY,NOW(),hbs_sync_start) <> 0,CONCAT(TIMESTAMPDIFF(DAY,NOW(),hbs_sync_start),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_sync_start), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_sync_start), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_sync_start), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_sync_start), 60),' นาที '),'')
                ) AS synctime
                ,CONCAT(IF(TIMESTAMPDIFF(DAY,NOW(),hbs_sync_finish) <> 0,CONCAT(TIMESTAMPDIFF(DAY,NOW(),hbs_sync_finish),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_sync_finish), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_sync_finish), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_sync_finish), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_sync_finish), 60),' นาที '),'')
                ) AS lastsync
                ,CONCAT(IF(TIMESTAMPDIFF(DAY,NOW(),hbs_time) <> 0,CONCAT(TIMESTAMPDIFF(DAY,NOW(),hbs_time),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_time), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_time), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_time), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_time), 60),' นาที '),'')
                ) AS lastonline

                FROM hospital_base_status,chospital
                WHERE hbs_hospital_id = hoscode AND hbs_hospital_id in (" . self::levelLookup() . ")
";
        $chart = [];
        try {
            $data = Yii::$app->db_datacenter->createCommand($sql)->queryAll();
        } catch (\Exception $exc) {
            $data = [];
        }
        echo json_encode($data);
    }

}
