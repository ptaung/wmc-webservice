<?php

namespace app\modules\webclient\controllers;

use Yii;
use yii\web\Controller;
use app\modules\webclient\components\Cwebclient;
use app\models\Chospital;

class ProcessController extends Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public static function actionRun() {
        #$this->actionTperson();
        ProcessController::actionTdmht();
        ProcessController::actionTpersonanc();
        ProcessController::actionTpersonepi();
        ProcessController::actionLabfu();
        ProcessController::actionChronicfu();
        ProcessController::actionTchronic();
        ProcessController::actionPostnatal();
        ProcessController::actionLabor();

        ProcessController::actionStable(); #ตาราง S
        Yii::$app->db_datacenter->createCommand("CALL xws_summary_hdc;")->execute();

        #$this->actionRuns();

        echo 'Success';
    }

    /*
     * ดึงข้อมูลตาราง S จาก HDC
     *
     */

    public function actionStable() {
        $queryStable = "
CREATE TABLE IF NOT EXISTS `s_postnatal` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `target` int(9) DEFAULT '0',
  `result` int(9) DEFAULT '0',
  `target10` int(9) DEFAULT '0',
  `result10` int(9) DEFAULT '0',
  `target11` int(9) DEFAULT '0',
  `result11` int(9) DEFAULT '0',
  `target12` int(9) DEFAULT '0',
  `result12` int(9) DEFAULT '0',
  `target01` int(9) DEFAULT '0',
  `result01` int(9) DEFAULT '0',
  `target02` int(9) DEFAULT '0',
  `result02` int(9) DEFAULT '0',
  `target03` int(9) DEFAULT '0',
  `result03` int(9) DEFAULT '0',
  `target04` int(9) DEFAULT '0',
  `result04` int(9) DEFAULT '0',
  `target05` int(9) DEFAULT '0',
  `result05` int(9) DEFAULT '0',
  `target06` int(9) DEFAULT '0',
  `result06` int(9) DEFAULT '0',
  `target07` int(9) DEFAULT '0',
  `result07` int(9) DEFAULT '0',
  `target08` int(9) DEFAULT '0',
  `result08` int(9) DEFAULT '0',
  `target09` int(9) DEFAULT '0',
  `result09` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `s_dm_control` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `target` int(9) DEFAULT '0',
  `result` int(9) DEFAULT '0',
  `hba1c` int(9) DEFAULT '0',
  `target1` int(9) DEFAULT '0',
  `result1` int(9) DEFAULT '0',
  `hba1c1` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `s_ht_control` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `target` int(9) DEFAULT '0',
  `result` int(9) DEFAULT '0',
  `bp` int(9) DEFAULT '0',
  `target1` int(9) DEFAULT '0',
  `result1` int(9) DEFAULT '0',
  `bp1` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `s_kpi_ckd_screen` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `target` int(10) NOT NULL DEFAULT '0',
  `result` int(10) NOT NULL DEFAULT '0',
  `result1` int(10) NOT NULL DEFAULT '0',
  `result2` int(10) NOT NULL DEFAULT '0',
  `result3` int(10) NOT NULL DEFAULT '0',
  `result4` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `s_anc5` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target` int(7) DEFAULT '0',
  `result` int(7) DEFAULT '0',
  `target1` int(7) DEFAULT '0',
  `result1` int(7) DEFAULT '0',
  `target2` int(7) DEFAULT '0',
  `result2` int(7) DEFAULT '0',
  `target3` int(7) DEFAULT '0',
  `result3` int(7) DEFAULT '0',
  `target4` int(7) DEFAULT '0',
  `result4` int(7) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `s_kpi_anc12` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `target` int(7) DEFAULT '0',
  `result` int(7) DEFAULT '0',
  `target1` int(7) DEFAULT '0',
  `result1` int(7) DEFAULT '0',
  `target2` int(7) DEFAULT '0',
  `result2` int(7) DEFAULT '0',
  `target3` int(7) DEFAULT '0',
  `result3` int(7) DEFAULT '0',
  `target4` int(7) DEFAULT '0',
  `result4` int(7) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `s_dm_screen_pop_age` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `pop_group2` int(9) DEFAULT '0',
  `result_group2` int(9) DEFAULT '0',
  `pop_group3` int(9) DEFAULT '0',
  `result_group3` int(9) DEFAULT '0',
  `pop_group4` int(9) DEFAULT '0',
  `result_group4` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `s_ht_screen_pop_age` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `pop_group2` int(9) DEFAULT '0',
  `result_group2` int(9) DEFAULT '0',
  `pop_group3` int(9) DEFAULT '0',
  `result_group3` int(9) DEFAULT '0',
  `pop_group4` int(9) DEFAULT '0',
  `result_group4` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `s_ht_screen_pop_age` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `pop_group2` int(9) DEFAULT '0',
  `result_group2` int(9) DEFAULT '0',
  `pop_group3` int(9) DEFAULT '0',
  `result_group3` int(9) DEFAULT '0',
  `pop_group4` int(9) DEFAULT '0',
  `result_group4` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `s_childdev_specialpp` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) NOT NULL,
  `date_com` varchar(14) NOT NULL,
  `b_year` varchar(4) NOT NULL,
  `monthly` varchar(2) NOT NULL,
  `target9` int(10) DEFAULT '0',
  `result9_1` int(10) DEFAULT '0',
  `result9_2` int(10) DEFAULT '0',
  `result9_3` int(10) DEFAULT '0',
  `result9_4` int(10) DEFAULT '0',
  `result9_5` int(10) DEFAULT '0',
  `result9_6` int(10) DEFAULT '0',
  `result9_7` int(10) DEFAULT '0',
  `result9_8` int(10) DEFAULT '0',
  `result9_9` int(10) DEFAULT '0',
  `target18` int(10) DEFAULT '0',
  `result18_1` int(10) DEFAULT '0',
  `result18_2` int(10) DEFAULT '0',
  `result18_3` int(10) DEFAULT '0',
  `result18_4` int(10) DEFAULT '0',
  `result18_5` int(10) DEFAULT '0',
  `result18_6` int(10) DEFAULT '0',
  `result18_7` int(10) DEFAULT '0',
  `result18_8` int(10) DEFAULT '0',
  `result18_9` int(10) DEFAULT '0',
  `target30` int(10) DEFAULT '0',
  `result30_1` int(10) DEFAULT '0',
  `result30_2` int(10) DEFAULT '0',
  `result30_3` int(10) DEFAULT '0',
  `result30_4` int(10) DEFAULT '0',
  `result30_5` int(10) DEFAULT '0',
  `result30_6` int(10) DEFAULT '0',
  `result30_7` int(10) DEFAULT '0',
  `result30_8` int(10) DEFAULT '0',
  `result30_9` int(10) DEFAULT '0',
  `target42` int(10) DEFAULT '0',
  `result42_1` int(10) DEFAULT '0',
  `result42_2` int(10) DEFAULT '0',
  `result42_3` int(10) DEFAULT '0',
  `result42_4` int(10) DEFAULT '0',
  `result42_5` int(10) DEFAULT '0',
  `result42_6` int(10) DEFAULT '0',
  `result42_7` int(10) DEFAULT '0',
  `result42_8` int(10) DEFAULT '0',
  `result42_9` int(10) DEFAULT '0',
  `improper9` int(10) DEFAULT '0',
  `improper18` int(10) DEFAULT '0',
  `improper30` int(10) DEFAULT '0',
  `improper42` int(10) DEFAULT '0',
  PRIMARY KEY (`hospcode`,`areacode`,`b_year`,`monthly`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
            ";

        try {
            Yii::$app->db_datacenter->createCommand($queryStable)->execute();
        } catch (\Exception $exc) {
            #echo $exc->getMessage();
        }

        $provcode = Yii::$app->params['provcode'];
        $ampcode = Yii::$app->params['ampcode'];
        if (strlen($ampcode) == 4) {
            $ampcode = " AND concat(provcode,distcode) = '{$ampcode}' ";
        } else {
            $ampcode = '';
        }
        $m = Chospital::find()->where(
                        "provcode = '{$provcode}'
                            and hostype in ('03','05','06','07','18')
                            {$ampcode}
                            "
                )->all();

        $stableHdc = ['s_childdev_specialpp', 's_postnatal', 's_dm_control', 's_ht_control', 's_kpi_ckd_screen', 's_anc5', 's_kpi_anc12', 's_dm_screen_pop_age', 's_ht_screen_pop_age'];

        foreach ($stableHdc as $stable) {

            foreach ($m as $model) {
                $hospcode = $model->hoscode;

                $response = Cwebclient::getDataHdc($stable, $hospcode);
                $textValues = '';
                foreach ($response['data']['fieldData'] as $rows) {

                    $textValues .= "(";
                    $dValues = '';
                    foreach ($rows as $value) {
                        #$dValues .= (empty($value) ? 'NULL' : "'" . $value . "'") . ',';
                        $dValues .= "'" . $value . "'" . ',';
                    }
                    $textValues .= rtrim($dValues, ',') . "),";
                }

                try {
                    Yii::$app->db_datacenter->createCommand("DELETE FROM {$stable} WHERE hospcode = '{$hospcode}'")->execute();
                } catch (\Exception $exc) {
                    #echo $exc->getMessage();
                }
                try {
                    $e = Yii::$app->db_datacenter->createCommand("INSERT IGNORE INTO {$stable} (" . $response['data']['fields'] . ") VALUES " . rtrim($textValues, ',') . ";")->execute();
                } catch (\Exception $exc) {
                    #echo $exc->getMessage();
                }

                echo "{$stable}->Result : {$hospcode} | {$e}", "\n";
            }
        }
    }

    public function actionRuns() {
        $this->actionExchange('t_person_epi');
        echo 'Success';
    }

    public function actionExchange($table) {
        $provcode = Yii::$app->params['provcode'];
        $ampcode = Yii::$app->params['ampcode'];
        if (strlen($ampcode) == 4) {
            $ampcode = " AND concat(provcode,distcode) = '{$ampcode}' ";
        } else {
            $ampcode = '';
        }
        $m = Chospital::find()->where(
                        "provcode = '{$provcode}'
                            and hostype in ('03','05','06','07','18')
                            {$ampcode}
                            "
                )->all();

        foreach ($m as $model) {
            $hospcode = $model->hoscode;

            $response = Cwebclient::getDataHdc($table, $hospcode);
            $textValues = '';
            foreach ($response['data']['fieldData'] as $rows) {

                $textValues .= "(";
                $dValues = '';
                foreach ($rows as $value) {
                    $dValues .= (empty($value) ? 'NULL' : "'" . $value . "'") . ',';
                }
                $textValues .= rtrim($dValues, ',') . "),";
            }

            try {
                Yii::$app->db_datacenter->createCommand("DELETE FROM {$table} WHERE hospcode = '{$hospcode}'")->execute();
            } catch (\Exception $exc) {
                #echo $exc->getMessage();
            }
            try {
                $e = Yii::$app->db_datacenter->createCommand("INSERT IGNORE INTO {$table} (" . $response['data']['fields'] . ") VALUES " . rtrim($textValues, ',') . ";")->execute();
            } catch (\Exception $exc) {
                #echo $exc->getMessage();
            }

            echo "{$table}->Result : {$hospcode} | {$e}", "\n";
        }
    }

    public function actionTperson() {
        $provcode = Yii::$app->params['provcode'];
        $ampcode = Yii::$app->params['ampcode'];
        if (strlen($ampcode) == 4) {
            $ampcode = " AND concat(provcode,distcode) = '{$ampcode}' ";
        } else {
            $ampcode = '';
        }
        $m = Chospital::find()->where(
                        "provcode = '{$provcode}'
                            and hostype in ('03','05','06','07','18')
                            {$ampcode}
                            "
                )->all();

        $table = "t_person_cid";

        foreach ($m as $model) {
            $hospcode = $model->hoscode;

            $response = Cwebclient::getDataHdc($table, $hospcode);
            $textValues = '';
            foreach ($response['data']['fieldData'] as $rows) {

                $textValues .= "(";
                $dValues = '';
                foreach ($rows as $value) {
                    $dValues .= (empty($value) ? 'NULL' : "'" . $value . "'") . ',';
                }

                $textValues .= rtrim($dValues, ',') . "),";
            }

            try {
                Yii::$app->db_datacenter->createCommand("DELETE FROM {$table}_hdc WHERE hospcode = '{$hospcode}'")->execute();
            } catch (\Exception $exc) {
                #echo $exc->getMessage();
            }
            try {
                $e = Yii::$app->db_datacenter->createCommand("INSERT IGNORE INTO {$table}_hdc (" . $response['data']['fields'] . ") VALUES " . rtrim($textValues, ',') . ";")->execute();
            } catch (\Exception $exc) {
                #echo $exc->getMessage();
            }

            echo "Result  {$table}  : {$hospcode} | {$e}", "\n";
        }
    }

    public function actionTpersonanc() {
        $provcode = Yii::$app->params['provcode'];
        $ampcode = Yii::$app->params['ampcode'];
        if (strlen($ampcode) == 4) {
            $ampcode = " AND concat(provcode,distcode) = '{$ampcode}' ";
        } else {
            $ampcode = '';
        }
        $m = Chospital::find()->where(
                        "provcode = '{$provcode}'
                            and hostype in ('03','05','06','07','18')
                            {$ampcode}
                            "
                )->all();

        $table = "t_person_anc";

        foreach ($m as $model) {
            $hospcode = $model->hoscode;
            $response = Cwebclient::getDataHdc($table, $hospcode);
            $textValues = '';
            foreach ($response['data']['fieldData'] as $rows) {
                $textValues .= "(";
                $dValues = '';
                foreach ($rows as $value) {
                    $dValues .= (empty($value) ? 'NULL' : "'" . $value . "'") . ',';
                }
                $textValues .= rtrim($dValues, ',') . "),";
            }

            try {
                Yii::$app->db_datacenter->createCommand("DELETE FROM {$table}_hdc WHERE hospcode = '{$hospcode}'")->execute();
            } catch (\Exception $exc) {
                #echo $exc->getMessage();
            }
            try {
                $e = Yii::$app->db_datacenter->createCommand("INSERT IGNORE INTO {$table}_hdc (" . $response['data']['fields'] . ") VALUES " . rtrim($textValues, ',') . ";")->execute();
            } catch (\Exception $exc) {
                #echo $exc->getMessage();
            }

            echo "Result {$table} : {$hospcode} | {$e}", "\n";
        }
        #คำสั่งปรับปรุงฐานข้อมูลเมื่อแลกเปลี่ยนข้อมูลแล้ว
        try {
            Yii::$app->db_datacenter->createCommand("CALL ex_tperson_anc;")->execute();
            echo "Result  report_epi : CALL t_person_anc success", "<br> \n";
        } catch (\Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function actionTdmht() {
        $provcode = Yii::$app->params['provcode'];
        $ampcode = Yii::$app->params['ampcode'];
        if (strlen($ampcode) == 4) {
            $ampcode = " AND concat(provcode,distcode) = '{$ampcode}' ";
        } else {
            $ampcode = '';
        }
        $m = Chospital::find()->where(
                        "provcode = '{$provcode}'
                            and hostype in ('03','05','06','07','18')
                            {$ampcode}
                            "
                )->all();

        $table = "t_dmht";

        foreach ($m as $model) {
            $hospcode = $model->hoscode;
            $response = Cwebclient::getDataHdc($table, $hospcode);
            $textValues = '';
            foreach ($response['data']['fieldData'] as $rows) {
                $textValues .= "(";
                $dValues = '';
                foreach ($rows as $value) {
                    $dValues .= (empty($value) ? 'NULL' : "'" . $value . "'") . ',';
                }
                $textValues .= rtrim($dValues, ',') . "),";
            }

            try {
                Yii::$app->db_datacenter->createCommand("DELETE FROM {$table}_hdc WHERE hospcode = '{$hospcode}'")->execute();
            } catch (\Exception $exc) {
                #echo $exc->getMessage();
            }
            $e = 0;
            try {
                $e = Yii::$app->db_datacenter->createCommand("INSERT INTO {$table}_hdc (" . $response['data']['fields'] . ") VALUES " . rtrim($textValues, ',') . ";")->execute();
            } catch (\Exception $exc) {
                #echo $exc->getMessage();
            }
            echo "Result {$table} : {$hospcode} | {$e}", "\n";
        }
        #คำสั่งปรับปรุงฐานข้อมูลเมื่อแลกเปลี่ยนข้อมูลแล้ว
        try {
            Yii::$app->db_datacenter->createCommand("CALL ex_tdmht;")->execute();
        } catch (\Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function actionTpersonepi() {
        $provcode = Yii::$app->params['provcode'];
        $ampcode = Yii::$app->params['ampcode'];
        if (strlen($ampcode) == 4) {
            $ampcode = " AND concat(provcode,distcode) = '{$ampcode}' ";
        } else {
            $ampcode = '';
        }
        $m = Chospital::find()->where(
                        "provcode = '{$provcode}'
                            and hostype in ('03','05','06','07','18')
                            {$ampcode}
                            "
                )->all();

        $table = "t_person_epi";
        try {
            $sql = "DELETE FROM report_epi WHERE hospcode NOT IN (SELECT hospcode FROM pcu_hos_allow)";
            Yii::$app->db_datacenter->createCommand($sql)->execute();
        } catch (\Exception $exc) {
            #echo $exc->getMessage();
        }
        foreach ($m as $model) {
            $hospcode = $model->hoscode;
            $response = Cwebclient::getDataHdc($table, $hospcode, Yii::$app->params['ampcode']);
            #echo '<pre>';
            #print_r($response);
            #echo '</pre>';
            $textValues = '';
            foreach ($response['data']['fieldData'] as $rows) {
                $textValues .= "(";
                $dValues = '';
                foreach ($rows as $value) {
                    $dValues .= (empty($value) ? 'NULL' : "'" . $value . "'") . ',';
                }
                $textValues .= rtrim($dValues, ',') . "),";
            }
            $e = 0;
            try {
                $e = Yii::$app->db_datacenter->createCommand("INSERT INTO report_epi (" . $response['data']['fields'] . ") VALUES " . rtrim($textValues, ',') . ";")->execute();
            } catch (\Exception $exc) {
                echo $exc->getMessage();
            }

            echo "Result  report_epi : {$hospcode} | {$e}", "\n";
        }

        #คำสั่งปรับปรุงฐานข้อมูลเมื่อแลกเปลี่ยนข้อมูลแล้ว
        try {
            Yii::$app->db_datacenter->createCommand("CALL t_person_epi;")->execute();
            echo "Result  report_epi : CALL t_person_epi success", '<br>';
        } catch (\Exception $exc) {
            echo $exc->getMessage();
        }
    }

#ข้อมูลการบันทึก LAB

    public function actionLabfu() {
        $provcode = Yii::$app->params['provcode'];
        $ampcode = Yii::$app->params['ampcode'];
        if (strlen($ampcode) == 4) {
            $ampcode = " AND concat(provcode,distcode) = '{$ampcode}' ";
        } else {
            $ampcode = '';
        }
        $m = Chospital::find()->where(
                        "provcode = '{$provcode}'
                            and hostype in ('03','05','06','07','18')
                            {$ampcode}
                            "
                )->all();

        $table = "labfu";
        try {
            $sql = "DELETE FROM report_labfu WHERE source = 'HDC' ";
            Yii::$app->db_datacenter->createCommand($sql)->execute();
        } catch (\Exception $exc) {
            #echo $exc->getMessage();
        }
        foreach ($m as $model) {
            $hospcode = $model->hoscode;
            $response = Cwebclient::getDataHdc($table, $hospcode, Yii::$app->params['ampcode']);
            #echo '<pre>';
            #print_r($response);
            #echo '</pre>';
            $textValues = '';
            foreach ($response['data']['fieldData'] as $rows) {
                $textValues .= "(";
                $dValues = '';
                foreach ($rows as $value) {
                    $dValues .= (empty($value) ? 'NULL' : "'" . $value . "'") . ',';
                }
                $textValues .= rtrim($dValues, ',') . "),";
            }
            $e = 0;
            try {
                $e = Yii::$app->db_datacenter->createCommand("INSERT INTO report_labfu (" . $response['data']['fields'] . ") VALUES " . rtrim($textValues, ',') . ";")->execute();
            } catch (\Exception $exc) {
                echo $exc->getMessage();
            }

            echo "Result  report_labfu : {$hospcode} | {$e}", "\n";
        }
    }

#ข้อมูลการบันทึก chronicfu

    public function actionChronicfu() {
        $provcode = Yii::$app->params['provcode'];
        $ampcode = Yii::$app->params['ampcode'];
        if (strlen($ampcode) == 4) {
            $ampcode = " AND concat(provcode,distcode) = '{$ampcode}' ";
        } else {
            $ampcode = '';
        }
        $m = Chospital::find()->where(
                        "provcode = '{$provcode}'
                            and hostype in ('03','05','06','07','18')
                            {$ampcode}
                            "
                )->all();

        $table = "chronicfu";
        try {
            $sql = "DELETE FROM report_chronicfu WHERE source = 'HDC' ";
            Yii::$app->db_datacenter->createCommand($sql)->execute();
        } catch (\Exception $exc) {
            #echo $exc->getMessage();
        }
        foreach ($m as $model) {
            $hospcode = $model->hoscode;
            $response = Cwebclient::getDataHdc($table, $hospcode, Yii::$app->params['ampcode']);
            #echo '<pre>';
            #print_r($response);
            #echo '</pre>';
            $textValues = '';
            foreach ($response['data']['fieldData'] as $rows) {
                $textValues .= "(";
                $dValues = '';
                foreach ($rows as $value) {
                    $dValues .= (empty($value) ? 'NULL' : "'" . $value . "'") . ',';
                }
                $textValues .= rtrim($dValues, ',') . "),";
            }
            $e = 0;
            try {
                $e = Yii::$app->db_datacenter->createCommand("INSERT INTO report_chronicfu (" . $response['data']['fields'] . ") VALUES " . rtrim($textValues, ',') . ";")->execute();
            } catch (\Exception $exc) {
                echo $exc->getMessage();
            }

            echo "Result  report_chronicfu : {$hospcode} | {$e}", "\n";
        }
    }

    public function actionTchronic() {
        $provcode = Yii::$app->params['provcode'];
        $ampcode = Yii::$app->params['ampcode'];
        if (strlen($ampcode) == 4) {
            $ampcode = " AND concat(provcode,distcode) = '{$ampcode}' ";
        } else {
            $ampcode = '';
        }
        $m = Chospital::find()->where(
                        "provcode = '{$provcode}'
                            and hostype in ('03','05','06','07','18')
                            {$ampcode}
                            "
                )->all();

        $table = "t_chronic";

        try {
            Yii::$app->db_datacenter->createCommand("
                CREATE TABLE `t_chronic_hdc` (
   `cid` varchar(13) NOT NULL,
   `birth` date DEFAULT NULL,
   `age_y` int(3) DEFAULT '0',
   `age_y_dx` int(3) DEFAULT '0',
   `groupcode` int(3) DEFAULT '0',
   `sex` varchar(1) DEFAULT NULL,
   `nation` varchar(3) DEFAULT NULL,
   `p_hospcode` varchar(5) DEFAULT NULL,
   `d_hospcode` varchar(5) DEFAULT NULL,
   `p_pt_vhid` varchar(8) DEFAULT NULL,
   `d_pt_vhid` varchar(8) DEFAULT NULL,
   `p_typearea` varchar(1) DEFAULT NULL,
   `d_typearea` varchar(1) DEFAULT NULL,
   `input_hosp` varchar(5) DEFAULT NULL,
   `input_pid` varchar(15) DEFAULT NULL,
   `source_tb` varchar(20) DEFAULT NULL,
   `diagcode` varchar(10) NOT NULL,
   `date_dx` date DEFAULT NULL,
   `hosp_dx` varchar(5) DEFAULT NULL,
   `hosp_rx` varchar(5) DEFAULT NULL,
   `typedisch` varchar(2) DEFAULT NULL,
   `datedisch` date DEFAULT NULL,
   `minscl` varchar(5) DEFAULT NULL,
   `inscl` varchar(3) DEFAULT NULL,
   PRIMARY KEY (`cid`,`diagcode`),
   KEY `cid` (`cid`),
   KEY `diagcode` (`diagcode`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
                ")->execute();
        } catch (\Exception $exc) {
            #echo $exc->getMessage();
        }

        foreach ($m as $model) {
            $hospcode = $model->hoscode;
            $response = Cwebclient::getDataHdc($table, $hospcode);
            $textValues = '';
            foreach ($response['data']['fieldData'] as $rows) {
                $textValues .= "(";
                $dValues = '';
                foreach ($rows as $value) {
                    $dValues .= (empty($value) ? 'NULL' : "'" . $value . "'") . ',';
                }
                $textValues .= rtrim($dValues, ',') . "),";
            }

            try {
                Yii::$app->db_datacenter->createCommand("DELETE FROM {$table}_hdc WHERE p_hospcode = '{$hospcode}'")->execute();
            } catch (\Exception $exc) {
                #echo $exc->getMessage();
            }
            $e = 0;
            try {
                $e = Yii::$app->db_datacenter->createCommand("INSERT INTO {$table}_hdc (" . $response['data']['fields'] . ") VALUES " . rtrim($textValues, ',') . ";")->execute();
            } catch (\Exception $exc) {
                echo $exc->getMessage();
            }
            echo "Result {$table} : {$hospcode} | {$e}", "\n";
        }
        #คำสั่งปรับปรุงฐานข้อมูลเมื่อแลกเปลี่ยนข้อมูลแล้ว
        /*
          try {
          Yii::$app->db_datacenter->createCommand("CALL ex_tchronic;")->execute();
          } catch (\Exception $exc) {
          echo $exc->getMessage();
          }
         *
         */
    }

#ข้อมูลการบันทึก Postnatal

    public function actionPostnatal() {
        $provcode = Yii::$app->params['provcode'];
        $ampcode = Yii::$app->params['ampcode'];
        if (strlen($ampcode) == 4) {
            $ampcode = " AND concat(provcode,distcode) = '{$ampcode}' ";
        } else {
            $ampcode = '';
        }
        $m = Chospital::find()->where(
                        "provcode = '{$provcode}'
                            and hostype in ('03','05','06','07','18')
                            {$ampcode}
                            "
                )->all();

        $table = "postnatal";
        try {
            $sql = "DELETE FROM report_postnatal WHERE source = 'HDC' ";
            Yii::$app->db_datacenter->createCommand($sql)->execute();
        } catch (\Exception $exc) {
            #echo $exc->getMessage();
        }
        foreach ($m as $model) {
            $hospcode = $model->hoscode;
            $response = Cwebclient::getDataHdc($table, $hospcode, Yii::$app->params['ampcode']);
            #echo '<pre>';
            #print_r($response);
            #echo '</pre>';
            $textValues = '';
            foreach ($response['data']['fieldData'] as $rows) {
                $textValues .= "(";
                $dValues = '';
                foreach ($rows as $value) {
                    $dValues .= (empty($value) ? 'NULL' : "'" . $value . "'") . ',';
                }
                $textValues .= rtrim($dValues, ',') . "),";
            }
            $e = 0;
            try {
                $e = Yii::$app->db_datacenter->createCommand("INSERT  INTO report_postnatal (" . $response['data']['fields'] . ") VALUES " . rtrim($textValues, ',') . ";")->execute();
            } catch (\Exception $exc) {
                echo $exc->getMessage();
            }

            echo "Result  report_postnatal : {$hospcode} | {$e}", "\n";
        }
    }

    #ข้อมูลการบันทึก Labor

    public function actionLabor() {
        $provcode = Yii::$app->params['provcode'];
        $ampcode = Yii::$app->params['ampcode'];
        if (strlen($ampcode) == 4) {
            $ampcode = " AND concat(provcode,distcode) = '{$ampcode}' ";
        } else {
            $ampcode = '';
        }
        $m = Chospital::find()->where(
                        "provcode = '{$provcode}'
                            and hostype in ('03','05','06','07','18')
                            {$ampcode}
                            "
                )->all();

        $table = "labor";
        try {
            $sql = "DELETE FROM report_person_anc WHERE source = 'HDC' ";
            Yii::$app->db_datacenter->createCommand($sql)->execute();
        } catch (\Exception $exc) {
            #echo $exc->getMessage();
        }
        foreach ($m as $model) {
            $hospcode = $model->hoscode;
            $response = Cwebclient::getDataHdc($table, $hospcode, Yii::$app->params['ampcode']);
            #echo '<pre>';
            #print_r($response);
            #echo '</pre>';
            $textValues = '';
            foreach ($response['data']['fieldData'] as $rows) {
                $textValues .= "(";
                $dValues = '';
                foreach ($rows as $value) {
                    $dValues .= (empty($value) ? 'NULL' : "'" . $value . "'") . ',';
                }
                $textValues .= rtrim($dValues, ',') . "),";
            }
            $e = 0;
            try {
                $e = Yii::$app->db_datacenter->createCommand("INSERT  INTO report_person_anc (" . $response['data']['fields'] . ") VALUES " . rtrim($textValues, ',') . ";")->execute();
            } catch (\Exception $exc) {
                echo $exc->getMessage();
            }

            echo "Result  report_person_anc : {$hospcode} | {$e}", "\n";
        }
    }

}
