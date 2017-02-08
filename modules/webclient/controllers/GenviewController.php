<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\webclient\controllers;

use yii\web\Controller;
use app\models\Chospital;

class GenviewController extends Controller {

    public function actionRun() {
        $this->actionAllergy();
        $this->actionPerson();
        $this->actionTperson();
        $this->actionPersonanc();
        $this->actionVnstat();
        $this->actionGisdmht();
        $this->actionHosxpversion();
        $this->actionOpvisit();
        $this->actionPersondeath();
        $this->actionClinicmember();
        $this->actionOvstdiag();

        #$this->actionEpi();
    }

    public function gensqlview($sql, $table) {
        if (strlen(\Yii::$app->params['ampcode']) == 4) {
            $ampcode = " AND concat(provcode,distcode) = '" . \Yii::$app->params['ampcode'] . "' ";
        } else {
            $ampcode = '';
        }
        $sqlQueryString = '';
        $m = Chospital::find()->where(
                        "provcode = '" . \Yii::$app->params['provcode'] . "'
                            and hostype in ('03','05','06','07','18')
                            {$ampcode}
                            "
                )->orderBy(['hoscode' => 'asc'])->all();
        $cc = count($m) - 1;
        foreach ($m as $index => $model) {
            $prefix_table = "dw_" . $model->hoscode . ".";
            $sqlQueryString.= str_replace("{table}", $prefix_table, $sql);
            if ($cc > $index)
                $sqlQueryString.= ' union all ';
        }
        $sqlQuery = "CREATE OR REPLACE VIEW {$table} AS ";
        $sqlQuery .= $sqlQueryString . ';';

        try {
            $data = \Yii::$app->db_datacenter->createCommand($sqlQuery)->execute();
            echo 'SUCCESS ' . $table, '<br>';
        } catch (\Exception $exc) {
            echo $exc->getMessage(), '<br>';
        }

        #return $sqlQuery;
    }

//ข้อมูล Person
    public function actionPerson() {
        $sql = "SELECT SQL_BIG_RESULT SUBSTR('{table}',4,5) AS hcode, cid,pname,fname,lname,house_regist_type_id,birthdate,nationality,person_id,sex,last_update FROM {table}person";
        $this->gensqlview($sql, 'person_view');
    }

//ข้อมูล Vnstat
    public function actionVnstat() {
        $sql = "SELECT SQL_BIG_RESULT SUBSTR('{table}',4,5) AS hcode,hn,vn,vstdate,pdx,cid,sex,age_y,age_m,age_d,aid,pcode FROM {table}vn_stat";
        $this->gensqlview($sql, 'vn_stat_view');
    }

    public function actionOpvisit2() {
        $sql = "SELECT SQL_BIG_RESULT SUBSTR('{table}',4,5) AS hserv,hospmain,hospsub,YEAR(vstdate) AS yy,MONTH(vstdate)AS mm,COUNT(vn) AS cc
                    FROM {table}vn_stat
                    WHERE vstdate BETWEEN '2015-10-01' AND NOW()
                    AND hospsub <> ''
                    AND pcode IN ('A3','A4','A5','A6','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','UC')
                    AND main_pdx NOT IN ('Z00','Z01', 'Z02', 'Z10', 'Z11', 'Z12', 'Z13','Z20','Z21','Z22','Z23','Z24','Z25','Z26','Z27','Z28','Z29','Z30','Z31','Z32','Z33','Z34','Z35','Z36','Z37','Z38','Z39','Z53','Z55','Z56','Z57','Z58','Z59','Z60','Z61','Z62','Z63','Z64','Z65','Z80','Z81','Z82','Z83','Z84','Z85','Z86','Z87','Z88','Z89','Z90','Z91','Z92','Z98','Z99')
                    GROUP BY hospmain ,hospsub,YEAR(vstdate),MONTH(vstdate)";
        $this->gensqlview($sql, 'opvisit_view');
    }

//ข้อมูล Opvisit
    public function actionOpvisit() {
        $sql = "SELECT SQL_BIG_RESULT SUBSTR('{table}',4,5) AS hserv,hospmain,hospsub,YEAR(vstdate) AS yy,MONTH(vstdate)AS mm,COUNT(vn) AS cc
                    FROM {table}vn_stat
                    WHERE vstdate BETWEEN '2013-04-01' AND NOW()
                    AND hospsub <> ''
                    AND pcode IN ('A3','A4','A5','A6','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','UC')
                    GROUP BY hospmain ,hospsub,YEAR(vstdate),MONTH(vstdate)";
        $this->gensqlview($sql, 'opvisit_view');
    }

//ข้อมูลพิกัดบ้านเบาหวามความดัน
    public function actionGisdmht() {
        $sql = "select
                SQL_BIG_RESULT
                SUBSTR('{table}',4,5) AS hcode
                ,cid
                ,person_id
                ,latitude
                ,longitude
                from {table}clinicmember c
                left join {table}person p on c.hn = p.patient_hn
                left join {table}house h on p.house_id = h.house_id
                where p.house_regist_type_id in (1,3)
                and p.person_id  not in (select person_id from {table}person_death)
                ";
        $this->gensqlview($sql, 'gisdmht_view');
    }

//ข้อมูล version hosxp
    public function actionHosxpversion() {
        $sql = "SELECT SQL_BIG_RESULT  SUBSTR('{table}',4,5) AS hcode,sys_value AS hosxp_version FROM {table}sys_var WHERE sys_name = 'inventory-stored-procedure-version'";
        $this->gensqlview($sql, 'hosxpversion_view');
    }

