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

class DefaultController extends Controller {

    public function actionService() {
        //Load items from webservice
        $response = Cwebclient::getReportSerive();
        foreach ($response['data'] as $rows) {
            try {
                $model = new WuseItemsLocal();
                $model->report_id = $rows['items_id'];
                $model->create_at = new \yii\db\Expression('NOW()');
                $model->save();
            } catch (\Exception $exc) {

            }
        }
        echo '<pre>';
        print_r($response);
        echo '</pre>';
    }

    public function actionWmreport() {
        return $this->render('wmreport');
    }

    public function actionIndex() {
        $report = Cwebclient::getReportSerive();
        $rpt = [];
        foreach ((array) $report['data'] as $value) {
            @$rpt[$value['items_id']] = $value;
        }
        $model = WuseGroupLocal::find()->asArray()->all();

        return $this->render('index', ['mgroup' => $model, 'report' => $rpt]);
    }

    public function actionMenu($id) {
        if ($id === '0')
            $id = NULL;

        $report = Cwebclient::getReportSerive(NULL, $id);
        $rpt = [];
        $cc = 0;
        $model = [];
        foreach ((array) $report['data'] as $value) {
            if ($value['individual'] == 0)
                @$rpt[$value['items_id']] = $value;
        }

        return $this->render('menu', ['model' => $model, 'report' => $rpt, 'cc' => count($rpt)]);
    }

    public function actionListmenu() {
        $q = \Yii::$app->request->post('q');
        if (!empty($q)) {
            $report = Cwebclient::getReportSerive(NULL, NULL, $q);

            $dataProvider = new ArrayDataProvider([
                'allModels' => $report['data'],
                'pagination' => FALSE
            ]);

            /*
              $dataProvider = new ActiveDataProvider([
              'query' => MenuItems::find()
              ->where('menu_items_name LIKE "%' . $q . '%"')
              ->limit(10)
              ->orderBy(['menu_items_name' => SORT_ASC,]),
              'pagination' => FALSE,
              ]
              );
             *
             */
            return $this->renderAjax('listmenu', [
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            echo 'ไม่พบข้อมูล!';
        }
    }

    public function actionGettmp() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);

            $list = Ctambon::find()->andWhere(['ampurcode' => $id])->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $out[] = ['id' => '0', 'name' => 'เลือกทั้งหมด'];
                $selected = '';
                foreach ($list as $i => $rows) {
                    $out[] = ['id' => $rows['tamboncodefull'], 'name' => ('(' . $rows['tamboncodefull'] . ') ' . $rows['tambonname'])];
                    if ($i == 0) {
                        $selected = $rows['tamboncodefull'];
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

            $list = Chospital::find()->where("hostype in ('03','05','06','07','18')")->andWhere(['provcode' => \Yii::$app->params['provcode'], 'concat(provcode,distcode)' => $id])->asArray()->all();

            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                $out[] = ['id' => '0', 'name' => 'เลือกทั้งหมด'];
                foreach ($list as $i => $rows) {
                    $out[] = ['id' => $rows['hoscode'], 'name' => ('(' . $rows['hoscode'] . ') ' . $rows['hosname'])];
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
        #return $this->render('index');
    }

}
