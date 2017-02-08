<?php

namespace app\modules\emr\controllers;

use yii\web\Controller;
use yii;
use yii\data\ArrayDataProvider;
use app\modules\emr\models\WmLogEmr;
use app\modules\webclient\components\Cwebclient;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ListchargeController extends Controller {

    public $cid = '0000000000000';

    public function actionHistorychargedetail($table, $hn, $vn) {
        $hospcode = $table;
        $table = 'dw_' . $table;
        $sqlQueryString = "SELECT
                                '{$hospcode}' as hospcode,
                                v.vstdate,
                                d.vsttime,
                                v.pdx,
                                concat(i.code,' ',i.tname,'-',i.name) AS pdx_name,
                                v.hn,
                                v.vn,
                                ifnull(pt.name,'ไม่ระบุ') as ptname,
                                #ifnull(dc.name,'ไม่ระบุ') as dcname,
                                ifnull('','ไม่ระบุ') as dcname,
                                (select hospitalname from {$table}.opdconfig limit 1) as hname
                            FROM
                                {$table}.vn_stat v
                                    INNER JOIN
                                {$table}.ovstdiag d ON v.vn = d.vn
                                    LEFT JOIN
                                {$table}.pttype pt ON pt.pttype = v.pttype
                                #LEFT JOIN {$table}.doctor dc ON dc.code = v.dx_doctor
                                LEFT JOIN icd10 i ON i.code = v.pdx
                            WHERE
                                1 AND v.vn = '{$vn}'
                                    AND v.hn = '{$hn}'
                                    AND d.hn = '{$hn}'
                            GROUP BY v.vn; ";
        try {
            $result_lookup = Yii::$app->db_datacenter->createCommand($sqlQueryString)->queryOne();

            foreach ($result_lookup as $key => $value) {

                if ($key == 'vstdate') {
                    $data[$key] = Cwebclient::getThaiDate($value);
                } else {
                    $data[$key] = $value;
                }
            }
            echo json_encode($data);
        } catch (\Exception $exc) {
            echo json_encode(['error' => $exc->getMessage()]);
        }
        #echo json_encode($result_lookup);
    }

    public function actionListpersondetail($table, $cid) {
        //เก็บ LOG EMR
        $log = new WmLogEmr();
        $log->ip = Yii::$app->getRequest()->getUserIP();
        $log->access_cid = $cid;
        $log->access_time = new \yii\db\Expression('NOW()');
        $log->user_name = \Yii::$app->user->identity->profile->name;
        $log->save();

        $data = [];
        $table = 'dw_' . $table;
        $sqlQueryString = "SELECT cid
                    ,concat(pname,' ',fname,' ',lname) as fullname
                    ,patient_hn as hn
                    ,p.birthdate
                    ,concat(address,' หมู่ ',v.village_moo,' ',v.village_name)  as address
                    #,hrt.house_regist_type_name as typearea
                    ,'' as typearea
                    ,(select concat(hospitalcode,' ',hospitalname) from {$table}.opdconfig limit 1) as hname
                    #,person_image as image
                    ,'' as image
                    ,h.longitude
                    ,h.latitude
                    ,concat(timestampdiff(YEAR,birthdate,now()),' ปี') as age
                    FROM {$table}.person p
                            LEFT JOIN {$table}.house h ON p.house_id = h.house_id
                                LEFT JOIN {$table}.village v ON h.village_id = v.village_id
                                    #LEFT JOIN {$table}.house_regist_type hrt ON hrt.house_regist_type_id = p.house_regist_type_id
                                            #LEFT JOIN {$table}.person_image pi ON pi.person_id = p.person_id

                    WHERE  cid = '{$cid}';";
        try {
            $result = Yii::$app->db_datacenter->createCommand($sqlQueryString)->queryOne();
            foreach ($result as $key => $value) {
                if ($key == 'image') {
                    $data[$key] = base64_encode($value);
                } else {

                    if ($key == 'birthdate') {
                        $data[$key] = Cwebclient::getThaiDate($value);
                    } else {
                        $data[$key] = $value;
                    }
                }
            }
            echo json_encode($data);
        } catch (\Exception $exc) {
            echo json_encode(['error' => $exc->getMessage()]);
        }
    }

    public function actionListperson() {

        $jx_search = Yii::$app->request->post('jx_search');
        $data = [];
        $result = [];
        $sqlQueryString_lookup = "select hospcode "
                . "from t_person "
                . "where cid LIKE '%{$jx_search}%' or concat(name,' ',lname) LIKE '%{$jx_search}%' "
                . "group by hospcode ";
        try {
            $result_lookup = $db = Yii::$app->db_datacenter->createCommand($sqlQueryString_lookup)->queryAll();
        } catch (\Exception $exc) {
            //echo $table . " ERROR.." . $exc->getMessage();
        }

        foreach ($result_lookup as $key => $row) {
            $table = 'dw_' . $row["hospcode"];
            $sqlQueryString = "SELECT cid
                    ,concat(pname,' ',fname,' ',lname) as fullname
                    ,patient_hn as hn
                    ,(select concat(hospitalcode,' ',hospitalname) from {$table}.opdconfig limit 1) as hname
                    ,house_regist_type_id
                    ,'' as last_update
                    FROM {$table}.person p
                            LEFT JOIN {$table}.house h ON p.house_id = h.house_id
                                LEFT JOIN {$table}.village v ON h.village_id = v.village_id
                    WHERE  cid LIKE '%{$jx_search}%' or concat(fname,' ',lname) LIKE '%{$jx_search}%' limit 10; ";
            try {
                $result = Yii::$app->db_datacenter->createCommand($sqlQueryString)->queryAll();
            } catch (\Exception $exc) {
                echo $table . " ERROR.." . $exc->getMessage();
            }

            foreach ((array) $result as $rowData) {
                $data[] = array(
                    'cid' => $rowData['cid'],
                    'fullname' => $rowData['fullname'],
                    'hospcode' => $row["hospcode"],
                    'hname' => $rowData["hname"],
                    'hn' => $rowData["hn"],
                    'house_regist_type_id' => $rowData["house_regist_type_id"],
                    'last_update' => $rowData["last_update"],
                );
            }
        }


        $attributes = @count($data[0]) > 0 ? array_keys($data[0]) : array(); //หาชื่อ field ในตาราง

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => $attributes,
            ],
            'pagination' => [
                'pageSize' => 150,
            ],
        ]);

        return $this->renderPartial('listperson', array('dataProvider' => $dataProvider));
    }

    public function actionHistorycharge() {

        $this->cid = Yii::$app->request->post('cid');
        $data = array();
        $result = array();
        $sqlQueryString_lookup = "select hospcode,hn,concat(prename,' ',name,' ',lname) as fullname from t_person where cid = '{$this->cid}' group by hospcode ";
        try {
            $result_lookup = Yii::$app->db_datacenter->createCommand($sqlQueryString_lookup)->queryAll();
        } catch (Exception $exc) {
            //echo $table . " ERROR.." . $exc->getMessage();
        }

        foreach ($result_lookup as $key => $row) {
            $table = 'dw_' . $row["hospcode"];
            $sqlQueryString = "SELECT UNIX_TIMESTAMP(concat(v.vstdate,' ', d.vsttime)) as vstdate,v.pdx,'' as pdx_name,v.hn"
                    . ",v.vn "
                    . ",(select concat(hospitalcode,' ',hospitalname) from {$table}.opdconfig limit 1) as hname "
                    . "FROM {$table}.vn_stat v "
                    . ",{$table}.ovstdiag d "
                    . "WHERE v.vn = d.vn "
                    . "AND v.cid = '$this->cid' "
                    . "AND v.hn = '{$row["hn"]}' "
                    . "AND d.hn = '{$row["hn"]}' "
                    . "AND v.vstdate between  DATE_ADD(CURDATE(), INTERVAL - 5 YEAR) and CURDATE() "
                    . "GROUP BY v.vn; ";
            try {
                $result = Yii::$app->db_datacenter->createCommand($sqlQueryString)->queryAll();
            } catch (\Exception $exc) {
                //echo $table . " ERROR.." . $exc->getMessage();
            }

            foreach ((array) $result as $rowData) {
                $data[] = [
                    'vstdate' => $rowData['vstdate'],
                    'hospcode' => $row["hospcode"],
                    'pdx' => $rowData["pdx"],
                    'hname' => $rowData["hname"],
                    'hn' => $rowData["hn"],
                    'vn' => $rowData["vn"],
                ];
            }
        }

        usort($data, function($a, $b) {
            return $b['vstdate'] - $a['vstdate'];
        });


        $attributes = @count($data[0]) > 0 ? array_keys($data[0]) : array(); //หาชื่อ field ในตาราง

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => $attributes,
            ],
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        return $this->renderPartial('historycharge', array('dataProvider' => $dataProvider));
    }

    public function actionHistorylab() {
        $this->cid = @$_POST['cid'];
        $data = array();
        $result = array();
        foreach ($this->getHospcode() as $key => $row) {
            //เฉพาะ รพ. เท่านั้น
            if ($row["hospcode"] <> $row["hospcode_cup"])
                continue;

            $table = $this->prefixDbName . $row["hospcode"];
            $sqlQueryString = "SELECT
                                    a1.order_date,
                                    a1.order_time,
                                    a3.lab_items_name,
                                    a2.lab_order_result,
                                    a2.lab_items_normal_value_ref,
                                    a2.confirm
                                FROM
                                    {$table}.lab_head a1,
                                    {$table}.lab_order a2,
                                    {$table}.patient p,
                                    {$table}.lab_items a3
                                WHERE
                                    order_date >= DATE_ADD(CURDATE(), INTERVAL - 1 YEAR)
                                        AND a3.lab_items_name NOT LIKE '%hiv%'
                                        AND a2.lab_items_code = a3.lab_items_code
                                        AND a1.lab_order_number = a2.lab_order_number
                                        AND a1.hn = p.hn
                                        AND a2.confirm = 'Y'
                                        AND p.cid = '{$this->cid}'
                                ";
            try {
                $result = Yii::$app->db_datacenter->createCommand($sqlQueryString)->queryAll();
            } catch (\Exception $exc) {
                echo $table . " ERROR.." . $exc->getMessage();
            }

            foreach ((array) $result as $rowData) {
                $data[] = array(
                    'order_date' => $rowData['order_date'],
                    'hospcode' => $row["hospcode"],
                    'lab_items_name' => $rowData["lab_items_name"],
                    'lab_result' => $rowData["lab_order_result"],
                    'lab_items_normal_value' => $rowData["lab_items_normal_value_ref"],
                    'confirm' => $rowData["confirm"],
                );
            }
        }



        $attributes = @count($data[0]) > 0 ? array_keys($data[0]) : array(); //หาชื่อ field ในตาราง

        $dataProvider = new CArrayDataProvider($data, array('keyField' => false,
            'sort' => array('attributes' => $attributes),
            'pagination' => array(
                'pageSize' => 150,
            ),
        ));

        return $this->renderPartial('historyLab', array('dataProvider' => $dataProvider));
    }

    public function actionHistorydrug() {

        $this->cid = @$_POST['cid'];
        $data = array();
        $result = array();
        foreach ($this->getHospcode() as $key => $row) {
            //เฉพาะ รพ. เท่านั้น
            #if ($row["hospcode"] <> $row["hospcode_cup"])
            #continue;

            $table = 'dw_' . $row["hospcode"];
            $sqlQueryString = "SELECT
                                    v.vstdate, d.name AS items, SUM(o.qty) AS qty, d.units
                                FROM
                                    {$table}.vn_stat v
                                        INNER JOIN {$table}.opitemrece o ON o.vn = v.vn
                                        INNER JOIN {$table}.drugitems d ON o.icode = d.icode
                                        INNER JOIN {$table}.patient p ON v.hn = p.hn
                                WHERE
                                    v.vstdate >= DATE_ADD(CURDATE(), INTERVAL - 1 YEAR)
                                        AND p.cid = '{$this->cid}'
                                GROUP BY v.vstdate , o.icode
                                HAVING SUM(o.qty) > 0;
                                ";
            try {
                $result = Yii::$app->db_datacenter->createCommand($sqlQueryString)->queryAll();
            } catch (\Exception $exc) {
                echo $table . " ERROR.." . $exc->getMessage();
            }

            foreach ((array) $result as $rowData) {
                $data[] = array(
                    'vstdate' => $rowData['vstdate'],
                    'hospcode' => $row["hospcode"],
                    'drug_name' => $rowData["items"],
                    'drug_qty' => $rowData["qty"],
                    'drug_units' => $rowData["units"],
                );
            }
        }
        $attributes = @count($data[0]) > 0 ? array_keys($data[0]) : array(); //หาชื่อ field ในตาราง

        $dataProvider = new CArrayDataProvider($data, array('keyField' => false,
            'sort' => array('attributes' => $attributes),
            'pagination' => array(
                'pageSize' => 150,
            ),
        ));

        return $this->renderPartial('historyDrug', array('dataProvider' => $dataProvider));
    }

    public function actionListdrug($table, $vn) {

        $table = 'dw_' . $table;
        $sqlQueryString = "SELECT
                                #o.item_no,
                                CONCAT(i.name, ' ', i.units) AS item_name,
                                o.qty
                                ,d.shortlist
                            ,i.units
                            FROM
                                {$table}.opitemrece o
                                    #LEFT OUTER JOIN {$table}.s_drugitems s ON s.icode = o.icode
                                        LEFT OUTER JOIN {$table}.drugusage d ON d.drugusage=o.drugusage
                                    INNER JOIN {$table}.drugitems i ON i.icode = o.icode
                            WHERE
                                o.vn = '{$vn}';";
        try {
            $data = Yii::$app->db_datacenter->createCommand($sqlQueryString)->queryAll();
        } catch (\Exception $exc) {
            #echo $table . " ERROR.." . $exc->getMessage();
        }


        $attributes = @count($data[0]) > 0 ? array_keys($data[0]) : array(); //หาชื่อ field ในตาราง

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => $attributes,
            ],
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        return $this->renderPartial('listdrug', array('dataProvider' => $dataProvider));
    }

    public function actionListproced($table, $vn) {

        $table = 'dw_' . $table;
        $sqlQueryString = "SELECT
                                CONCAT(i.name) AS item_name,
                                o.qty
                                ,unitprice
                                ,unit
                            FROM
                                {$table}.opitemrece o
                                    INNER JOIN {$table}.nondrugitems i ON i.icode = o.icode
                            WHERE
                                o.vn = '{$vn}';";
        try {
            $data = Yii::$app->db_datacenter->createCommand($sqlQueryString)->queryAll();
        } catch (\Exception $exc) {
            #echo $table . " ERROR.." . $exc->getMessage();
        }


        $attributes = @count($data[0]) > 0 ? array_keys($data[0]) : array(); //หาชื่อ field ในตาราง

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => $attributes,
            ],
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        return $this->renderPartial('listproced', array('dataProvider' => $dataProvider));
    }

    public function actionListdiag($table, $vn) {
        $data = [];
        $table = 'dw_' . $table;
        $sqlQueryString = "SELECT
                                diagtype,
                                concat(code,' ',ifnull(tname,name)) AS item_name
                            FROM
                                {$table}.ovstdiag o
                                    INNER JOIN icd10 i ON i.code = o.icd10
                            WHERE
                                o.vn = '{$vn}';";
        try {
            $data = Yii::$app->db_datacenter->createCommand($sqlQueryString)->queryAll();
        } catch (\Exception $exc) {
            #echo $table . " ERROR.." . $exc->getMessage();
        }


        $attributes = @count($data[0]) > 0 ? array_keys($data[0]) : array(); //หาชื่อ field ในตาราง

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => $attributes,
            ],
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        return $this->renderPartial('listdiag', array('dataProvider' => $dataProvider));
    }

    public function actionListlab($table, $vn) {
        $data = [];
        $table = 'dw_' . $table;
        $sqlQueryString = "SELECT
                                *
                            FROM
                                {$table}.opdscreen o
                            WHERE
                                o.vn = '{$vn}';";
        try {
            $data = Yii::$app->db_datacenter->createCommand($sqlQueryString)->queryAll();
        } catch (\Exception $exc) {
            #echo $table . " ERROR.." . $exc->getMessage();
        }


        $attributes = @count($data[0]) > 0 ? array_keys($data[0]) : array(); //หาชื่อ field ในตาราง

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => $attributes,
            ],
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        return $this->renderPartial('listlab', array('dataProvider' => $dataProvider));
    }

}
