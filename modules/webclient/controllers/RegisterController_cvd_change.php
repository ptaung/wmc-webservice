<?php

namespace app\modules\webclient\controllers;

use yii\web\Controller;
use app\modules\webclient\components\Cwebclient;
use app\models\Chospital;
use app\models\Ctambon;
use app\modules\webclient\models\WuseGroupLocal;
use app\modules\webclient\models\WuseItemsLocal;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;

class RegisterController extends Controller {
    #รายชื่อพัฒนาการเด็ก

    public function actionChilddev1830() {
        $q = \Yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : \Yii::$app->user->identity->profile->hospcode);
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
            $result = \Yii::$app->db_datacenter->createCommand($query)->queryAll();
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

        return $this->render('childdev1830', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels]);
    }

    public function actionThaicvdrisksummary() {
        $q = \Yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : \Yii::$app->user->identity->profile->hospcode);
        $year = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] . '-09-30';

        $query = "SELECT
    *
FROM
(SELECT
    *,
    IFNULL((SELECT
            color
        FROM
            colorchart_th c
        WHERE
            c.has = t.has
                AND c.chronic = t.chronic
                AND c.sex = t.sex
                AND c.age = t.age
                AND c.smoke = t.smoke
                AND c.bp = t.bp
                AND c.cholesterol = t.cholesterol
                AND c.wh_2 = t.wh_2),0) AS result
FROM
    (SELECT
        hospcode,
            cid,
            person_name,
            typearea,
            areacode,
            cc,
            age_y,
            dm,
            ht,
            dmht,
            waist,
            smoking,
            height,
            bps,

            vstdate,
            tc,
            IF(tc < 1,IF(waist > (height / 2) AND waist > 0 AND height > 0, 'M',IF(waist < (height / 2) AND waist > 0 AND height > 0, 'L',IF(waist > 0 AND height > 0, 'N',''))), 'N') AS wh_2,
            IF(age_y >= 65, 65, IF(age_y >= 60, 60, IF(age_y >= 55, 55, IF(age_y >= 50, 50, 40)))) AS age,
            IF((dmht + dm) > 0, 'Y', 'N') AS chronic,
            IF(smoking = 1, 'Y',IF(smoking = 0,'N','N')) AS smoke,
            IF(tc > 0, 'Y', 'N') AS has,
            sex,
            IF(tc >= 320, 320, IF(tc >= 280, 280, IF(tc >= 240, 240, IF(tc >= 200, 200,IF(tc < 200 && tc > 0,160,160))))) AS cholesterol,
            IF(bps >= 180, 180, IF(bps >= 160, 160, IF(bps >= 140, 140,IF(bps < 140 && bps > 0,120,0)))) AS bp
    FROM
        (SELECT
            GROUP_CONCAT(DISTINCT t.hospcode ORDER BY vstdate DESC) as hospcode ,
            t.cid,
            person_name,
            typearea,
            areacode,
            t.sex,
            MAX(t.age_y) AS age_y,
            SUM(dm) AS dm,
            SUM(ht) AS ht,
            SUM(dmht) AS dmht,
            SUM(cc) AS cc,
            MAX(vstdate) AS vstdate,

            SUBSTRING_INDEX(GROUP_CONCAT(IF(bps > 0 && bps IS NOT NULL, bps, 0)
                ORDER BY vstdate DESC), ',', 1) AS bps,
            SUBSTRING_INDEX(GROUP_CONCAT(IF(height > 0 && height IS NOT NULL, height, 0)
                ORDER BY vstdate DESC), ',', 1) AS height,
            SUBSTRING_INDEX(GROUP_CONCAT(IF(waist > 0 && waist IS NOT NULL, waist, 0)
                ORDER BY vstdate DESC), ',', 1) AS waist,
            SUBSTRING_INDEX(GROUP_CONCAT(IF(tc > 0 && tc IS NOT NULL, tc, '-')
                ORDER BY vstdate DESC), ',', 1) AS tc,
            SUBSTRING_INDEX(GROUP_CONCAT(smoking ORDER BY vstdate DESC), ',', 1) AS smoking
    FROM
        report_thaicvdrisk t
    WHERE
       #t.hospcode = '{$hoscode}'
           1
            AND yymm BETWEEN '201510' AND '" . date('Ym') . "'
            {areacode}
    GROUP BY cid) t2) t) t2

                     ";
        $mapKeyword = [
            '{table}' => 'dw_' . $hoscode . '.',
            '{areacode}' => " AND areacode LIKE '{$q['q_ampurcode']}%' "
        ];
        $keysearch = [];
        $keymap = [];

        foreach ($mapKeyword as $key => $value) {
            $keysearch[] = $key;
            $keymap[] = $value;
        }
        $query = str_replace($keysearch, $keymap, $query);

        try {
            $result = \Yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 100,
                ],
            ]);
            $cvd = [];
            foreach ($result as $key => $rows) {

                if ($rows['result'] == 0)
                    $cvd[0] += 1;
                if ($rows['result'] == 1)
                    $cvd[1] += 1;
                if ($rows['result'] == 2)
                    $cvd[2] += 1;
                if ($rows['result'] == 3)
                    $cvd[3] += 1;
                if ($rows['result'] == 4)
                    $cvd[4] += 1;
                if ($rows['result'] == 5)
                    $cvd[5] += 1;

                $data[$key][] = [
                    $rows[$c],
                ];
            }
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('thaicvdrisksummary', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels, 'cvd' => $cvd]);
    }

    public function actionThaicvdrisk() {
        $q = \Yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : \Yii::$app->user->identity->profile->hospcode);
        $year = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] . '-09-30';

        $query = "SELECT
    *
