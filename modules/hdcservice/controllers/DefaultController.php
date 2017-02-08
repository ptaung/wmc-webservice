<?php

namespace app\modules\hdcservice\controllers;

use yii\web\Controller;
use app\modules\hdcservice\models\MenuGroup;
use app\modules\hdcservice\models\MenuItems;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;
use app\modules\hdcservice\models\Chospital;
use app\modules\hdcservice\models\Ctambon;
use app\modules\hdcservice\models\Campur;
use app\modules\hdcservice\models\Cchangwat;
use app\modules\hdcservice\models\Sysreport;

class DefaultController extends Controller {

    public function actionIndex() {
        $model = MenuGroup::find()->asArray()->all();
        return $this->render('index', ['mgroup' => $model]);
    }

    public function actionMenu($id) {
        $model = MenuItems::find()->andWhere("menu_group_id ='{$id}' and menu_items_active = 1 and menu_items_status = 2")->all();
        return $this->render('menu', ['model' => $model]);
    }

    public function actionListmenu() {
        $q = \Yii::$app->request->post('q');
        if (!empty($q)) {
            $dataProvider = new ActiveDataProvider([
                'query' => MenuItems::find()
                        ->where('menu_items_name LIKE "%' . $q . '%"')
                        ->limit(10)
                        ->orderBy(['menu_items_name' => SORT_ASC,]),
                'pagination' => FALSE,
                    ]
            );
            return $this->renderAjax('listmenu', [
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            echo 'ไม่พบข้อมูล !';
        }


        #return $this->render('menu', ['model' => $model]);
    }

    public static function actionGetchw() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);

            $list = Cchangwat::find()->andWhere(['zonecode' => $id])->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                $out[] = ['id' => '0', 'name' => 'เลือกทั้งหมด'];
                foreach ($list as $i => $rows) {
                    $out[] = ['id' => $rows['changwatcode'], 'name' => ('(' . $rows['changwatcode'] . @$_GET['filterChw'] . ') ' . $rows['changwatname'])];
                    if ($i == 0) {
                        $selected = (isset($_GET['selected']) ? $_GET['selected'] : '');
                    }
                }
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public static function actionGetamp() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);

            $list = Campur::find()->andWhere(['changwatcode' => $id])->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                $out[] = ['id' => '0', 'name' => 'เลือกทั้งหมด'];
                foreach ($list as $i => $rows) {
                    $out[] = ['id' => $rows['ampurcodefull'], 'name' => ('(' . $rows['ampurcodefull'] . ') ' . $rows['ampurname'])];
                    if ($i == 0) {
                        $selected = (isset($_GET['selected']) ? $_GET['selected'] : '');
                    }
                }
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public static function actionGettmp() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);

            $list = Ctambon::find()->andWhere(['ampurcode' => $id])->asArray()->all();
            $selected = null;

            if ($id != null && count($list) > 0) {
                $selected = '';
                $out[] = ['id' => '0', 'name' => 'เลือกทั้งหมด'];
                foreach ($list as $i => $rows) {
                    $out[] = ['id' => $rows['tamboncodefull'], 'name' => ('(' . $rows['tamboncodefull'] . ') ' . $rows['tambonname'])];
                    if ($i == 0) {
                        $selected = (isset($_GET['selected']) ? $_GET['selected'] : '');
                    }
                }
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGethoscode() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);

            $list = Chospital::find()->andWhere(['provcode' => \Yii::$app->params['provcode'], 'concat(provcode,distcode)' => $id])->asArray()->all();

            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $rows) {
                    $out[] = ['id' => $rows['hoscode'], 'name' => ('(' . $rows['hoscode'] . ') ' . $rows['hosname'])];
                    if ($i == 0) {
                        $selected = $rows['hoscode'];
                    }
                }
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
        #return $this->render('index');
    }

    public static function actionGetsysreport() {
        $out = [];
        #if (isset($_POST['depdrop_parents'])) {
        #$id = end($_POST['depdrop_parents']);

        $list = Sysreport::find()->asArray()->all();
        $selected = null;

        if (count($list) > 0) {
            $selected = '';
            $out[] = ['id' => '0', 'name' => 'เลือกทั้งหมด'];
            foreach ($list as $i => $rows) {
                $out[] = ['id' => $rows['id'], 'name' => ('(' . $rows['id'] . ') ' . $rows['report_name'])];
                if ($i == 0) {
                    $selected = (isset($_GET['selected']) ? $_GET['selected'] : '');
                }
            }
            // Shows how you can preselect a value
            echo Json::encode(['output' => $out, 'selected' => $selected]);
            return;
        }
        #}
        echo Json::encode(['output' => '', 'selected' => '']);
    }

}
