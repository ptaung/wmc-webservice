<?php

namespace app\modules\webclient\controllers;

use yii\web\Controller;
use yii\data\ArrayDataProvider;
use app\modules\webclient\components\Cdata;
use yii;

class TargetController extends Controller {
    /* เป้าหมายเด็กรณรงค์ 9 18 30 42 เดือน */

    public function actionChilddevcampaign() {
        $q = yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        $query = "
            SELECT
                address
                        ,p.cid
                        ,t.pid
                        ,CONCAT(PRENAME,' ',name,' ',LNAME) AS person_name
                        ,t.birth
                        #,TIMESTAMPDIFF(YEAR,t.birth,now()) as age
                        #,t.age_9
                        ,t.age_18
                        ,t.age_30
                        #,t.age_42
                        #,if(age_18 = 1,18,if(age_30=1,30,'')) as age
                        ,case
                        #when age_42 = 1 then 42
                        when age_30 = 1 then 30
                        when age_18 = 1 then 18
                        #when age_9 = 1 then 9
                        end as age
                        ,date_start
                        ,date_end
                        ,date_serv
                        ,t.TYPEAREA
                        ,NATION
                        ,lat
                        ,lng
                        ,t.hospcode
                        ,d_update
                        ,pass
                FROM t_childdev1830 t
                INNER JOIN t_person p ON p.pid = t.pid and t.hospcode = p.hospcode
                WHERE t.hospcode = '{$hoscode}'
                    #AND (age_18 = 1 or age_30 = 1)
            ";
        $mapKeyword = [
            '{table}' => 'dw_' . $hoscode . '.',
        ];
        $keysearch = [];
        $keymap = [];

        foreach ($mapKeyword as $key => $value) {
            $keysearch[] = $key;
            $keymap[] = $value;
        }
        $query = str_replace($keysearch, $keymap, $query);

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                #'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 1000,
                ],
            ]);
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('childdevcampaign', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels]);
    }

    /* เป้าหมายหญิงตั้งครรภ์ 12 สัปดาห์ */

    public function actionTargetanc12() {

    }

    /* เป้าหมายหญิงคลอดดูแลหลังคลอด 3 ครั้ง */

    public function actionTargetanc3() {
        $q = yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        $year = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] . '-09-30';
        /*
          $query = "SELECT *,(s1+s2+s3) as result
          FROM (SELECT a1.*,nation,
          #CONCAT(prename,' ',name,' ',lname) AS person_name,
          IF (a1.pid in(
          SELECT pid
          FROM report_postnatal pn
          WHERE pn.hospcode=a2.hospcode AND pn.gravida = preg_no
          AND pn.pid=a1.pid AND DATEDIFF(pn.ppcare,labor_date) <=7 ),1,0) s1
          ,IF (a1.pid in(
          SELECT pid
          FROM report_postnatal pn
          WHERE pn.hospcode=a2.hospcode AND pn.gravida = preg_no
          AND pn.pid=a1.pid AND DATEDIFF(pn.ppcare,labor_date) BETWEEN 8 AND 15 ),1,0) s2

          ,IF (a1.pid in(
          SELECT pid
          FROM report_postnatal pn
          WHERE pn.hospcode=a2.hospcode AND pn.gravida = preg_no
          AND pn.pid=a1.pid AND DATEDIFF(pn.ppcare,labor_date) BETWEEN 16 AND 42 ),1,0) s3

          ,IF (a1.pid in(
          SELECT pid
          FROM report_postnatal pn
          WHERE pn.hospcode=a2.hospcode AND pn.gravida = preg_no
          AND pn.pid=a1.pid AND(DATEDIFF(pn.ppcare,labor_date) NOT BETWEEN 0 AND 42) ),1,0) etc

          #(SELECT labor_date as bdate,preg_no as gravida,bresult,a2.*
          FROM report_person_anc a1,t_person a2
          WHERE a1.labor_date BETWEEN '{$serviceDate_start}' AND '{$serviceDate_end}'
          AND a1.regplace = a2.hospcode AND a1.pid = a2.pid
          AND a2.check_typearea in(1,3) AND a2.discharge = 9 AND a2.nation = 99
          AND a2.check_hosp = '{$hoscode}'
          ) t

          ";
         *
         */

        $query = "
            SELECT l.*,p.pid as pid2,
            CONCAT(prename,' ',name,' ',lname) AS person_name,
                IF(a.ppcare1 is not null AND a.ppcare2 is not null AND a.ppcare3 is not null, 1 ,0) as result
                ,a.ppcare1 as s1
                ,a.ppcare2 as s2
                ,a.ppcare3 as s3

                FROM t_labor l
                INNER JOIN t_person_cid p ON l.cid = p.cid
                LEFT JOIN t_postnatal a ON l.cid = a.cid AND l.bdate =a.bdate
                WHERE l.BDATE BETWEEN '{$serviceDate_start}' AND '{$serviceDate_end}'
                AND l.BTYPE NOT IN(6)
                AND p.check_typearea in(1,3) AND p.nation in(99) AND p.discharge IN(9)
                AND p.check_hosp = '{$hoscode}'
                ";

        $mapKeyword = [
            '{table}' => 'dw_' . $hoscode . '.',
        ];
        $keysearch = [];
        $keymap = [];

        foreach ($mapKeyword as $key => $value) {
            $keysearch[] = $key;
            $keymap[] = $value;
        }
        $query = str_replace($keysearch, $keymap, $query);

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                #'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 500,
                ],
            ]);
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('targetanc3', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels]);
    }

    public function TargetAnc3Detail($param) {
        #print_r($param);
        if (is_array($param)) {
            $query = "SELECT *,DATEDIFF(ppcare,bdate) as d FROM report_postnatal WHERE cid='{$param['cid']}' AND bdate='{$param['bdate']}' ORDER BY ppcare ASC LIMIT 5";
            try {
                $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
                $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $result,
                    'sort' => [
                        'attributes' => $attributes,
                    ],
                    'pagination' => [
                        'pageSize' => 500,
                    ],
                ]);
            } catch (\Exception $e) {
                throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
                $dataProvider = new ArrayDataProvider();
            }
            #return $this->renderPartial('_targetanc3-details', ['dataProvider' => $dataProvider]);
            return $dataProvider;
        } else {
            return '<div class="alert alert-danger">No data found</div>';
        }
    }

    /* เป้าหมายหญิงตั้งครรภ์ 5 ครั้งตามเกณฑ์ */

    public function actionTargetanc5() {
        $q = yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        $year = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] . '-09-30';
        $query = "
            SELECT
                CONCAT(prename,' ',name,' ',lname) AS person_name,
                t1.bdate,
                t1.bhosp,
                t1.check_hosp,
                t1.areacode,
                t1.cid,
                t1.pid,
                t1.typearea,
                check_typearea,
                COUNT(DISTINCT t1.cid) AS target,
                SUM(CASE WHEN
                    t2.g1_date IS NOT NULL AND t2.g2_date IS NOT NULL AND t2.g3_date IS NOT NULL
                    AND t2.g4_date IS NOT NULL AND t2.g5_date IS NOT NULL
                    THEN 1 ELSE 0 END) AS 'result',
                t2.g1_date,
                t2.g2_date,
                t2.g3_date,
                t2.g4_date,
                t2.g5_date,
                t1.nation,
                lookuptarget,
                t1.input_bhosp
            FROM
                (SELECT
                    *
                FROM
                    (SELECT
                    a.*, p.check_hosp, p.check_vhid AS areacode,check_typearea,p.prename,p.name,p.lname,ifnull(lookup,'WMC') as lookuptarget
                FROM
                    t_person_anc a
                LEFT JOIN t_person_cid p ON a.cid = p.cid
                WHERE
                    p.check_typearea IN (1 , 3)
                        AND p.DISCHARGE = 9
                        AND (a.bdate BETWEEN '{$serviceDate_start}' AND '{$serviceDate_end}')
                ORDER BY p.check_typearea) AS t3
                GROUP BY t3.check_hosp , t3.cid) AS t1

                LEFT JOIN
                (SELECT
                *
                FROM
                (SELECT
                a.*,p.check_hosp,p.check_vhid AS areacode
                FROM
                t_person_anc a
                LEFT JOIN t_person_cid p ON a.cid=p.cid
                WHERE p.check_typearea IN(1,3) AND p.DISCHARGE = 9
                AND (a.bdate BETWEEN '{$serviceDate_start}' AND '{$serviceDate_end}')
                #AND a.g1_date IS NOT NULL AND a.g2_date IS NOT NULL AND a.g3_date IS NOT NULL AND a.g4_date IS NOT NULL AND a.g5_date IS NOT NULL
                ORDER BY p.check_typearea
                ) AS t4
                GROUP BY t4.check_hosp,t4.cid
                ) AS t2 ON t1.cid=t2.cid

                    LEFT JOIN
                chospital h ON t1.check_hosp = h.hoscode
            WHERE
                t1.check_hosp = '{$hoscode}'
            GROUP BY t1.cid";

        $mapKeyword = [
            '{table}' => 'dw_' . $hoscode . '.',
        ];
        $keysearch = [];
        $keymap = [];

        foreach ($mapKeyword as $key => $value) {
            $keysearch[] = $key;
            $keymap[] = $value;
        }
        $query = str_replace($keysearch, $keymap, $query);

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                #'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 500,
                ],
            ]);
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('targetanc5', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels]);
    }

    /* เป้าหมาย DM */

    public function actionTargetdmht() {

        $q = yii::$app->request->get();

        $amp = (strlen(yii::$app->params['ampcode']) == 4 && empty($q['q_hospcode']) ? strlen(yii::$app->params['ampcode']) : '');
        $amp = Cdata::levelLookup();

        if (strlen($q['q_hospcode']) <> 5) {
            $ampFilter = " AND t.hospcode IN (" . $amp . ")";
        } else {
            $ampFilter = " AND t.hospcode = " . $q['q_hospcode'] . " ";
        }
        if (isset($q['q_hospcode'])) {
            $year = $q['q_byear'] - 1 . '-10-01';
            $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
            $serviceDate_end = $q['q_byear'] . '-09-30';
            $chronic = $q['q_chronic'];
            $limit = '';
        } else {
            $limit = 0;
        }


        $query = "SELECT * FROM (SELECT
                   CONCAT(prename,' ',name,' ',lname) AS person_name,t.*
                   ,p.hn
                   ,if(ld_bp1 between '$serviceDate_start' and '$serviceDate_end',concat(rs_bps1,'/',rs_bpd1),'') as bp1_result
                   ,if(ld_bp2 between '$serviceDate_start' and '$serviceDate_end',concat(rs_bps2,'/',rs_bpd2),'') as bp2_result

                   ,if(ld_hba1c between '$serviceDate_start' and '$serviceDate_end',ld_hba1c,'') as ld_hba1c_result
                   ,if(ld_hba1c between '$serviceDate_start' and '$serviceDate_end',rs_hba1c,'') as rs_hba1c_result
                   ,if(ld_hba1c between '$serviceDate_start' and '$serviceDate_end',ih_hba1c,'') as ih_hba1c_result

                   ,if(ld_retina between '$serviceDate_start' and '$serviceDate_end',ld_retina,'') as ld_retina_result
                   ,if(ld_retina between '$serviceDate_start' and '$serviceDate_end',rs_retina,'') as rs_retina_result
                   ,if(ld_retina between '$serviceDate_start' and '$serviceDate_end',ih_retina,'') as ih_retina_result

                   ,if(ld_foot between '$serviceDate_start' and '$serviceDate_end',ld_foot,'') as ld_foot_result
                   ,if(ld_foot between '$serviceDate_start' and '$serviceDate_end',rs_foot,'') as rs_foot_result
                   ,if(ld_foot between '$serviceDate_start' and '$serviceDate_end',ih_foot,'') as ih_foot_result

                   ,if(ld_fpg1 between '$serviceDate_start' and '$serviceDate_end',ld_fpg1,'') as ld_fpg1_result
                   ,if(ld_fpg1 between '$serviceDate_start' and '$serviceDate_end',rs_fpg1,'') as rs_fpg1_result
                   ,if(ld_fpg1 between '$serviceDate_start' and '$serviceDate_end',ih_fpg1,'') as ih_fpg1_result

                   ,if(ld_fpg2 between '$serviceDate_start' and '$serviceDate_end',ld_fpg2,'') as ld_fpg2_result
                   ,if(ld_fpg2 between '$serviceDate_start' and '$serviceDate_end',rs_fpg2,'') as rs_fpg2_result
                   ,if(ld_fpg2 between '$serviceDate_start' and '$serviceDate_end',ih_fpg2,'') as ih_fpg2_result
                   ,ifnull(lookup,'WMC') as lookuptarget
                   ,case
                    when t_mix_dx = 'I' then 'ความดัน'
                    when t_mix_dx = 'E' then 'เบาหวาน'
                    when t_mix_dx = 'E,I' then 'เบาหวาน,ความดัน'
                    end as t_mix_dx_title

                   #,case when ((type_dx in(1) AND rs_bps1 <140 AND rs_bps2 <140 AND rs_bpd1 <90 AND rs_bpd2 <90 AND ld_bp1 BETWEEN '$serviceDate_start' and '$serviceDate_end') OR (type_dx in(3) AND rs_bps1 <140 AND rs_bps2 <140 AND rs_bpd1 <80 AND rs_bpd2 <80 AND ld_bp1 BETWEEN '$serviceDate_start' and '$serviceDate_end')) THEN 1 ELSE 0 end as ht_control
                   ,case when (control_ht = 1) THEN 1 ELSE 0 end as ht_control
                   #,case when ((type_dx in(2,3) AND rs_hba1c is not null and rs_hba1c < 7 AND ld_hba1c BETWEEN '$serviceDate_start' and '$serviceDate_end') OR (type_dx in(2,3) AND (rs_hba1c is null OR ld_hba1c < '$serviceDate_end') AND rs_fpg1 BETWEEN 70 AND 130 AND ld_fpg1 BETWEEN '$serviceDate_start' and '$serviceDate_end' AND rs_fpg2 BETWEEN 70 AND 130 AND ld_fpg2 BETWEEN '$serviceDate_start' and '$serviceDate_end')) THEN 1 ELSE 0 end as dm_control
                   ,case when (control_dm = 1) THEN 1 ELSE 0 end as dm_control
                   ,case when ld_retina BETWEEN '$serviceDate_start' and '$serviceDate_end' AND rs_retina in (1,2,3,4) THEN 1 ELSE 0 END as eye
                   ,case when ld_foot BETWEEN '$serviceDate_start' and '$serviceDate_end' AND rs_foot in (1,2,3,9) THEN 1 ELSE 0 END as foot

                    FROM
                    t_dmht t
                    LEFT JOIN t_person_cid p ON t.cid = p.cid
                    WHERE p.check_typearea in(1,3) AND p.NATION in(99) AND p.DISCHARGE in(9)
                    " . (!empty($q['q_search']) ? "AND (p.cid LIKE '%{$q['q_search']}%' OR CONCAT(prename,name,' ',lname) LIKE '%{$q['q_search']}%')" : " ") . "

                    {$ampFilter}
                    {chronic}
                    {$limit}) as tt

                    WHERE 1

            ";
        $mapKeyword = [
            '{table}' => 'dw_' . $hoscode . '.',
            '{chronic}' => !empty($chronic) ? " AND type_dx = '{$chronic}'" : ''
        ];
        $keysearch = [];
        $keymap = [];

        foreach ($mapKeyword as $key => $value) {
            $keysearch[] = $key;
            $keymap[] = $value;
        }
        $query = str_replace($keysearch, $keymap, $query);

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->cache(360)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                #'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }
        $target = [];
        foreach ($result as $key => $value) {
            if ($value['lookuptarget'] == 'WMC,HDC')
                ++$target['WMC,HDC'];
            if ($value['lookuptarget'] == 'WMC')
                ++$target['WMC'];
            if ($value['lookuptarget'] == 'HDC')
                ++$target['HDC'];
            if ($value['target'])
                ++$target['target'];
            if ($value['t_mix_dx'] == 'E,I')
                ++$target['DM,HT'];
            if ($value['t_mix_dx'] == 'E')
                ++$target['DM'];
            if ($value['t_mix_dx'] == 'I')
                ++$target['HT'];
            if ($value['ht_control'] == '1')
                ++$target['ht_control'];
            if ($value['dm_control'] == '1')
                ++$target['dm_control'];
            if ($value['eye'] == '1')
                ++$target['eye'];
            if ($value['foot'] == '1')
                ++$target['foot'];
        }

        return $this->render('targetdmht', ['dataProvider' => $dataProvider, 'ampFilter' => $amp, 'target' => $target]);
    }

    public function actionTargetckd() {
        $q = yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        $year = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] . '-09-30';
        $chronic = $q['q_chronic'];
        $query = "SELECT
                   CONCAT(prename,' ',name,' ',lname) AS person_name,t.*,p.hn
                    FROM
                    t_ckd_screen t
                    LEFT JOIN t_person_cid p ON t.cid = p.cid
                    WHERE t.hospcode = '{$hoscode}'
                       " . (!empty($q['q_search']) ? "AND (p.cid LIKE '%{$q['q_search']}%' OR CONCAT(prename,name,' ',lname) LIKE '%{$q['q_search']}%')" : " ") . "

                    {chronic}

            ";
        $mapKeyword = [
            '{table}' => 'dw_' . $hoscode . '.',
            '{chronic}' => !empty($chronic) ? " AND type_dx = '{$chronic}'" : ''
        ];
        $keysearch = [];
        $keymap = [];

        foreach ($mapKeyword as $key => $value) {
            $keysearch[] = $key;
            $keymap[] = $value;
        }
        $query = str_replace($keysearch, $keymap, $query);

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                #'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }
        $target = [];
        foreach ($result as $key => $value) {

            if ($value['cid'])
                ++$target['target'];
            if ($value['minlab_date'] <> '')
                ++$target['result'];
            if ($value['lab11_date'] <> '')
                ++$target['creatinine'];
            if ($value['lab12_date'] <> '')
                ++$target['microalbumin'];

            if ($value['lab14_date'] <> '')
                ++$target['macroalbumin'];
            if ($value['lab15_date'] <> '')
                ++$target['egfr'];
        }

        return $this->render('targetckd', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels, 'target' => $target]);
    }

    public function actionTargetstudent() {
        $q = yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        $year = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] . '-09-30';
        $chronic = $q['q_chronic'];
        $query = "SELECT
                    a1.*
                    ,CASE
                    WHEN school_class LIKE '%อนุบาล%' THEN 1
                    WHEN school_class LIKE '%ประถม%' THEN 2
                    WHEN school_class LIKE '%มัธยม%' THEN 3
                    END AS sort_class
                    ,TIMESTAMPDIFF(YEAR,p.birth,NOW()) AS age_y
                    ,CONCAT(prename,' ',name,' ',lname) AS person_name
                    , AGE_T1
                        , AGE_T2
                        , DATE_SERV1
                        , DATE_SERV2
                        , AGE_MS1
                        , AGE_MS2
                        , WEIGHT1
                        , WEIGHT2
                        , HEIGHT1
                        , HEIGHT2
                  FROM
                    report_student a1
                    LEFT JOIN t_person p ON p.pid = a1.pid AND  p.hospcode = a1.hospcode
                    LEFT JOIN
                      (SELECT
                        CID
                        , AGE_T1
                        , AGE_T2
                        , DATE_SERV1
                        , DATE_SERV2
                        , AGE_MS1
                        , AGE_MS2
                        , WEIGHT1
                        , WEIGHT2
                        , HEIGHT1
                        , HEIGHT2
                        , W_S1
                        , W_S2
                        , H_S1
                        , H_S2
                        , WH1
                        , WH2
                      FROM
                        t_nutrition6up a2
                      UNION
                      SELECT
                        CID
                        , AGE_T1
                        , AGE_T2
                        , DATE_SERV1
                        , DATE_SERV2
                        , AGE_MS1
                        , AGE_MS2
                        , WEIGHT1
                        , WEIGHT2
                        , HEIGHT1
                        , HEIGHT2
                        , W_S1
                        , W_S2
                        , H_S1
                        , H_S2
                        , WH1
                        , WH2
                      FROM
                        t_nutrition05) a2
                      ON a1.cid = a2.cid
                  WHERE a1.hospcode = '{$hoscode}'
                  #AND school_name = 'บ้านจันเดย์'
                   " . (!empty($q['q_search']) ? "AND (p.cid LIKE '%{$q['q_search']}%' OR CONCAT(prename,name,' ',lname) LIKE '%{$q['q_search']}%')" : " ") . "

                  ORDER BY school_name,sort_class,school_class
                    {chronic}

            ";
        $mapKeyword = [
            '{table}' => 'dw_' . $hoscode . '.',
            '{chronic}' => !empty($chronic) ? " AND type_dx = '{$chronic}'" : ''
        ];
        $keysearch = [];
        $keymap = [];

        foreach ($mapKeyword as $key => $value) {
            $keysearch[] = $key;
            $keymap[] = $value;
        }
        $query = str_replace($keysearch, $keymap, $query);

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                #'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 100,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('targetstudent', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels]);
    }

    /*
     * เป้าหมายคัดกรองเบาหวาน
     *
     */

    public function actionTargetdmscreen() {
        $q = yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        #$year = $q['q_byear'] - 1 . '-10-01';
        #$serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        #$serviceDate_end = $q['q_byear'] . '-09-30';
        #$chronic = $q['q_chronic'];
        $query = "SELECT
                   CONCAT(prename,' ',name,' ',lname) AS person_name,t.*,p.hn,groupcode3560
                    FROM
                    t_person_dm_screen t
                    LEFT JOIN t_person_cid p ON t.cid = p.cid
                    LEFT JOIN cage ca ON t.age_y = ca.age
                    WHERE t.hospcode = '{$hoscode}' AND groupcode3560 IN (2,3,4)
                    " . (!empty($q['q_search']) ? "AND (p.cid LIKE '%{$q['q_search']}%' OR CONCAT(prename,name,' ',lname) LIKE '%{$q['q_search']}%')" : " ") . "

            ";

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                #'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        $target = [];
        foreach ($result as $key => $value) {

            ++$target['target'];

            if ($value['date_screen'] <> '' && $value['bslevel'] > 70)
                ++$target['result'];

            if ($value['groupcode3560'] == 4 && $value['bslevel'] > 70 && $value['date_screen'] <> '')
                ++$target['result2'];
            if ($value['groupcode3560'] == 3 && $value['bslevel'] > 70 && $value['date_screen'] <> '')
                ++$target['result1'];
            if ($value['groupcode3560'] == 2 && $value['bslevel'] > 70 && $value['date_screen'] <> '')
                ++$target['result0'];

            if ($value['groupcode3560'] == 4)
                ++$target['age2'];
            if ($value['groupcode3560'] == 3)
                ++$target['age1'];
            if ($value['groupcode3560'] == 2)
                ++$target['age0'];

            if ($value['risk'] > 0)
                ++$target['risk'];
            if ($value['risk'] == 0)
                ++$target['risk0'];
            if ($value['risk'] == 1)
                ++$target['risk1'];
            if ($value['risk'] == 2)
                ++$target['risk2'];

            if ((double) $value['bslevel'] > 70)
                ++$target['bslevel'];
        }


        return $this->render('targetdmscreen', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels, 'target' => @$target]);
    }

    /*
     * เป้าหมายคัดกรองโรคความดันโลหิตสูง
     *
     */

    public function actionTargethtscreen() {
        $q = yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        $query = "SELECT
                   CONCAT(prename,' ',name,' ',lname) AS person_name,t.*,p.hn,groupcode3560
                    FROM
                    t_person_ht_screen t
                    LEFT JOIN t_person_cid p ON t.cid = p.cid
                    LEFT JOIN cage ca ON t.age_y = ca.age
                    WHERE t.hospcode = '{$hoscode}' AND groupcode3560 IN (2,3,4)
                    " . (!empty($q['q_search']) ? "AND (p.cid LIKE '%{$q['q_search']}%' OR CONCAT(prename,name,' ',lname) LIKE '%{$q['q_search']}%')" : " ") . "

            ";

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                #'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        $target = [];
        foreach ($result as $key => $value) {

            ++$target['target'];

            if ($value['sbp_1'] > 50 && $value['dbp_1'] > 50)
                ++$target['result'];

            if ($value['groupcode3560'] == 4 && $value['sbp_1'] > 50 && $value['dbp_1'] > 50)
                ++$target['result2'];
            if ($value['groupcode3560'] == 3 && $value['sbp_1'] > 50 && $value['dbp_1'] > 50)
                ++$target['result1'];
            if ($value['groupcode3560'] == 2 && $value['sbp_1'] > 50 && $value['dbp_1'] > 50)
                ++$target['result0'];

            if ($value['groupcode3560'] == 4)
                ++$target['age2'];
            if ($value['groupcode3560'] == 3)
                ++$target['age1'];
            if ($value['groupcode3560'] == 2)
                ++$target['age0'];


            if ($value['risk'] > 0)
                ++$target['risk'];
            if ($value['risk'] == 0)
                ++$target['risk0'];
            if ($value['risk'] == 1)
                ++$target['risk1'];
            if ($value['risk'] == 2)
                ++$target['risk2'];

            if ((double) $value['bslevel'] > 0)
                ++$target['bslevel'];
        }


        return $this->render('targethtscreen', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels, 'target' => @$target]);
    }

    /*
     * เป้าหมาย EPI 1
     *
     */

    public function actionEpi1() {

        $q = yii::$app->request->get();

        $amp = (strlen(yii::$app->params['ampcode']) == 4 && empty($q['q_hospcode']) ? strlen(yii::$app->params['ampcode']) : '');
        $amp = Cdata::levelLookup();

        if (strlen($q['q_hospcode']) <> 5) {
            $ampFilter = " AND t.hospcode IN (" . $amp . ")";
        } else {
            $ampFilter = " AND t.hospcode = " . $q['q_hospcode'] . " ";
        }


        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        #$year = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_start = $q['q_byear'] - 2 . '-10-01';
        $serviceDate_end = $q['q_byear'] - 1 . '-09-30';

        $birth = [$serviceDate_start, $serviceDate_end];

        $query = "SELECT
                   CONCAT(prename,' ',name,' ',lname) AS person_name,a.*
                   ,case when(bcg_date is not null && hbv1_date is not null && dtp3_date is not null && opv3_date is not null && mmr1_date is not null) then 1 else 0 end as point
                    FROM
                    t_person_cid p
                    LEFT JOIN t_person_epi a ON a.cid = p.cid
                    WHERE p.hospcode = '{$hoscode}'
                        AND a.cid IS NOT NULL
                        AND p.check_typearea in(1,3) AND p.DISCHARGE = 9
                        AND (p.birth BETWEEN '{$serviceDate_start}' AND '{$serviceDate_end}')
            ";

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                #'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        $target = [];
        foreach ($result as $key => $value) {

            ++$target['target'];

            if ($value['bcg_date'] <> '')
                ++$target['bcg'];

            if ($value['hbv1_date'] <> '')
                ++$target['hbv1'];

            if ($value['dtp3_date'] <> '')
                ++$target['dtp3'];

            if ($value['opv3_date'] <> '')
                ++$target['opv3'];

            if ($value['mmr1_date'] <> '')
                ++$target['mmr1'];
        }

        return $this->render('epi1', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels, 'target' => @$target, 'birth' => $birth]);
    }

    public function actionEpi1detail() {
        $cid = yii::$app->request->get('cid');
        $query = "SELECT *,DATEDIFF(service_date,birth) as d,v.*
            FROM report_epi e
            LEFT JOIN cvaccinetype v ON v.vaccinecode = vaccine_type
WHERE cid='{$cid}' AND vaccine_type IN ('010','061','083','041','033','093') ORDER BY service_date ASC ,vaccine_type ASC";
        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 500,
                ],
            ]);
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }
        return $this->renderAjax('_epi1-details', ['dataProvider' => $dataProvider]);
    }

    /*
     * เป้าหมาย EPI 2
     *
     */

    public function actionEpi2() {
        $q = yii::$app->request->get();

        $amp = (strlen(yii::$app->params['ampcode']) == 4 && empty($q['q_hospcode']) ? strlen(yii::$app->params['ampcode']) : '');
        $amp = Cdata::levelLookup();

        if (strlen($q['q_hospcode']) <> 5) {
            $ampFilter = " AND t.hospcode IN (" . $amp . ")";
        } else {
            $ampFilter = " AND t.hospcode = " . $q['q_hospcode'] . " ";
        }

        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        $serviceDate_start = $q['q_byear'] - 3 . '-10-01';
        $serviceDate_end = $q['q_byear'] - 2 . '-09-30';

        $birth = [$serviceDate_start, $serviceDate_end];

        $query = "SELECT
                   CONCAT(prename,' ',name,' ',lname) AS person_name,a.*
                   ,case when dtp4_date is not null && opv4_date is not null &&
                   ((je1_date is not null && je2_date is not null && je2_date > je1_date) || j11_date is not null) then 1 else 0 end as point
                    FROM
                    t_person_cid p
                    LEFT JOIN t_person_epi a ON a.cid = p.cid
                    WHERE p.hospcode = '{$hoscode}'
                        AND a.cid IS NOT NULL
                        AND p.check_typearea in(1,3) AND p.DISCHARGE = 9
                        AND (p.birth BETWEEN '{$serviceDate_start}' AND '{$serviceDate_end}')
            ";

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        $target = [];
        foreach ($result as $key => $value) {

            ++$target['target'];

            if ($value['dtp4_date'] <> '')
                ++$target['dtp4'];

            if ($value['opv4_date'] <> '')
                ++$target['opv4'];

            if ($value['je1_date'] <> '')
                ++$target['je1'];
            if ($value['je2_date'] <> '')
                ++$target['je2'];
            if ($value['j11_date'] <> '')
                ++$target['j11'];

            if ($value['point'] == '1')
                ++$target['je'];
        }

        return $this->render('epi2', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels, 'target' => @$target, 'birth' => $birth]);
    }

    public function actionEpi2detail() {
        $cid = yii::$app->request->get('cid');
        $query = "SELECT *,DATEDIFF(service_date,birth) as d,v.*
            FROM report_epi e
            LEFT JOIN cvaccinetype v ON v.vaccinecode = vaccine_type
WHERE cid='{$cid}' AND vaccine_type IN ('034','084','051','052','J11') ORDER BY service_date ASC ,vaccine_type ASC";
        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 500,
                ],
            ]);
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }
        return $this->renderAjax('_epi2-details', ['dataProvider' => $dataProvider]);
    }

    /*
     * เป้าหมาย EPI 3
     *
     */

    public function actionEpi3() {
        $q = yii::$app->request->get();

        $amp = (strlen(yii::$app->params['ampcode']) == 4 && empty($q['q_hospcode']) ? strlen(yii::$app->params['ampcode']) : '');
        $amp = Cdata::levelLookup();

        if (strlen($q['q_hospcode']) <> 5) {
            $ampFilter = " AND t.hospcode IN (" . $amp . ")";
        } else {
            $ampFilter = " AND t.hospcode = " . $q['q_hospcode'] . " ";
        }

        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        $serviceDate_start = $q['q_byear'] - 4 . '-10-01';
        $serviceDate_end = $q['q_byear'] - 3 . '-09-30';

        $birth = [$serviceDate_start, $serviceDate_end];

        $query = "SELECT
                   CONCAT(prename,' ',name,' ',lname) AS person_name,a.*
                    ,CASE WHEN (mmr2_date is not null && ((je1_date is not null AND je2_date is not null AND je3_date is not null
                    AND je3_date > je2_date AND je2_date > je1_date)
                    or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
                    or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
                    or (j11_date is not null AND je1_date is not null AND je1_date > j11_date )))
                    THEN 1 ELSE 0 END point
                     ,CASE WHEN ((je1_date is not null AND je2_date is not null AND je3_date is not null
                    AND je3_date > je2_date AND je2_date > je1_date)
                    or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
                    or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
                    or (j11_date is not null AND je1_date is not null AND je1_date > j11_date ))
                    THEN 1 ELSE 0 END je,
                    if((CASE WHEN ((je1_date is not null AND je2_date is not null AND je3_date is not null
                    AND je3_date > je2_date AND je2_date > je1_date)
                    or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
                    or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
                    or (j11_date is not null AND je1_date is not null AND je1_date > j11_date ))
                    THEN 1 ELSE 0 END) = 0
                    ,CASE WHEN (je1_date is not null AND je2_date is not null AND je3_date is not null AND je2_date <= je1_date) THEN 'วันที่ได้รับวัคซีน JE1 หลังหรือเท่ากับ JE2 ซึ่งไม่ถูกต้องตามที่ควรจะได้รับ'
                    WHEN (je1_date is not null AND je2_date is not null AND je3_date is not null AND je3_date <= je2_date) THEN 'วันที่ได้รับวัคซีน JE2 หลังหรือเท่ากับ JE3 ซึ่งไม่ถูกต้องตามที่ควรจะได้รับ'
                    WHEN (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date <= je1_date) THEN 'วันที่ได้รับวัคซีน JE2 ก่อนหรือเท่ากับ JE1 ซึ่งไม่ถูกต้องตามที่ควรจะได้รับ'
                    WHEN (je1_date is not null AND je2_date is not null AND j11_date is not null AND j11_date <= je2_date) THEN 'วันที่ได้รับวัคซีน J11 ก่อนหรือเท่ากับ JE2 ซึ่งไม่ถูกต้องตามที่ควรจะได้รับ'
                    WHEN (j11_date is not null AND j12_date is not null AND j12_date <= j11_date) THEN 'วันที่ได้รับวัคซีน J12 ก่อนหรือเท่ากับ J11 ซึ่งไม่ถูกต้องตามที่ควรจะได้รับ'
                    WHEN (j11_date is not null AND je1_date is not null AND je1_date <= j11_date ) THEN 'วันที่ได้รับวัคซีน JE1 ก่อนหรือเท่ากับ J11 ซึ่งไม่ถูกต้องตามที่ควรจะได้รับ'
                    ELSE 'ได้รับวัคซีนไม่ครบ' END,'') as etc
                    FROM
                    t_person_cid p
                    LEFT JOIN t_person_epi a ON a.cid = p.cid
                    WHERE p.hospcode = '{$hoscode}'
                        AND a.cid IS NOT NULL
                        AND p.check_typearea in(1,3) AND p.DISCHARGE = 9
                        AND (p.birth BETWEEN '{$serviceDate_start}' AND '{$serviceDate_end}')
            ";

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        $target = [];
        foreach ($result as $key => $value) {


            ++$target['target'];

            if ($value['mmr2_date'] <> '')
                ++$target['mmr2'];

            if ($value['je'] == 1)
                ++$target['je'];

            if ($value['je1_date'] <> '')
                ++$target['je1'];
            if ($value['je2_date'] <> '')
                ++$target['je2'];
            if ($value['je3_date'] <> '')
                ++$target['je3'];
            if ($value['j11_date'] <> '')
                ++$target['j11'];
            if ($value['j12_date'] <> '')
                ++$target['j12'];

            if ($value['point'] == '1')
                ++$target['result'];
        }

        return $this->render('epi3', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels, 'target' => @$target, 'birth' => $birth]);
    }

    public function actionEpi3detail() {
        $cid = yii::$app->request->get('cid');
        $query = "SELECT *,DATEDIFF(service_date,birth) as d,v.*
            FROM report_epi e
            LEFT JOIN cvaccinetype v ON v.vaccinecode = vaccine_type
WHERE cid='{$cid}' AND vaccine_type IN ('073','051','052','053','J11','J12') ORDER BY service_date ASC,vaccine_type ASC";
        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 500,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }
        return $this->renderAjax('_epi3-details', ['dataProvider' => $dataProvider]);
    }

    /*
     * เป้าหมาย EPI 5
     *
     */

    public function actionEpi5() {
        $q = yii::$app->request->get();

        $amp = (strlen(yii::$app->params['ampcode']) == 4 && empty($q['q_hospcode']) ? strlen(yii::$app->params['ampcode']) : '');
        $amp = Cdata::levelLookup();

        if (strlen($q['q_hospcode']) <> 5) {
            $ampFilter = " AND t.hospcode IN (" . $amp . ")";
        } else {
            $ampFilter = " AND t.hospcode = " . $q['q_hospcode'] . " ";
        }

        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        $serviceDate_start = $q['q_byear'] - 6 . '-10-01';
        $serviceDate_end = $q['q_byear'] - 5 . '-09-30';

        $birth = [$serviceDate_start, $serviceDate_end];

        $query = "SELECT
                   CONCAT(prename,' ',name,' ',lname) AS person_name,a.*
                    ,CASE WHEN (opv5_date is not null && dtp5_date is not null) THEN 1 ELSE 0 END point
                    ,'' as etc
                    FROM
                    t_person_cid p
                    LEFT JOIN t_person_epi a ON a.cid = p.cid
                    WHERE p.hospcode = '{$hoscode}'
                        AND a.cid IS NOT NULL
                        AND p.check_typearea in(1,3) AND p.DISCHARGE = 9
                        AND (p.birth BETWEEN '{$serviceDate_start}' AND '{$serviceDate_end}')
            ";

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        $target = [];
        foreach ($result as $key => $value) {


            ++$target['target'];

            if ($value['opv5_date'] <> '')
                ++$target['opv5'];
            if ($value['dtp5_date'] <> '')
                ++$target['dtp5'];

            if ($value['point'] == '1')
                ++$target['result'];
        }

        return $this->render('epi5', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels, 'target' => @$target, 'birth' => $birth]);
    }

    public function actionEpi5detail() {
        $cid = yii::$app->request->get('cid');
        $query = "SELECT *,DATEDIFF(service_date,birth) as d,v.*
            FROM report_epi e
            LEFT JOIN cvaccinetype v ON v.vaccinecode = vaccine_type
WHERE cid='{$cid}' AND vaccine_type IN ('035','085') ORDER BY service_date ASC ,vaccine_type ASC";
        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 500,
                ],
            ]);
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }
        return $this->renderAjax('_epi5-details', ['dataProvider' => $dataProvider]);
    }

    /*
     * เป้าหมาย คัดกรองเต้านม
     *
     */

    public function actionBreastscreen() {
        $q = yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] - 0 . '-09-30';

        $birth = [$serviceDate_start, $serviceDate_end];

        $query = "SELECT
                   CONCAT(prename,' ',name,' ',lname) AS person_name,p.cid
                   ,CASE WHEN age(a.date_serv,p.birth,'y') BETWEEN 30 AND 70 THEN 1 ELSE 0 END point
                    ,birth
                    ,p.age_y
                    ,p.pid
                    ,CASE WHEN age(a.date_serv,p.birth,'y') BETWEEN 30 AND 70 THEN date_serv ELSE '' END dserv
                    ,'' as etc
                    ,a.hospcode
                    FROM
                    t_person_cid p
                    LEFT JOIN report_diag_opd a ON a.cid = p.cid AND diagcode in('Z123') AND a.date_serv BETWEEN '{$serviceDate_start}' AND '{$serviceDate_end}'
                    WHERE p.hospcode = '{$hoscode}'
                        AND p.age_y BETWEEN 30 AND 70
                        AND p.check_typearea in(1,3)
                        AND p.DISCHARGE = 9
                        AND p.nation = 99
                        AND p.sex = 2
            ";

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        $target = [];
        foreach ($result as $key => $value) {


            ++$target['target'];
            /*
              if ($value['opv5_date'] <> '')
              ++$target['opv5'];
              if ($value['dtp5_date'] <> '')
              ++$target['dtp5'];
             */
            if ($value['point'] == '1')
                ++$target['result'];
        }

        return $this->render('breastscreen', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels, 'target' => @$target, 'birth' => $birth]);
    }

    /*
     * เป้าหมาย คัดกรองเต้านม
     *
     */

    public function actionCervixscreen() {
        $q = yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] - 0 . '-09-30';

        $birth = [$serviceDate_start, $serviceDate_end];

        $query = "SELECT
                   CONCAT(prename,' ',name,' ',lname) AS person_name,p.cid
                   ,CASE WHEN age(a.date_serv,p.birth,'y') BETWEEN 30 AND 60 THEN 1 ELSE 0 END point
                    ,birth
                    ,p.age_y
                    ,p.pid
                    ,CASE WHEN age(a.date_serv,p.birth,'y') BETWEEN 30 AND 60 THEN date_serv ELSE '' END dserv
                    ,'' as etc
                    ,a.hospcode
                    FROM
                    t_person_cid p
                    LEFT JOIN report_diag_opd a ON a.cid = p.cid AND diagcode in('Z014','Z124') AND a.date_serv BETWEEN '{$serviceDate_start}' AND '{$serviceDate_end}'
                    WHERE p.hospcode = '{$hoscode}'
                        AND p.age_y BETWEEN 30 AND 60
                        AND p.check_typearea in(1,3)
                        AND p.DISCHARGE = 9
                        AND p.nation = 99
                        AND p.sex = 2
            ";

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        $target = [];
        foreach ($result as $key => $value) {


            ++$target['target'];
            /*
              if ($value['opv5_date'] <> '')
              ++$target['opv5'];
              if ($value['dtp5_date'] <> '')
              ++$target['dtp5'];
             */
            if ($value['point'] == '1')
                ++$target['result'];
        }

        return $this->render('cervixscreen', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels, 'target' => @$target, 'birth' => $birth]);
    }

    /*
     * เป้าหมาย เด็กวัยเรียน สูงดีสมส่วน
     *
     */

    public function actionNutrition() {
        $q = yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] - 0 . '-09-30';

        $birth = [$serviceDate_start, $serviceDate_end];

        $query = "SELECT
                   CONCAT(prename,' ',name,' ',lname) AS person_name,p.cid
                   ,CASE WHEN TIMESTAMPDIFF(YEAR,a.birth,a.date_serv) BETWEEN 6 AND 14 && (DATE_FORMAT(a.date_serv,'%m') IN(10,11) && DATE_FORMAT(a.date_serv,'%m') IN(5,6)) THEN 1 ELSE 0 END point
                    ,p.birth
                    ,p.age_y
                    ,p.pid
                    ,CASE WHEN TIMESTAMPDIFF(YEAR,a.birth,a.date_serv) BETWEEN 6 AND 14 && DATE_FORMAT(a.date_serv,'%m') IN(10,11) THEN date_serv ELSE '' END dserv1
                    ,CASE WHEN TIMESTAMPDIFF(YEAR,a.birth,a.date_serv) BETWEEN 6 AND 14 && DATE_FORMAT(a.date_serv,'%m') IN(5,6) THEN date_serv ELSE '' END dserv2
                    ,'' as etc
                    ,a.hospcode
                    FROM t_childdev_specialpp a
                    LEFT JOIN t_person_cid p ON a.hospcode = p.hospcode AND a.pid = p.pid
                    WHERE p.hospcode = '{$hoscode}'
                        AND p.age_y BETWEEN 6 AND 14
                        AND p.DISCHARGE = 9
                    GROUP BY p.pid

            ";

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]);
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        $target = [];
        foreach ($result as $key => $value) {


            ++$target['target'];
            /*
              if ($value['opv5_date'] <> '')
              ++$target['opv5'];
              if ($value['dtp5_date'] <> '')
              ++$target['dtp5'];
             */
            if ($value['point'] == '1')
                ++$target['result'];
        }

        return $this->render('nutrition', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels, 'target' => @$target, 'birth' => $birth]);
    }

    /*
     * เป้าหมาย คัดกรองเด็ก
     *
     */

    public function actionPpspecial() {
        $q = yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : yii::$app->user->identity->profile->hospcode);
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] - 0 . '-09-30';

        $birth = [$serviceDate_start, $serviceDate_end];

        $query = "SELECT
                   CONCAT(prename,' ',name,' ',lname) AS person_name
                    ,p.birth
                    ,p.age_y
                    ,p.pid
                    ,'' as etc
                    ,p.hospcode
                    ,if(status1 in (1,2,3),1,0) as point
                    ,if(now() between date_start and date_end,'อยู่ในช่วงประเมิน','') as mustscreen
                    ,s.*
                    FROM
                    t_childdev_specialpp s
                    INNER JOIN t_person_cid p ON s.cid = p.cid
                    WHERE p.hospcode = '{$hoscode}'
                        AND p.check_typearea in(1,3)
                        AND p.NATION in(99)
                        AND p.DISCHARGE in(9)
                        AND s.date_start BETWEEN '{$serviceDate_start}' AND '{$serviceDate_end}'

            ";

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                    'defaultOrder' => ['date_start' => SORT_ASC, 'date_end' => SORT_ASC]
                ],
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]);
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        $target = [];
        foreach ($result as $key => $value) {


            ++$target['target'];

            if ($value['agemonth'] == 42)
                ++$target['age42'];
            if ($value['agemonth'] == 30)
                ++$target['age30'];
            if ($value['agemonth'] == 18)
                ++$target['age18'];
            if ($value['agemonth'] == 9)
                ++$target['age9'];

            if ($value['agemonth'] == 42 && in_array($value['status1'], [1, 2, 3]))
                ++$target['s_age42'];
            if ($value['agemonth'] == 30 && in_array($value['status1'], [1, 2, 3]))
                ++$target['s_age30'];
            if ($value['agemonth'] == 18 && in_array($value['status1'], [1, 2, 3]))
                ++$target['s_age18'];
            if ($value['agemonth'] == 9 && in_array($value['status1'], [1, 2, 3]))
                ++$target['s_age9'];

            if ($value['point'] == '1')
                ++$target['result'];
        }

        return $this->render('ppspecial', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels, 'target' => @$target, 'birth' => $birth]);
    }

    public function actionPpspecialdetail() {
        $cid = yii::$app->request->get('cid');
        $query = "SELECT e.* #,DATEDIFF(service_date,birth) as d,v.*
            FROM report_specialpp e
            INNER JOIN t_person p ON e.hospcode = p.hospcode and  e.pid = p.pid
            WHERE cid='{$cid}'  ORDER BY date_serv ASC";

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 500,
                ],
            ]);
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }
        return $this->renderAjax('_ppspecial-details', ['dataProvider' => $dataProvider]);
    }

}