FROM
(SELECT
    *,
    IFNULL((SELECT
            color
        FROM
            colorchart_th c
        WHERE
            c.has = t.has
                AND c.chronic = t.chronic
                AND c.sex = t.sex
                AND c.age = t.age
                AND c.smoke = t.smoke
                AND c.bp = t.bp
                AND c.cholesterol = t.cholesterol
                AND c.wh_2 = t.wh_2),0) AS result
FROM
    (SELECT
        hospcode,
            cid,
            person_name,
            typearea,
            areacode,
            lat,
            lng,
            cc,
            age_y,
            dm,
            ht,
            dmht,
            waist,
            smoking,
            height,
            bps,
            address,
            #address_name,
            vstdate,
            tc,
            IF(tc < 1,IF(waist > (height / 2) AND waist > 0 AND height > 0, 'M',IF(waist < (height / 2) AND waist > 0 AND height > 0, 'L',IF(waist > 0 AND height > 0, 'N',''))), 'N') AS wh_2,
            IF(age_y >= 65, 65, IF(age_y >= 60, 60, IF(age_y >= 55, 55, IF(age_y >= 50, 50, 40)))) AS age,
            IF((dmht + dm) > 0, 'Y', 'N') AS chronic,
            IF(smoking = 1, 'Y',IF(smoking = 0,'N','N')) AS smoke,
            IF(tc > 0, 'Y', 'N') AS has,
            sex,
            IF(tc >= 320, 320, IF(tc >= 280, 280, IF(tc >= 240, 240, IF(tc >= 200, 200,IF(tc < 200 && tc > 0,160,160))))) AS cholesterol,
            IF(bps >= 180, 180, IF(bps >= 160, 160, IF(bps >= 140, 140,IF(bps < 140 && bps > 0,120,0)))) AS bp,
            IF(regdate is not null,regdate,null) as stroke
    FROM
        (SELECT
            GROUP_CONCAT(DISTINCT t.hospcode ORDER BY vstdate DESC) as hospcode ,
            t.cid,
            person_name,
            typearea,
            areacode,
            h.latitude as lat,
            h.longitude as lng,
            #lat,
            #lng,
            t.sex,
            #t.address,
            CONCAT(h.address,' หมู่ ',village_moo,' ',v.village_name) AS address,
            MAX(t.age_y) AS age_y,
            SUM(dm) AS dm,
            SUM(ht) AS ht,
            SUM(dmht) AS dmht,
            SUM(cc) AS cc,
            MAX(vstdate) AS vstdate,


            SUBSTRING_INDEX(GROUP_CONCAT(IF(bps > 0 && bps IS NOT NULL, bps, 0)
                ORDER BY vstdate DESC), ',', 1) AS bps,
            SUBSTRING_INDEX(GROUP_CONCAT(IF(height > 0 && height IS NOT NULL, height, 0)
                ORDER BY vstdate DESC), ',', 1) AS height,
            SUBSTRING_INDEX(GROUP_CONCAT(IF(waist > 0 && waist IS NOT NULL, waist, 0)
                ORDER BY vstdate DESC), ',', 1) AS waist,
            SUBSTRING_INDEX(GROUP_CONCAT(IF(tc > 0 && tc IS NOT NULL, tc, '-')
                ORDER BY vstdate DESC), ',', 1) AS tc,
            SUBSTRING_INDEX(GROUP_CONCAT(smoking ORDER BY vstdate DESC), ',', 1) AS smoking,
            regdate
    FROM
        report_thaicvdrisk t
        INNER JOIN {table}person p ON p.cid = t.cid AND p.house_regist_type_id IN (1,3)
        LEFT JOIN {table}house h ON p.house_id = h.house_id
        LEFT JOIN {table}village v ON v.village_id = h.village_id
        LEFT JOIN (SELECT * FROM report_stroke WHERE regdate BETWEEN '2015-10-01' AND NOW() ) s ON s.cid = p.cid
    WHERE
       #t.hospcode = '{$hoscode}'
            1
            AND yymm BETWEEN '201510' AND '" . date('Ym') . "'
            {areacode}
    GROUP BY cid) t2) t) t2

                     ";
        $mapKeyword = [
            '{table}' => 'dw_' . $hoscode . '.',
            '{areacode}' => " AND areacode LIKE '{$dataCampur}%' "
        ];
        $keysearch = [];
        $keymap = [];

        foreach ($mapKeyword as $key => $value) {
            $keysearch[] = $key;
            $keymap[] = $value;
        }
        $query = str_replace($keysearch, $keymap, $query);

        try {
            $result = \Yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 100,
                ],
            ]);
            $cvd = [];
            foreach ($result as $key => $rows) {

                if ($rows['result'] == 0)
                    $cvd[0] += 1;
                if ($rows['result'] == 1)
                    $cvd[1] += 1;
                if ($rows['result'] == 2)
                    $cvd[2] += 1;
                if ($rows['result'] == 3)
                    $cvd[3] += 1;
                if ($rows['result'] == 4)
                    $cvd[4] += 1;
                if ($rows['result'] == 5)
                    $cvd[5] += 1;

                $data[$key][] = [
                    $rows[$c],
                ];
            }
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('thaicvdrisk', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels, 'cvd' => $cvd]);
    }

    public function actionThaicvdriskscreen() {
        $q = \Yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : \Yii::$app->user->identity->profile->hospcode);
        $year = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] . '-09-30';

        $query = "SELECT
    *
