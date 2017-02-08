<?php

#webservice on hdc to wmc datacenter

namespace app\modules\hdcsync\controllers;

use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;

class TransdataController extends ActiveController {

    public $modelClass = 'app\modules\report\models\WuseItems';

    #public $tdata = ['t_person', 't_person_anc', 't_dmht'];

    public function behaviors() {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth']
        ];

        $behaviors['bootstrap'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function actionData() {
        //รับค่าจาก Client
        $var = \Yii::$app->request->post();
        $data = [];
        if (isset($var['param'])) {
            $param = $var['param'];
            /*
              if (is_array($param['hospcode'])) {
              $whereIn = "'" . implode("','", $param['hospcode']) . "'";
              } else {
              $whereIn = '';
              }
             */
            $tdata = ['t_person_cid' => ' AND check_typearea IN (1,3) AND discharge = 9',
                't_person_anc' => '',
                't_dmht' => '',
                't_chronic' => '',
                't_person_epi' => '',
                'postnatal' => '',
                'labfu' => '',
                'labor' => '',
                'chronicfu' => '',
                's_childdev_specialpp' => '',
                's_dm_control' => '', 's_ht_control' => '',
                's_postnatal' => '',
                's_kpi_ckd_screen' => '', 's_anc5' => '', 's_kpi_anc12' => '', 's_dm_screen_pop_age' => '', 's_ht_screen_pop_age' => ''
                    #'s_dm_control' => '',
                    #'s_dm_retina' => '',
                    #'s_ht_control' => '',
                    #'s_kpi_anc12' => '',
                    #'s_kpi_ckd_screen' => '',
                    #'t_ckd_screen' => '',
            ];
            if (array_key_exists($param['table'], $tdata))
                $table = $param['table'];

            try {
                if ($table == 't_person_epi') {
                    $sqlQuery = "SELECT
    p.hospcode,
    cid,
    p.pid,
    p.sex,
    p.birth,
    vaccinetype as vaccine_type,
    vaccineplace as vaccine_hospcode,
    date_serv as service_date,
    'HDC' as source,
    now() as rpt_date
FROM
    epi e,
    person p
WHERE
    e.pid = p.pid
        AND e.hospcode = p.hospcode
        AND e.hospcode NOT IN (select hoscode from chospital where concat(provcode,distcode) = '{$param['areacode']}')
        AND p.cid IN (SELECT
            *
        FROM
            (SELECT
                cid
            FROM
                t_person_db a
            WHERE
                discharge = 9
                    AND check_typearea IN (1 , 2, 3)
                    AND hospcode = '{$param['hospcode']}'
                    AND birth BETWEEN CONCAT(YEAR(NOW()) - 7, '-10-01') AND NOW()
            GROUP BY cid) t)";
                } elseif ($table == 'labfu') {
                    $sqlQuery = "SELECT
	e.hospcode
	,e.pid
	,p.cid
	,e.labtest
	,'' as labname
	,e.labresult
	,e.date_serv
    ,'HDC' as source
    ,now() as rpt_date
FROM
    labfu e,
    person p
WHERE
    e.pid = p.pid
        AND e.hospcode = p.hospcode
        AND e.date_serv BETWEEN CONCAT((SELECT yearprocess FROM sys_config LIMIT 1)-2,'-10-01') AND NOW()
        AND e.hospcode NOT IN (select hoscode from chospital where concat(provcode,distcode) = '{$param['areacode']}')
        AND p.cid IN (SELECT
            *
        FROM
            (SELECT
                cid
            FROM
                t_person_db a
            WHERE
                discharge = 9
                    AND check_typearea IN (1 , 2, 3)
                    AND hospcode = '{$param['hospcode']}'
            GROUP BY cid) t)";
                } elseif ($table == 'postnatal') {
                    $sqlQuery = "SELECT
	e.hospcode
	,e.pid
	,e.gravida
	,e.bdate
	,e.ppcare
	,e.ppresult
	,e.ppplace
        ,p.cid
    ,'HDC' as source
    ,now() as rpt_date
FROM
    postnatal e,
    person p
WHERE
    e.pid = p.pid
        AND e.hospcode = p.hospcode
        AND e.bdate BETWEEN CONCAT((SELECT yearprocess FROM sys_config LIMIT 1)-1,'-10-01') AND NOW()
        AND e.hospcode NOT IN (select hoscode from chospital where concat(provcode,distcode) = '{$param['areacode']}')
        AND p.cid IN (SELECT
            *
        FROM
            (SELECT
                cid
            FROM
                t_person_db a
            WHERE
                discharge = 9
                    AND check_typearea IN (1,2,3)
                    AND hospcode = '{$param['hospcode']}'
            GROUP BY cid) t)";
                } elseif ($table == 'labor') {
                    $sqlQuery = "SELECT
	e.hospcode as regplace
	,e.pid
	,e.GRAVIDA as preg_no
	,e.BDATE as labor_date
	,e.BRESULT
	,e.LMP
        ,e.BTYPE as labour_type
	,e.BHOSP as labour_hospcode
	,p.cid
    ,'HDC' as source
    ,now() as rpt_date
FROM
    labor e,
    person p
WHERE
    e.pid = p.pid
        AND e.hospcode = p.hospcode
        AND e.bdate BETWEEN CONCAT((SELECT yearprocess FROM sys_config LIMIT 1)-1,'-10-01') AND NOW()
        AND e.hospcode NOT IN (select hoscode from chospital where concat(provcode,distcode) = '{$param['areacode']}')
        AND p.cid IN (SELECT
            *
        FROM
            (SELECT
                cid
            FROM
                t_person_db a
            WHERE
                discharge = 9
                    AND check_typearea IN (1,2,3)
                    AND hospcode = '{$param['hospcode']}'
            GROUP BY cid) t)";
                } elseif ($table == 'chronicfu') {
                    $sqlQuery = "SELECT
	e.HOSPCODE,
	e.PID,
	p.CID,
	e.SEQ ,
	e.DATE_SERV,
	e.WEIGHT,
	e.HEIGHT,
	e.WAIST_CM,
	e.SBP,
	e.DBP,
	e.RETINA,
	e.FOOT,
	'' as SMOKING
    ,'HDC' as source
    ,now() as rpt_date
FROM
    chronicfu e,
    person p
WHERE
    e.pid = p.pid
        AND e.hospcode = p.hospcode
        AND e.date_serv BETWEEN CONCAT((SELECT yearprocess FROM sys_config LIMIT 1)-2,'-10-01') AND NOW()
        AND e.hospcode NOT IN (select hoscode from chospital where concat(provcode,distcode) = '{$param['areacode']}')
        AND p.cid IN (SELECT
            *
        FROM
            (SELECT
                cid
            FROM
                t_person_db a
            WHERE
                discharge = 9
                    AND check_typearea IN (1 , 2, 3)
                    AND hospcode = '{$param['hospcode']}'
            GROUP BY cid) t)";
                } elseif ($table == 't_chronic') {
                    $sqlQuery = "SELECT * FROM {$table} WHERE p_hospcode = '{$param['hospcode']}' ";
                } else {
                    $sqlQuery = "SELECT * FROM {$table} WHERE hospcode = '{$param['hospcode']}' {$tdata[$table]}";
                }

                $command = \Yii::$app->db_hdc->createCommand($sqlQuery);
                $data = $command->queryAll();
            } catch (\Exception $ex) {
                $data = [
                    'message' => $ex->getMessage(),
                    'code' => $ex->getCode(),
                ];
            }
        } else {
            $data = [
                'message' => 'param is not set',
                'code' => 500
            ];
        }
        $fieldData = [];
        $fields = [];
        foreach ($data[0] as $cname => $t) {
            $fields[] = $cname;
        }

        foreach ($data as $key => $rows) {
            $cdata = [];
            foreach ($rows as $cname => $value) {
                $cdata[] = (empty($value) ? NULL : $value);
            }

            $fieldData[] = $cdata;
        }


        $ref = [
            'data' => [
                'fields' => implode(',', $fields),
                'fieldData' => $fieldData
            ],
            'check' => $param,
            'query' => $sqlQuery
        ];

        return $ref;
    }

    public function auth($username, $password) {
        #$passwordHash = \dektrium\user\helpers\Password::validate($password, '$2y$12$HTDzKhiWEevOqF1cNPk3NuWY6B4oNnQR9C9ricf1skcDyTaK2dm.W');
        //Authen form table
        return \app\modules\silasoft\models\ExtUser::findOne(['username' => $username, 'password_hash' => $password]);
    }

}