    //ข้อมูล ovstdiag
    public function actionOvstdiag() {
        $sql = "SELECT
	SQL_BIG_RESULT
    SUBSTR('{table}',4,5) as hospcode,
    IFNULL(p.cid, null) AS cid,
    IFNULL(v.hn, null) AS hn,
    IFNULL(o.an, null) AS an,
    IFNULL(v.vn,null) AS vn,
    IFNULL(v.vstdate, null) AS vstdate,
    IFNULL(v.icd10,null) AS icd10,
    IFNULL(v.diagtype, null) AS diagtype,
    IFNULL(p.sex, null) AS sex,
    IFNULL(p.birthday,null) AS birthday,
    IFNULL(p.nationality, null) AS nationality,
    IFNULL(pt.pcode,null) AS pcode,
    CONCAT(p.chwpart,p.amppart,tmbpart,lpad(moopart,2,'0')) as aid
FROM
    {table}ovstdiag v
        INNER JOIN
    {table}patient p ON v.hn = p.hn
        INNER JOIN
    {table}ovst o ON v.vn = o.vn
        INNER JOIN
    {table}pttype pt ON pt.pttype = o.pttype
WHERE
    v.vstdate BETWEEN '2013-10-01' AND now()
        AND v.icd10 REGEXP '[a-z]'";
        $this->gensqlview($sql, 'ovstdaig_view');
    }

//ข้อมูลการแพ้ยา
    public function actionAllergy() {
        $sql = " SELECT SQL_BIG_RESULT  SUBSTR('{table}',4,5) AS hcode
                        ,p.cid
                        ,concat(pname,fname,' ',lname) as patient_name
                        ,report_date
                        ,agent
                        ,symptom
                        ,begin_date
                        ,p.nationality
                        ,p.birthday
                        from {table}opd_allergy a ,{table}patient p
                        where a.hn = p.hn
                        and (p.deathday is null || p.deathday = '')";
        $this->gensqlview($sql, 'opd_allergy_view');
    }

//ข้อมูล t_person
    public function actionTperson() {
        $sql = " SELECT SQL_BIG_RESULT  SUBSTR('{table}',4,5) AS hospcode,
                    cid,
                    person_id as pid,
                    house_id as hid,
                    pname as prename,
                    fname as name,
                    lname,
                    patient_hn as hn,
                    sex,
                    birthdate as birth,
                    marrystatus as mstatus,
                    occupation as occupation_old,
                    null as occupation_new,
                    citizenship as race,
                    nationality as nation,
                    religion,
                    education,
                    null as fstatus,
                    #father_cid as father,
                    #mother_cid as mother,
                    null as father,
                    null as mother,
                    null as couple,
                    null as vstatus,
                    #movein_date as movein,
                    null as movein,
                    person_discharge_id as discharge,
                    discharge_date as ddischarge,
                    null as abogroup,
                    null as rhgroup,
                    null as labor,
                    null as passport,
                    house_regist_type_id as typearea,
                    last_update as d_update,
                    null as check_hosp,
                    null as check_typearea,
                    null as vhid,
                    null as check_vhid,
                    pttype_hospmain as maininscl,
                    null as inscl
                    FROM {table}person ";

        $this->gensqlview($sql, 't_person_view');
    }

//ข้อมูลการตาย
    public function actionPersondeath() {
        $sql = "SELECT SQL_BIG_RESULT  SUBSTR('{table}',4,5) AS hospcode,
                        cid, d.death_date, death_diag_1 AS death_diag
                    FROM
                        {table}person_death d,
                        {table}person p
                    WHERE
                        d.person_id = p.person_id
                      ";
        $this->gensqlview($sql, 'person_death_view');
    }