FROM
(SELECT
    *,
    IFNULL((SELECT
            color
        FROM
            colorchart_th c
        WHERE
            c.has = t.has
                AND c.chronic = t.chronic
                AND c.sex = t.sex
                AND c.age = t.age
                AND c.smoke = t.smoke
                AND c.bp = t.bp
                AND c.cholesterol = t.cholesterol
                AND c.wh_2 = t.wh_2),0) AS result
FROM
    (SELECT
        hospcode,
            cid,
            person_name,
            typearea,
            areacode,
            lat,
            lng,
            cc,
            age_y,
            dm,
            ht,
            dmht,
            waist,
            smoking,
            height,
            bps,
            address,
            #address_name,
            vstdate,
            tc,
            IF(tc < 1,IF(waist > (height / 2) AND waist > 0 AND height > 0, 'M',IF(waist < (height / 2) AND waist > 0 AND height > 0, 'L',IF(waist > 0 AND height > 0, 'N',''))), 'N') AS wh_2,
            IF(age_y >= 65, 65, IF(age_y >= 60, 60, IF(age_y >= 55, 55, IF(age_y >= 50, 50, 40)))) AS age,
            IF((dmht + dm) > 0, 'Y', 'N') AS chronic,
            IF(smoking = 1, 'Y',IF(smoking = 0,'N','N')) AS smoke,
            IF(tc > 0, 'Y', 'N') AS has,
            sex,
            IF(tc >= 320, 320, IF(tc >= 280, 280, IF(tc >= 240, 240, IF(tc >= 200, 200,IF(tc < 200 && tc > 0,160,160))))) AS cholesterol,
            IF(bps >= 180, 180, IF(bps >= 160, 160, IF(bps >= 140, 140,IF(bps < 140 && bps > 0,120,0)))) AS bp
    FROM
        (SELECT
            GROUP_CONCAT(DISTINCT t.hospcode ORDER BY vstdate DESC) as hospcode ,
            t.cid,
            person_name,
            typearea,
            areacode,
            h.latitude as lat,
            h.longitude as lng,
            #lat,
            #lng,
            t.sex,
            #t.address,
            CONCAT(h.address,' หมู่ ',village_moo,' ',v.village_name) AS address,
            MAX(t.age_y) AS age_y,
            SUM(dm) AS dm,
            SUM(ht) AS ht,
            SUM(dmht) AS dmht,
            SUM(cc) AS cc,
            MAX(vstdate) AS vstdate,


            SUBSTRING_INDEX(GROUP_CONCAT(IF(bps > 0 && bps IS NOT NULL, bps, 0)
                ORDER BY vstdate DESC), ',', 1) AS bps,
            SUBSTRING_INDEX(GROUP_CONCAT(IF(height > 0 && height IS NOT NULL, height, 0)
                ORDER BY vstdate DESC), ',', 1) AS height,
            SUBSTRING_INDEX(GROUP_CONCAT(IF(waist > 0 && waist IS NOT NULL, waist, 0)
                ORDER BY vstdate DESC), ',', 1) AS waist,
            SUBSTRING_INDEX(GROUP_CONCAT(IF(tc > 0 && tc IS NOT NULL, tc, '-')
                ORDER BY vstdate DESC), ',', 1) AS tc,
            SUBSTRING_INDEX(GROUP_CONCAT(smoking ORDER BY vstdate DESC), ',', 1) AS smoking
    FROM
        report_thaicvdrisk_screen t
        INNER JOIN {table}person p ON p.cid = t.cid AND p.house_regist_type_id IN (1,3)
        LEFT JOIN {table}house h ON p.house_id = h.house_id
        LEFT JOIN {table}village v ON v.village_id = h.village_id
    WHERE
       #t.hospcode = '{$hoscode}'
            1
            AND yymm BETWEEN '201510' AND '" . date('Ym') . "'
            {areacode}
    GROUP BY cid) t2) t) t2

                     ";
        $mapKeyword = [
            '{table}' => 'dw_' . $hoscode . '.',
            '{areacode}' => " AND areacode LIKE '{$dataCampur}%' "
        ];
        $keysearch = [];
        $keymap = [];

        foreach ($mapKeyword as $key => $value) {
            $keysearch[] = $key;
            $keymap[] = $value;
        }
        $query = str_replace($keysearch, $keymap, $query);

        try {
            $result = \Yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 100,
                ],
            ]);
            $cvd = [];
            foreach ($result as $key => $rows) {

                if ($rows['result'] == 0)
                    $cvd[0] += 1;
                if ($rows['result'] == 1)
                    $cvd[1] += 1;
                if ($rows['result'] == 2)
                    $cvd[2] += 1;
                if ($rows['result'] == 3)
                    $cvd[3] += 1;
                if ($rows['result'] == 4)
                    $cvd[4] += 1;
                if ($rows['result'] == 5)
                    $cvd[5] += 1;

                $data[$key][] = [
                    $rows[$c],
                ];
            }
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('thaicvdriskscreen', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels, 'cvd' => $cvd]);
    }

    public function actionPerson() {
        $q = \Yii::$app->request->get();
        #$hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : \Yii::$app->user->identity->profile->hospcode);
        #$year = $q['q_byear'] - 1 . '-10-01';
        #$serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        #$serviceDate_end = $q['q_byear'] . '-09-30';

        $query = "SELECT
                        address
                        ,cid
                        ,CONCAT(PRENAME,name,' ',LNAME) AS person_name
                        ,BIRTH
                        ,TIMESTAMPDIFF(YEAR,BIRTH,now()) as age
                        ,TYPEAREA
                        ,NATION
                        ,lat
                        ,lng
                        ,hospcode
                        ,d_update
                        FROM t_person p
                            WHERE 1
                        " . (!empty($q['q_search']) ? "AND (cid LIKE '%{$q['q_search']}%' OR address LIKE '%{$q['q_search']}%' OR CONCAT(PRENAME,name,' ',LNAME) LIKE '%{$q['q_search']}%')" : "AND 0") . "

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
            $result = \Yii::$app->db_datacenter->createCommand($query)->queryAll();
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

        return $this->render('person', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels]);
    }

    public function actionDeformed() {
        $q = \Yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : \Yii::$app->user->identity->profile->hospcode);
        $year = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] . '-09-30';

        $query = "SELECT
                        CONCAT(h.address,' หมู่ ',village_moo,' ',v.village_name) AS address_name
                        ,v.village_name
                        ,p.cid
                        ,CONCAT(p.pname,p.fname,' ',p.lname) AS person_name
                        ,birthdate
                        ,TIMESTAMPDIFF(YEAR,p.birthdate,now()) as age
                        ,house_regist_type_id
                        ,nationality
                        ,deformed_no
                        ,register_date
                        ,certificate_date
                        ,person_deformed_type_name
                        ,organ
                        ,h.latitude AS lat
                        ,h.longitude AS lng
                        FROM {table}person_deformed d
                            LEFT JOIN {table}person_deformed_detail dd ON d.person_deformed_id = dd.person_deformed_id
                            LEFT JOIN {table}person_deformed_type dt ON dt.person_deformed_type_id = dd.person_deformed_type_id
                            LEFT JOIN {table}person p ON p.person_id = d.person_id
                            LEFT JOIN {table}house h ON p.house_id = h.house_id
                            LEFT JOIN {table}village v ON v.village_id = h.village_id
                            WHERE p.person_id NOT IN (SELECT * FROM (SELECT person_id FROM {table}person_death) tmp)
                                    AND p.house_regist_type_id IN (1,3)
                                        AND p.nationality = 99
                        #AND v.village_moo <> 0
                        " . (!empty($q['q_search']) ? "AND (cid LIKE '%{$q['q_search']}%' OR CONCAT(p.pname,p.fname,' ',p.lname) LIKE '%{$q['q_search']}%')" : "") . "

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
            $result = \Yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                    'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 100,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('deformed', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels]);
    }

    public function actionDmhtscreen() {
        $q = \Yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : \Yii::$app->user->identity->profile->hospcode);
        $year = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] . '-09-30';

        $query = "SELECT
                    concat(h.address,' หมู่ ',village_moo,' ',v.village_name) as address_name
                    ,v.village_name
                    ,p.cid
                    ,concat(p.pname,p.fname,' ',p.lname) as person_name
                    ,birthdate
                    ,fgc
                    ,food_limit as fgc_limit
                    ,IF(food_limit IS NOT NULL && food_limit = 'Y' ,fgc,0) as food_limit
                    ,IF(food_limit IS NULL ,fgc,0) as food_unlimit
                    ,house_regist_type_id
                    ,nationality
                    ,CASE WHEN dmht='001' THEN 'เบาหวาน' WHEN dmht='002' THEN 'ความดัน' ELSE '-' END AS dmht
                    ,TIMESTAMPDIFF(YEAR,p.birthdate,'{$year}') as age
                    ,IFNULL(screen_date,'0') AS screen_date
                    ,cc_screen
                    ,bps
                    ,bpd
                    ,h.latitude as lat
                    ,h.longitude as lng
                    FROM {table}person p
                    LEFT JOIN {table}house h ON p.house_id = h.house_id
                    LEFT JOIN {table}village v ON v.village_id = h.village_id
                    LEFT OUTER JOIN (
                    SELECT p1.person_id
                    ,COUNT(*) AS cc_screen
                    ,p2.screen_date
                    ,group_concat(bps order by screen_no asc) as bps
                    ,group_concat(bpd order by screen_no asc) as bpd
                    ,group_concat(distinct food_limit order by screen_no asc) as food_limit
                    ,group_concat(distinct fgc_result order by screen_no asc) as fgc
                    ,last_fgc
                    FROM {table}person_dmht_screen_summary p1,{table}person_dmht_risk_screen_head p2,{table}person_ht_risk_bp_screen p3,{table}person_dm_fgc_screen p4
                    WHERE p1.person_dmht_screen_summary_id = p2.person_dmht_screen_summary_id
                    AND p2.person_dmht_risk_screen_head_id = p3.person_dmht_risk_screen_head_id
                    AND p2.person_dmht_risk_screen_head_id = p4.person_dmht_risk_screen_head_id
                    AND p2.screen_date BETWEEN '{$serviceDate_start}' AND '{$serviceDate_end}'
                    GROUP BY p1.person_id
                    ) ss ON ss.person_id = p.person_id

                    LEFT JOIN (SELECT hn,group_concat(DISTINCT clinic ORDER BY clinic ASC) AS dmht
                    FROM {table}clinicmember WHERE clinic IN ('001','002')
                    GROUP BY hn) c ON c.hn = p.patient_hn

                    WHERE TIMESTAMPDIFF(YEAR,p.birthdate,'{$year}') BETWEEN 35 AND 110
                    AND p.person_id NOT IN (SELECT * FROM (SELECT person_id FROM {table}person_death) tmp)
                    AND p.house_regist_type_id IN (1,3)
                    AND p.nationality = 99
                    AND v.village_moo <> 0
                    " . (!empty($q['q_search']) ? "AND (cid LIKE '%{$q['q_search']}%' OR CONCAT(p.pname,p.fname,' ',p.lname) LIKE '%{$q['q_search']}%')" : "") . "
                    " . (!empty($q['q_screen']) && $q['q_screen'] == 1 ? "AND screen_date is not null" : "") . "
                    " . (!empty($q['q_screen']) && $q['q_screen'] == 2 ? "AND screen_date is null" : "") . "

                    AND p.patient_hn NOT IN
                    (
                    SELECT hn FROM
                    (SELECT hn,group_concat(DISTINCT clinic ORDER BY clinic ASC) AS dmht
                    FROM {table}clinicmember WHERE clinic IN ('001','002')
                    GROUP BY hn ) tmp WHERE dmht IN ('" . (!empty($q['q_screentype']) && $q['q_screentype'] == 1 ? "001" : "") . "" . (!empty($q['q_screentype']) && $q['q_screentype'] == 2 ? "002" : "") . "','001,002'))

                    AND p.person_id NOT IN
                    (
                    SELECT person_id FROM
                    (SELECT person_id,group_concat(DISTINCT clinic ORDER BY clinic ASC) AS dmht
                    FROM {table}person_chronic WHERE clinic IN ('001','002')
                    GROUP BY person_id ) tmp WHERE dmht IN ('" . (!empty($q['q_screentype']) && $q['q_screentype'] == 1 ? "001" : "") . "" . (!empty($q['q_screentype']) && $q['q_screentype'] == 2 ? "002" : "") . "','001,002'))

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
            $result = \Yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                    'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 100,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('dmhtscreen', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels]);
    }

    public function actionEpi() {
        $q = \Yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : \Yii::$app->user->identity->profile->hospcode);
        #WM
        $year = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] . '-09-30';

        #HDC
        $year = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] . '-09-30';

        $query = "
            SELECT
                *
                ,IF(d_bcg LIKE '%{$hoscode}%',1,0) as c_bcg
                    ,IF(d_hbv1 LIKE '%{$hoscode}%',1,0) as c_hbv1
                    ,IF(d_hbv2 LIKE '%{$hoscode}%',1,0) as c_hbv2
                    ,IF(d_hbv3 LIKE '%{$hoscode}%',1,0) as c_hbv3

                    ,IF(d_dtp_hbv1 LIKE '%{$hoscode}%',1,0) as c_dtp_hbv1
                    ,IF(d_dtp_hbv2 LIKE '%{$hoscode}%',1,0) as c_dtp_hbv2
                    ,IF(d_dtp_hbv3 LIKE '%{$hoscode}%',1,0) as c_dtp_hbv3

                    ,IF(d_opv1 LIKE '%{$hoscode}%',1,0) as c_opv1
                    ,IF(d_opv2 LIKE '%{$hoscode}%',1,0) as c_opv2
                    ,IF(d_opv3 LIKE '%{$hoscode}%',1,0) as c_opv3
                    ,IF(d_opv4 LIKE '%{$hoscode}%',1,0) as c_opv4
                    ,IF(d_opv5 LIKE '%{$hoscode}%',1,0) as c_opv5


                    ,IF(d_mmr LIKE '%{$hoscode}%',1,0) as c_mmr
                    ,IF(d_mmr2 LIKE '%{$hoscode}%',1,0) as c_mmr2

                    ,IF(d_dtp1 LIKE '%{$hoscode}%',1,0) as c_dtp1
                    ,IF(d_dtp2 LIKE '%{$hoscode}%',1,0) as c_dtp2
                    ,IF(d_dtp3 LIKE '%{$hoscode}%',1,0) as c_dtp3
                    ,IF(d_dtp4 LIKE '%{$hoscode}%',1,0) as c_dtp4
                    ,IF(d_dtp5 LIKE '%{$hoscode}%',1,0) as c_dtp5

                    ,IF(d_je1 LIKE '%{$hoscode}%',1,0) as c_je1
                    ,IF(d_je2 LIKE '%{$hoscode}%',1,0) as c_je2
                    ,IF(d_je3 LIKE '%{$hoscode}%',1,0) as c_je3
                    ,IF(d_j11 LIKE '%{$hoscode}%',1,0) as c_j11
                    ,IF(d_j12 LIKE '%{$hoscode}%',1,0) as c_j12

                    ,IF(d_ipv LIKE '%{$hoscode}%',1,0) as c_ipv

                      , CONCAT_WS
                        ( ', '
                        , CASE WHEN years = 0 THEN NULL ELSE CONCAT(years,' ปี') END
                        , CASE WHEN months = 0 THEN NULL ELSE CONCAT(months, ' เดือน') END
                        , CASE WHEN days = 0 THEN NULL ELSE CONCAT(days, ' วัน') END
                        ) age
                FROM
                (SELECT
                    concat(h.address,' หมู่ ',village_moo,' ',v.village_name) as address_name
                    ,v.village_name
                    ,p.cid
                    ,concat(p.pname,p.fname,' ',p.lname) as person_name
                    ,birthdate
                    ,house_regist_type_id
                    ,nationality
                    , FLOOR(DATEDIFF('{$serviceDate_end}',p.birthdate)/365) years
                    , FLOOR((DATEDIFF('{$serviceDate_end}',p.birthdate)/365 - FLOOR(DATEDIFF('{$serviceDate_end}',p.birthdate)/365))* 12) months
                    , CEILING((((DATEDIFF('{$serviceDate_end}',p.birthdate)/365 - FLOOR(DATEDIFF('{$serviceDate_end}',p.birthdate)/365))* 12)
                    - FLOOR((DATEDIFF('{$serviceDate_end}',p.birthdate)/365 - FLOOR(DATEDIFF('{$serviceDate_end}',p.birthdate)/365))* 12))* 30) days

                    ,COUNT(distinct IF(epi.vaccine_type = '010',service_hospcode,null)) as bcg

                    ,COUNT(distinct IF(epi.vaccine_type = '041',service_hospcode,null)) as hbv1
                    ,COUNT(distinct IF(epi.vaccine_type = '042',service_hospcode,null)) as hbv2
                    ,COUNT(distinct IF(epi.vaccine_type = '043',service_hospcode,null)) as hbv3

                    ,COUNT(distinct IF(epi.vaccine_type = '091',service_hospcode,null)) as dtp_hbv1
                    ,COUNT(distinct IF(epi.vaccine_type = '092',service_hospcode,null)) as dtp_hbv2
                    ,COUNT(distinct IF(epi.vaccine_type = '093',service_hospcode,null)) as dtp_hbv3

                    ,COUNT(distinct IF(epi.vaccine_type = '081',service_hospcode,null)) as opv1
                    ,COUNT(distinct IF(epi.vaccine_type = '082',service_hospcode,null)) as opv2
                    ,COUNT(distinct IF(epi.vaccine_type = '083',service_hospcode,null)) as opv3
                    ,COUNT(distinct IF(epi.vaccine_type = '084',service_hospcode,null)) as opv4
                    ,COUNT(distinct IF(epi.vaccine_type = '085',service_hospcode,null)) as opv5

                    ,COUNT(distinct IF(epi.vaccine_type = '061',service_hospcode,null)) as mmr

                    ,COUNT(distinct IF(epi.vaccine_type = '031',service_hospcode,null)) as dtp1
                    ,COUNT(distinct IF(epi.vaccine_type = '032',service_hospcode,null)) as dtp2
                    ,COUNT(distinct IF(epi.vaccine_type = '033',service_hospcode,null)) as dtp3
                    ,COUNT(distinct IF(epi.vaccine_type = '034',service_hospcode,null)) as dtp4
                    ,COUNT(distinct IF(epi.vaccine_type = '035',service_hospcode,null)) as dtp5

                    ,COUNT(distinct IF(epi.vaccine_type = '073',service_hospcode,null)) as mmr2

                    ,COUNT(distinct IF(epi.vaccine_type IN ('051'),service_hospcode,null)) as je1
                    ,COUNT(distinct IF(epi.vaccine_type IN ('052'),service_hospcode,null)) as je2
                    ,COUNT(distinct IF(epi.vaccine_type IN ('053'),service_hospcode,null)) as je3

                    ,COUNT(distinct IF(epi.vaccine_type IN ('J11'),service_hospcode,null)) as j11
                    ,COUNT(distinct IF(epi.vaccine_type IN ('J12'),service_hospcode,null)) as j12

                    ,COUNT(distinct IF(epi.vaccine_type IN ('401'),service_hospcode,null)) as ipv

                    ,group_concat(distinct IF(epi.vaccine_type = '010',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_bcg

                    ,group_concat(distinct IF(epi.vaccine_type = '041',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_hbv1
                    ,group_concat(distinct IF(epi.vaccine_type = '042',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_hbv2
                    ,group_concat(distinct IF(epi.vaccine_type = '043',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_hbv3

                    ,group_concat(distinct IF(epi.vaccine_type = '091',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_dtp_hbv1
                    ,group_concat(distinct IF(epi.vaccine_type = '092',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_dtp_hbv2
                    ,group_concat(distinct IF(epi.vaccine_type = '093',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_dtp_hbv3

                    ,group_concat(distinct IF(epi.vaccine_type = '081',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_opv1
                    ,group_concat(distinct IF(epi.vaccine_type = '082',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_opv2
                    ,group_concat(distinct IF(epi.vaccine_type = '083',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_opv3
                    ,group_concat(distinct IF(epi.vaccine_type = '084',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_opv4
                    ,group_concat(distinct IF(epi.vaccine_type = '085',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_opv5


                    ,group_concat(distinct IF(epi.vaccine_type = '031',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_dtp1
                    ,group_concat(distinct IF(epi.vaccine_type = '032',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_dtp2
                    ,group_concat(distinct IF(epi.vaccine_type = '033',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_dtp3
                    ,group_concat(distinct IF(epi.vaccine_type = '034',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_dtp4
                    ,group_concat(distinct IF(epi.vaccine_type = '035',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_dtp5

                    ,group_concat(distinct IF(epi.vaccine_type = '061',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_mmr


                    ,group_concat(distinct IF(epi.vaccine_type = '073',concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_mmr2

                    ,group_concat(distinct IF(epi.vaccine_type IN ('051'),concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_je1
                    ,group_concat(distinct IF(epi.vaccine_type IN ('052'),concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_je2
                    ,group_concat(distinct IF(epi.vaccine_type IN ('053'),concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_je3

                    ,group_concat(distinct IF(epi.vaccine_type IN ('J11'),concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_j11
                    ,group_concat(distinct IF(epi.vaccine_type IN ('J12'),concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_j12

                    ,group_concat(distinct IF(epi.vaccine_type IN ('401'),concat(service_hospcode,'|',service_date,'|',source,'|',IFNULL(vaccine_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as d_ipv

                    ,h.latitude as lat
                    ,h.longitude as lng

                    FROM {table}person p
                    LEFT JOIN {table}house h ON p.house_id = h.house_id
                    LEFT JOIN {table}village v ON v.village_id = h.village_id
                    LEFT JOIN report_epi epi ON epi.cid = p.cid
                    WHERE p.birthdate between '" . ($q['q_byear'] - (($q['q_age'] <> '' ? $q['q_age'] : 5) + 1)) . '-10-01' . "' and '" . ($q['q_byear'] - ($q['q_age'] <> '' ? $q['q_age'] : 0)) . '-09-30' . "'
                    AND p.birthdate <= NOW()
                    #AND p.person_id NOT IN (SELECT * FROM (SELECT person_id FROM {table}person_death) tmp)
                    AND p.house_regist_type_id IN (1,3)
                    AND p.person_discharge_id = 9
                    AND p.nationality = 99
                    #AND v.village_moo <> 0
                    " . (!empty($q['q_search']) ? "AND (p.cid LIKE '%{$q['q_search']}%' OR concat(h.address,' หมู่ ',village_moo,' ',v.village_name) LIKE '%{$q['q_search']}%' OR CONCAT(p.pname,p.fname,' ',p.lname) LIKE '%{$q['q_search']}%')" : "") . "
                    GROUP BY p.cid) tt


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
            $result = \Yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                    'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('epi', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels]);
    }

    public function actionAnc() {
        $q = \Yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : \Yii::$app->user->identity->profile->hospcode);
        $year = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        $serviceDate_end = $q['q_byear'] . '-09-30';
        $query = "
            SELECT
                *
                      , CONCAT_WS
                        ( ', '
                        , CASE WHEN years = 0 THEN NULL ELSE CONCAT(years,' ปี') END
                        , CASE WHEN months = 0 THEN NULL ELSE CONCAT(months, ' เดือน') END
                        , CASE WHEN days = 0 THEN NULL ELSE CONCAT(days, ' วัน') END
                        ) age
                FROM
                (SELECT
                    concat(h.address,' หมู่ ',village_moo,' ',v.village_name) as address_name
                    ,v.village_name
                    ,p.cid
                    ,concat(p.pname,p.fname,' ',p.lname) as person_name
                    ,p.birthdate
                    ,p.house_regist_type_id
                    ,p.nationality
                    ,a.preg_no
                    , FLOOR(DATEDIFF('{$serviceDate_end}',p.birthdate)/365) years
                    , FLOOR((DATEDIFF('{$serviceDate_end}',p.birthdate)/365 - FLOOR(DATEDIFF('{$serviceDate_end}',p.birthdate)/365))* 12) months
                    , CEILING((((DATEDIFF('{$serviceDate_end}',p.birthdate)/365 - FLOOR(DATEDIFF('{$serviceDate_end}',p.birthdate)/365))* 12)
                    - FLOOR((DATEDIFF('{$serviceDate_end}',p.birthdate)/365 - FLOOR(DATEDIFF('{$serviceDate_end}',p.birthdate)/365))* 12))* 30) days

                    #,IF(age_preg BETWEEN 0 AND 12,p.person_id,NULL) AS precare1
                    #,IF(age_preg BETWEEN 16 AND 20,p.person_id,NULL) AS precare2
                    #,IF(age_preg BETWEEN 24 AND 28,p.person_id,NULL) AS precare3
                    #,IF(age_preg BETWEEN 30 AND 34,p.person_id,NULL) AS precare4
                    #,IF(age_preg BETWEEN 36 AND 40,p.person_id,NULL) AS precare5

                    ,group_concat(distinct concat(a.regplace,'|',a.anc_register_date) ORDER BY a.anc_register_date ASC SEPARATOR ',') as pregnancy
                    ,group_concat(distinct concat(a.labour_hospcode,'|',a.labor_date,'|',a.regplace) ORDER BY a.labor_date ASC SEPARATOR ',') as labour_place

                    #ก่อนคลอด
                    ,group_concat(distinct IF(pa_week BETWEEN 0 AND 12,concat(rsa.hospcode,'|',service_date,'|',note,'|',IFNULL(precare_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as precare1
                    ,group_concat(distinct IF(pa_week BETWEEN 16 AND 20,concat(rsa.hospcode,'|',service_date,'|',note,'|',IFNULL(precare_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as precare2
                    ,group_concat(distinct IF(pa_week BETWEEN 24 AND 28,concat(rsa.hospcode,'|',service_date,'|',note,'|',IFNULL(precare_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as precare3
                    ,group_concat(distinct IF(pa_week BETWEEN 30 AND 34,concat(rsa.hospcode,'|',service_date,'|',note,'|',IFNULL(precare_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as precare4
                    ,group_concat(distinct IF(pa_week BETWEEN 36 AND 40,concat(rsa.hospcode,'|',service_date,'|',note,'|',IFNULL(precare_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as precare5
                    #หลังคลอด
                    ,group_concat(distinct IF(note = 'preg_care' AND DATEDIFF(service_date,rsa.labor_date) BETWEEN 0 AND 7,concat(rsa.hospcode,'|',service_date,'|',note,'|',IFNULL(precare_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as care1
                    ,group_concat(distinct IF(note = 'preg_care' AND DATEDIFF(service_date,rsa.labor_date) BETWEEN 8 AND 15,concat(rsa.hospcode,'|',service_date,'|',note,'|',IFNULL(precare_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as care2
                    ,group_concat(distinct IF(note = 'preg_care' AND DATEDIFF(service_date,rsa.labor_date) BETWEEN 16 AND 42,concat(rsa.hospcode,'|',service_date,'|',note,'|',IFNULL(precare_hospcode,'')),null) ORDER BY service_date ASC SEPARATOR ',') as care3

                    ,group_concat(distinct IF(note = 'preg_care' AND DATEDIFF(service_date,rsa.labor_date) NOT BETWEEN 0 AND 42,concat(rsa.hospcode,'|',service_date,'|',note,'|',DATEDIFF(service_date,rsa.labor_date)),null) ORDER BY service_date ASC SEPARATOR ',') as care_error

                    ,IF(ac.person_id IS NOT NULL && p.house_regist_type_id IN (1,3),1,0) as inputdata
                    ,h.latitude as lat
                    ,h.longitude as lng
                    FROM {table}person p
                    INNER JOIN report_person_anc a ON a.cid = p.cid
                    LEFT JOIN {table}house h ON p.house_id = h.house_id
                    LEFT JOIN {table}village v ON v.village_id = h.village_id
                    LEFT JOIN {table}person_anc ac ON ac.person_id = p.person_id AND a.preg_no = ac.preg_no
                    LEFT JOIN report_service_anc rsa ON rsa.cid = p.cid AND rsa.preg_no = a.preg_no
                    WHERE
                    (a.anc_register_date between '{$serviceDate_start}' and '{$serviceDate_end}'
                    OR
                    a.labor_date between '{$serviceDate_start}' and '{$serviceDate_end}'
                    )
                    AND a.preg_no <> ''
                    AND a.preg_no is not null
                    AND p.birthdate <= NOW()
                    #AND p.person_id NOT IN (SELECT * FROM (SELECT person_id FROM {table}person_death)tmp)
                    #AND p.house_regist_type_id IN (1,3)
                    #AND p.nationality = 99
                    #AND v.village_moo <> 0
                    " . (!empty($q['q_search']) ? "AND (p.cid LIKE '%{$q['q_search']}%' OR concat(h.address,' หมู่ ',village_moo,' ',v.village_name) LIKE '%{$q['q_search']}%' OR CONCAT(p.pname,p.fname,' ',p.lname) LIKE '%{$q['q_search']}%')" : "") . "
                    GROUP BY p.cid,a.preg_no) tt

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
            $result = \Yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                    'defaultOrder' => [ 'inputdata' => SORT_ASC, 'village_name' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 100,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('anc', [ 'dataProvider' => $dataProvider, 'point' => $dataProvider->allModels]);
    }

    public function actionAllergy() {
        $q = \Yii::$app->request->get();
        $hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : \Yii::$app->user->identity->profile->hospcode);
        #$year = $q['q_byear'] - 1 . '-10-01';
        #$serviceDate_start = $q['q_byear'] - 1 . '-10-01';
        #$serviceDate_end = $q['q_byear'] . '-09-30';
        $query = "SELECT * FROM opd_allergy_view WHERE 1 " . (!empty($q['q_search']) ? " AND (cid LIKE '%{$q['q_search']}%' OR patient_name LIKE '%{$q['q_search']}%')" : " AND 0");

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
            $result = \Yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                    'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 100,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('allergy', [ 'dataProvider' => $dataProvider]);
    }

    public function actionThaicvdloopupdetail() {
        $q = \Yii::$app->request->get();
        #$hoscode = (isset($q['q_hospcode']) ? $q['q_hospcode'] : \Yii::$app->user->identity->profile->hospcode);
        #echo $q['cid'];
        #echo $q['hospcode'];
        #print_r($q);
        $query = "";
        $hospcode = explode(',', $q['hospcode']);


        foreach ($hospcode as $key => $hcode) {

            $table = 'dw_' . $hcode;
            $sqlQueryString = "SELECT '{$hcode}' as hospcode,vn,bps,vstdate,p.hn,waist,smoking_type_id as smoking,o.height,tc,
                timestampdiff(YEAR,birthday,vstdate) as ageatservice,
UNIX_TIMESTAMP(concat(o.vstdate,' ', o.vsttime)) as visittdate
                    FROM {$table}.opdscreen o
                            LEFT JOIN {$table}.patient p ON p.hn = o.hn
                    WHERE  p.cid = '{$q['cid']}' and bps > 0 order by vstdate desc limit 30; ";
            try {
                $result = \Yii::$app->db_datacenter->createCommand($sqlQueryString)->queryAll();
            } catch (\Exception $exc) {
                echo $table . " ERROR.." . $exc->getMessage();
            }

            foreach ((array) $result as $rowData) {
                $data[] = array(
                    'vn' => $rowData['vn'],
                    'bps' => $rowData['bps'],
                    'hn' => $rowData['hn'],
                    'waist' => $rowData['waist'],
                    'height' => $rowData['height'],
                    'smoking' => $rowData['smoking'],
                    'tc' => $rowData['tc'],
                    'visittdate' => $rowData['visittdate'],
                    'vstdate' => $rowData["vstdate"],
                    'ageatservice' => $rowData['ageatservice'],
                    'hospcode' => $rowData['hospcode'],
                );
            }
        }

        usort($data, function($a, $b) {
            return $b['visittdate'] - $a['visittdate'];
        });

        try {
            #$result = \Yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($data[0]) > 0 ? array_keys($data[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $data,
                'sort' => [
                    'attributes' => $attributes,
                    'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 100,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }
        return $this->renderAjax('thaicvdloopupdetail', [ 'dataProvider' => $dataProvider]);
    }

}
