<?php

namespace app\modules\hdcservice\controllers;

use Yii;
use app\modules\hdcservice\models\MenuItems;
use app\modules\hdcservice\models\WuseItems;
#use app\modules\report\models\WuseItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * WuseItemsController implements the CRUD actions for WuseItems model.
 */
class WuseitemsController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionAdditems() {
        // $action =
        //$selection = (array) Yii::$app->request->post('keylist'); //typecasting
        //print_r(\Yii::$app->request->post('keylist'));
        //echo 'asdasdas';

        $selection = Yii::$app->request->post('keylist');
        $hoscode = Yii::$app->request->post('hoscode');
        $ok = 0;
        $error = 0;
        foreach ($selection as $id) {
            try {
                $e = new WuseItems;
                $e->hoscode = $hoscode;
                $e->menu_items_id = $id;
                $e->create_at = new \yii\db\Expression('NOW()');
                $e->save();
                $ok++;
            } catch (\Exception $exc) {
                $error++;
            }
        }
        echo 'OK:' . $ok . ' || Error:' . $error;
    }

    /**
     * Lists all WuseItems models.
     * @return mixed
     */
    public function actionIndex() {

        /*
          $dataProvider_rpt = new ActiveDataProvider([
          'query' => MenuItems::find()
          ->where(" menu_items_status = 1 and menu_group_id not in (select i.menu_group_id from wuse_items i)"),
          //'sort' => ['defaultOrder' => ['menu_group_id' => SORT_ASC, 'menu_items_id' => SORT_DESC]]
          ]);
         */

        $hoscode = \Yii::$app->request->get('hoscode');
        $dataProvider = new ActiveDataProvider([
            'query' => WuseItems::find()
                    ->where(" hoscode = '{$hoscode}'"),
                //'sort' => ['defaultOrder' => ['menu_group_id' => SORT_ASC, 'menu_items_id' => SORT_DESC]]
        ]);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WuseItems model.
     * @param string $hoscode
     * @param string $menu_items_id
     * @return mixed
     */
    public function actionView($hoscode, $menu_items_id) {
        return $this->render('view', [
                    'model' => $this->findModel($hoscode, $menu_items_id),
        ]);
    }

    /**
     * Creates a new WuseItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $hoscode = \Yii::$app->request->get('hoscode');
        $dataProvider_rpt = new ActiveDataProvider([
            'query' => MenuItems::find()
                    ->where("menu_items_active = 1 and menu_items_status > 1 and menu_items_id not in (select i.menu_items_id from wuse_items i where hoscode = '{$hoscode}')"),
                //'sort' => ['defaultOrder' => ['menu_group_id' => SORT_ASC, 'menu_items_id' => SORT_DESC]]
        ]);



        $model = new WuseItems();

        $model->hoscode = $hoscode;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'hoscode' => $model->hoscode, 'menu_items_id' => $model->menu_items_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'hoscode' => $hoscode,
                        'dataProvider_rpt' => $dataProvider_rpt,
            ]);
        }
    }

    /**
     * Updates an existing WuseItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $hoscode
     * @param string $menu_items_id
     * @return mixed
     */
    public function actionUpdate($hoscode, $menu_items_id) {
        $dataProvider_rpt = new ActiveDataProvider([
            'query' => MenuItems::find(),
                //'sort' => ['defaultOrder' => ['menu_group_id' => SORT_ASC, 'menu_items_id' => SORT_DESC]]
        ]);


        $model = $this->findModel($hoscode, $menu_items_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'hoscode' => $model->hoscode, 'menu_items_id' => $model->menu_items_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'dataProvider_rpt' => $dataProvider_rpt,
            ]);
        }
    }

    /**
     * Deletes an existing WuseItems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $hoscode
     * @param string $menu_items_id
     * @return mixed
     */
    public function actionDelete($hoscode, $menu_items_id) {
        $this->findModel($hoscode, $menu_items_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WuseItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $hoscode
     * @param string $menu_items_id
     * @return WuseItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($hoscode, $menu_items_id) {
        if (($model = WuseItems::findOne(['hoscode' => $hoscode, 'menu_items_id' => $menu_items_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