    //ข้อมูล EPI
    public function actionEpi() {
        $sql = "SELECT
        vn,
            pw.person_id,
            service_date,
            service_time,
            export_vaccine_code AS vaccine_type,
            wbc_vaccine_name AS vaccine_name,
            SUBSTR('{table}',4,5) AS service_hospcode,
            vaccine_lotno,
            '' AS vaccine_hospcode,
            'บัญชี 3' AS source
    FROM
        {table}person_wbc pw
    INNER JOIN {table}person_wbc_service pws ON pw.person_wbc_id = pws.person_wbc_id
    INNER JOIN {table}person_wbc_vaccine_detail pwv ON pwv.person_wbc_service_id = pws.person_wbc_service_id
    INNER JOIN {table}wbc_vaccine v ON v.wbc_vaccine_id = pwv.wbc_vaccine_id
    WHERE length(export_vaccine_code) > 1
        and
        service_date BETWEEN DATE_ADD(NOW(), INTERVAL - 3 YEAR) AND NOW()
        ";

        "
UNION ALL SELECT
        vn,
            pw.person_id,
            vaccine_date AS service_date,
            vaccine_time AS service_time,
            export_vaccine_code AS vaccine_type,
            epi_vaccine_name AS vaccine_name,
            '' AS service_hospcode,
            vaccine_lotno,
            '' AS vaccine_hospcode,
            'บัญชี 4' AS source
    FROM
        {table}person_epi pw
    INNER JOIN {table}person_epi_vaccine pws ON pw.person_epi_id = pws.person_epi_id
    INNER JOIN {table}person_epi_vaccine_list pwv ON pwv.person_epi_vaccine_id = pws.person_epi_vaccine_id
    INNER JOIN {table}epi_vaccine v ON v.epi_vaccine_id = pwv.epi_vaccine_id
    WHERE length(export_vaccine_code) > 1
        and
        vaccine_date BETWEEN DATE_ADD(NOW(), INTERVAL - 3 YEAR) AND NOW() UNION ALL

        SELECT
        ov.vn,
            pp.person_id,
            vstdate AS service_date,
            vsttime AS service_time,
            export_vaccine_code AS vaccine_type,
            vaccine_name,
            '' AS service_hospcode,
            vaccine_lot_no AS vaccine_lotno,
            '' AS vaccine_hospcode,
            'onestop service' AS source
    FROM
        {table}ovst_vaccine ov
    INNER JOIN {table}ovst o ON o.vn = ov.vn
    LEFT JOIN {table}patient pt ON o.hn = pt.hn
    LEFT JOIN {table}person pp ON pt.cid = pp.cid
    INNER JOIN {table}person_vaccine pv ON ov.person_vaccine_id = pv.person_vaccine_id
    WHERE length(export_vaccine_code) > 1
        and
        vstdate BETWEEN DATE_ADD(NOW(), INTERVAL - 3 YEAR) AND NOW() UNION ALL
    SELECT
        vn,
            pw.person_id,
            vaccine_date AS service_date,
            vaccine_time AS service_time,
            export_vaccine_code AS vaccine_type,
            student_vaccine_name AS vaccine_name,
            '' AS service_hospcode,
            vaccine_lotno,
            '' AS vaccine_hospcode,
            'บัญชี 5' AS source
    FROM
        {table}village_student pw
    INNER JOIN {table}village_student_vaccine pws ON pw.village_student_id = pws.village_student_id
    INNER JOIN {table}village_student_vaccine_list pwv ON pwv.village_student_vaccine_id = pws.village_student_vaccine_id
    INNER JOIN {table}student_vaccine v ON v.student_vaccine_id = pwv.student_vaccine_id
    WHERE length(export_vaccine_code) > 1
        and
        vaccine_date BETWEEN DATE_ADD(NOW(), INTERVAL - 3 YEAR) AND NOW() UNION ALL SELECT
        vn,
            pw.person_id,
            anc_service_date AS service_date,
            anc_service_time AS service_time,
            export_vaccine_code AS vaccine_type,
            anc_service_name AS vaccine_name,
            '' AS service_hospcode,
            vaccine_lotno,
            '' AS vaccine_hospcode,
            'บัญชี 2' AS source
    FROM
        {table}person_anc pw
    INNER JOIN {table}person_anc_service pws ON pw.person_anc_id = pws.person_anc_id
    INNER JOIN {table}person_anc_service_detail pwv ON pwv.person_anc_service_id = pws.person_anc_service_id
    INNER JOIN {table}anc_service v ON v.anc_service_id = pwv.anc_service_id
    WHERE length(export_vaccine_code) > 1
        and anc_service_date BETWEEN DATE_ADD(NOW(), INTERVAL - 3 YEAR) AND NOW() UNION ALL SELECT
         null as vn,
            a.person_id,
            vaccine_date as service_date,
            update_datetime as service_time,
            export_vaccine_code AS vaccine_type,
            vaccine_name,
            '' AS service_hospcode,
            vaccine_lotno,
            vaccine_hospcode,
            'elsewhere' AS source
    FROM
         {table}person_vaccine_elsewhere a
    INNER JOIN {table}person_vaccine v ON v.person_vaccine_id = a.person_vaccine_id
    WHERE length(export_vaccine_code) > 1
        and vaccine_date BETWEEN DATE_ADD(NOW(), INTERVAL - 3 YEAR) AND NOW()
                      ";
        $this->gensqlview($sql, 'epi_view');
    }

