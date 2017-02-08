<?php

namespace app\modules\hdcservice\models;

use Yii;
use yii\data\ArrayDataProvider;
use yii\data\SqlDataProvider;

#use backend\models\Chospcodeowner;

/**
 * This is the model class for table "sys_config".
 *
 * @property integer $id
 * @property string $level
 * @property string $zonecode
 * @property string $provincecode
 * @property string $job
 * @property string $sendtime
 * @property string $process
 * @property integer $fetchsize
 * @property string $epiddate
 * @property string $iphdcjava
 * @property integer $iphdcjava_port
 * @property string $ipzone
 * @property integer $ipzone_port
 * @property string $ipmoph
 * @property integer $ipmoph_port
 * @property integer $yearprocess
 * @property string $document_root
 * @property integer $week_check
 */
class Sysconfig extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'sys_config';
    }

    public static function getDb() {
        return Yii::$app->get('db_hdc');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['fetchsize', 'iphdcjava_port', 'ipzone_port', 'ipmoph_port', 'yearprocess', 'week_check'], 'integer'],
            [['level', 'process'], 'string', 'max' => 1],
            [['zonecode', 'provincecode'], 'string', 'max' => 2],
            [['job', 'sendtime'], 'string', 'max' => 5],
            [['epiddate'], 'string', 'max' => 10],
            [['iphdcjava', 'ipzone', 'ipmoph', 'document_root', 'dbname'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'level' => 'Level',
            'zonecode' => 'Zonecode',
            'provincecode' => 'Provincecode',
            'job' => 'Job',
            'sendtime' => 'Sendtime',
            'process' => 'Process',
            'fetchsize' => 'Fetchsize',
            'epiddate' => 'Epiddate',
            'iphdcjava' => 'Iphdcjava',
            'iphdcjava_port' => 'Iphdcjava Port',
            'ipzone' => 'Ipzone',
            'ipzone_port' => 'Ipzone Port',
            'ipmoph' => 'Ipmoph',
            'ipmoph_port' => 'Ipmoph Port',
            'yearprocess' => 'Yearprocess',
            'document_root' => 'Document Root',
            'week_check' => 'Week Check',
        ];
    }

    public static function getProvinceConfig($id) {
        if ($id != '') {
            $id_ok = $id;
        } else {
            $id_ok = '1';
        }

        $connection = Yii::$app->db;
        $qryProvince = $connection->createCommand("SELECT * FROM sys_config WHERE id = '" . $id_ok . "'")
                ->queryAll();
        $provinceProvider = new ArrayDataProvider([
            'allModels' => $qryProvince
        ]);

        $ProvinceData = $provinceProvider->getModels();
        foreach ($ProvinceData as $dataProvince) {
            $province = $dataProvince['provincecode'];
        }

        return $province;
    }

    public static function getAmpurConfig($id) {
        if ($id != '') {
            $id_ok = $id;
        } else {
            $id_ok = '1';
        }

        $connection = Yii::$app->db;
        $qryAmpur = $connection->createCommand("SELECT * FROM sys_config WHERE id = '" . $id_ok . "'")
                ->queryAll();
        $ampurProvider = new ArrayDataProvider([
            'allModels' => $qryAmpur
        ]);

        $AmpurData = $ampurProvider->getModels();
        foreach ($AmpurData as $dataAmpur) {
            $ampur = $dataAmpur['ampurcode'];
        }

        return $ampur;
    }

    public static function getLevelConfig($id) {
        if ($id != '') {
            $id_ok = $id;
        } else {
            $id_ok = '1';
        }

        if ($id_ok != '') {
            $data = Sysconfig::find()
                    ->select('level')
                    ->where('id="' . $id_ok . '"')
                    ->all();

            foreach ($data as $v) {
                $level = $v['level'];
            }
        } else {
            $level = '';
        }

        return $level;
    }

    public static function getZonecodeConfig($id) {
        if ($id != '') {
            $id_ok = $id;
        } else {
            $id_ok = '1';
        }

        if ($id_ok != '') {
            $data = Sysconfig::find()
                    ->select('zonecode')
                    ->where('id="' . $id_ok . '"')
                    ->all();

            foreach ($data as $v) {
                $zonecode = $v['zonecode'];
            }
        } else {
            $zonecode = '';
        }

        return $zonecode;
    }

    public static function getThaiDate($InputDate) {
        $day = substr($InputDate, 6, 2);
        $month = substr($InputDate, 4, 2);
        $year = substr($InputDate, 0, 4) + 543;
        switch ($month) {
            case "01":
                $month_name = "มกราคม";
                break;
            case "02":
                $month_name = "กุมภาพันธ์";
                break;
            case "03":
                $month_name = "มีนาคม";
                break;
            case "04":
                $month_name = "เมษายน";
                break;
            case "05":
                $month_name = "พฤษภาคม";
                break;
            case "06":
                $month_name = "มิถุนายน";
                break;
            case "07":
                $month_name = "กรกฎาคม";
                break;
            case "08":
                $month_name = "สิงหาคม";
                break;
            case "09":
                $month_name = "กันยายน";
                break;
            case "10":
                $month_name = "ตุลาคม";
                break;
            case "11":
                $month_name = "พฤศจิกายน";
                break;
            case "12":
                $month_name = "ธันวาคม";
                break;
            default:
                $month_name = "ไม่ระบุ";
        }
        $thaidatenew = (int) $day . " " . $month_name . " " . $year;

        return $thaidatenew;
    }

    public static function getUserOffice($user_id = null) {
        if ($user_id != '') {
            $command = Yii::$app->db->createCommand("SELECT location FROM profile WHERE user_id='" . $user_id . "'");
            $UserOffice = $command->queryScalar();
        } else {
            $UserOffice = '';
        }

        return $UserOffice;
    }

    public static function getOwnerHospcode($UserOffice = null) {//หาหน่วยบริการในเขตอำเภอ จังหวัด
        $connection = Yii::$app->db;
        if ($UserOffice != '') {
            //เช็คว่าเป็นหน่วยงานในระดับใดก่อน
            $sqlx = "SELECT hostype FROM chospital WHERE hoscode = '" . $UserOffice . "'";
            $OwnerLevel = $connection->createCommand($sqlx)->queryScalar();

            if ($OwnerLevel == '01') {//จังหวัด
                $where = 'owner_changwat';
            } elseif ($OwnerLevel == '02') {//อำเภอ
                $where = 'owner_ampur';
            } else {//หน่วยบริการ
                $where = 'hoscode';
            }

            $OwnerAmpur = [];
            $sql = "SELECT hoscode FROM chospital WHERE " . $where . " ='" . $UserOffice . "' AND hostype not in ('01','02')";
            $OwnerAmpur = $connection->createCommand($sql)
                    ->queryAll();
            $Hospcode = array();
            foreach ($OwnerAmpur as $data) {
                $Hospcode[] = "'" . $data['hoscode'] . "'";
            }
        } else {
            $Hospcode = '';
        }

        return $Hospcode;
    }

    public static function getIphdcjava($id) {
        $iphdcjava = '';
        if (strlen(trim($id)) > 0) {
            $sql = "SELECT
                            iphdcjava
                    FROM sys_config
                    WHERE id='" . $id . "'";
            $iphdcjava = Yii::$app->db->createCommand($sql)->queryScalar();
            if ($iphdcjava == '127.0.0.1') {
                $iphdcjava_ok = 'localhost';
            } else {
                $iphdcjava_ok = $iphdcjava;
            }
        } else {
            $iphdcjava_ok = '';
        }

        return $iphdcjava_ok;
    }

    public static function getIphdcjavaport($id) {
        $iphdcjavaport = '';
        if (strlen(trim($id)) > 0) {
            $sql = "SELECT
                            iphdcjava_port
                    FROM sys_config a
                    WHERE id='" . $id . "'";
            $iphdcjavaport = Yii::$app->db->createCommand($sql)->queryScalar();
        } else {
            $iphdcjavaport = '';
        }

        return $iphdcjavaport;
    }

    public static function getDbname() {
        $dbname = Yii::$app->db->createCommand("SELECT dbname FROM sys_config WHERE id='1'")->queryScalar();

        return $dbname;
    }

    public static function getImportType() {
        $import_type = Yii::$app->db->createCommand("SELECT '' as import_type FROM sys_config WHERE id='1'")->queryScalar();

        return $import_type;
    }

}