    //ข้อมูล Cvdrisk
    public function actionCvdrisk() {
        $sql = "SELECT SQL_BIG_RESULT
                    p.cid
                    ,concat(pp.pname,pp.fname,' ',pp.lname) as person_name
                    ,SUBSTR('{table}',4,5) as regplace
                    ,max(p.vstdate) as last_visit
                    ,p.sex
                    ,c.clinic
                    ,timestampdiff(YEAR,pp.birthday,max(p.vstdate)) as age
                    ,SUBSTRING_INDEX(group_concat(if(bps < 1 ,NULL,bps) order by p.vstdate desc),',',1) as bps
                    ,SUBSTRING_INDEX(group_concat(if(tc < 1 ,NULL,tc) order by p.vstdate desc),',',1) as tc
                    ,SUBSTRING_INDEX(group_concat(if(smoking_type_id not in (0,1,2,3,4) ,NULL,smoking_type_id) order by p.vstdate desc),',',1) as smoke
                    FROM {table}vn_stat p
                    INNER JOIN {table}opdscreen s ON s.vn = p.vn AND s.vstdate BETWEEN DATE_ADD(CURDATE(), INTERVAL - 1 YEAR) AND CURDATE() AND s.bps is not null
                    INNER join {table}clinicmember c ON c.hn = s.hn
                    INNER join {table}patient pp ON pp.hn = p.hn
                    WHERE p.vstdate between DATE_ADD(curdate(), INTERVAL -1 YEAR) and curdate()
                    AND (pp.death is null or pp.death ='N')
                    AND c.clinic in ('001','002')
                    AND (c.discharge is null or c.discharge='N')
                    AND right(11-((left(p.cid,1)*13)+(mid(p.cid,2,1)*12)+(mid(p.cid,3,1)*11)+(mid(p.cid,4,1)*10)+(mid(p.cid,5,1)*9)+(mid(p.cid,6,1)*8)+(mid(p.cid,7,1)*7)+(mid(p.cid,8,1)*6)+(mid(p.cid,9,1)*5)+(mid(p.cid,10,1)*4)+(mid(p.cid,11,1)*3)+(mid(p.cid,12,1)*2)) mod 11,1) = right(p.cid,1)
                    AND p.cid not like concat('0',SUBSTR('{table}',4,5),'%')
                    AND (p.pdx between 'E10' and 'E1499' or p.pdx between 'I10' and 'I1599')
                    GROUP BY p.hn";
        $this->gensqlview($sql, 'cvdrisk_view');
    }

    //ข้อมูล Anc
    public function actionPersonanc() {
        $sql = "select SQL_BIG_RESULT cid
            ,p.person_id as pid
            ,SUBSTR('{table}',4,5) as regplace
            ,concat(pname,fname,' ',lname) as person_name
            ,anc_register_date
            ,if((discharge is null || discharge = 'N'),'N','Y') as discharge
            ,if(house_regist_type_id is null || house_regist_type_id not in (1,2,3,4,5) ,'9',house_regist_type_id) as typearea
            ,if(labor_status_id is null || labor_status_id = '','',labor_status_id) as labor_status
            ,ifnull(lmp,'') as lmp
            ,timestampdiff(week,lmp,anc_register_date) as age_preg
            ,ifnull(labor_date,'') as labor_date
            ,ifnull(labour_hospcode,'') as labour_hospcode
            ,ifnull(a.preg_no,'') as preg_no
            ,p.nationality
            ,p.birthdate
            ,timestampdiff(year,birthdate,anc_register_date) as age
            ,ifnull(risk_list,'') as risk_list
            from {table}person_anc a,{table}person p
            where p.person_id = a.person_id
            and anc_register_date is not null
            /*and (discharge is null || discharge = 'N')*/
            and (anc_register_date >= '2013-01-01' or labor_date >= '2013-01-01')
            and anc_register_date <= CURDATE()";
        $this->gensqlview($sql, 'person_anc_view');
    }

    //ข้อมูล Clinic member
    public function actionClinicmember() {
        $sql = "SELECT
                SQL_BIG_RESULT  SUBSTR('{table}',4,5) AS hcode,
                        p.cid,
                        CONCAT(p.pname,p.fname,' ',p.lname) AS patient_name,
                        n.name AS clinic_name,
                        regdate,
                        lastvisit,
                        begin_year,
                        other_chronic_text,
                        has_eye_cormobidity,
                        has_foot_cormobidity,
                        has_cardiovascular_cormobidity,
                        has_cerebrovascular_cormobidity,
                        has_peripheralvascular_cormobidity,
                        has_dental_cormobidity,
                        has_kidney_cormobidity,
                        register_hospcode,
                        discharge,
                        last_hba1c_value,
                        cm.clinic_member_status_name
                        ,cm.provis_typedis
                        ,((IF(ISNULL(DATE_FORMAT(p.deathday,'%Y')), DATE_FORMAT(NOW(),'%Y'),  DATE_FORMAT(p.deathday,'%Y')) - DATE_FORMAT(p.birthday,'%Y')) -   (IF(ISNULL(DATE_FORMAT(p.deathday,'00-%m-%d')), DATE_FORMAT(NOW(),'00-%m-%d'),  DATE_FORMAT(p.deathday,'00-%m-%d')) < DATE_FORMAT(p.birthday,'00-%m-%d'))) AS patient_age_y
                        ,ov1.vstdate AS last_cormobidity_screen_date
                        ,c.clinic as clinic
                        FROM {table}clinicmember c
                        LEFT OUTER JOIN {table}patient p ON p.hn = c.hn
                        LEFT OUTER JOIN {table}clinic n ON n.clinic = c.clinic
                        LEFT OUTER JOIN {table}clinic_member_status cm ON cm.clinic_member_status_id = c.clinic_member_status_id
                        LEFT OUTER JOIN {table}ovst ov1 ON ov1.vn = c.last_cormobidity_screen_vn
                        WHERE c.clinic IN ('001','002')
                        AND (c.discharge IS NULL OR c.discharge='N')
                      ";
        $this->gensqlview($sql, 'clinicmember_view');
    }

    public function actionBeginevent() {
        $sql = "SET GLOBAL event_scheduler = ON;

              DROP EVENT IF EXISTS wmwebmanager;
                CREATE EVENT wmwebmanager
                ON SCHEDULE EVERY 1 DAY
                STARTS '2015-11-03 02:00:00' ON COMPLETION PRESERVE ENABLE
                DO call run_procedure;


                USE `wm_webservice`;
                DROP procedure IF EXISTS `run_procedure`;

                DELIMITER $$
                USE `wm_webservice`$$
                CREATE PROCEDURE `run_procedure` ()
                BEGIN
                call report_service;
                call report_top10opd;
                call dataset;
                END
                $$

                DELIMITER ;

                USE `wm_webservice`;
                DROP procedure IF EXISTS `report_top10opd`;

                DELIMITER $$
                USE `wm_webservice`$$
                CREATE PROCEDURE `report_top10opd` ()
                BEGIN
                DROP TABLE IF EXISTS report_top10opd;
                CREATE TABLE report_top10opd (SELECT SQL_BIG_RESULT
                count(vn) as cc_times
                ,count(DISTINCT cid) as cc
                ,pdx
                ,year(vstdate) as yy
                ,LPAD(month(vstdate),2,'0') as mm
                ,now() as reg_date
                from vn_stat_view
                WHERE vstdate BETWEEN '2010-10-01' AND now()
                and pdx <> ''
                group by pdx,year(vstdate),month(vstdate));
                END
                $$

                DELIMITER ;

            ";
        $this->gensqlview($sql, 'xxxxx');
    }

}
