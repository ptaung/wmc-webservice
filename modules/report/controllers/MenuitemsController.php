<?php

namespace app\modules\report\controllers;

use Yii;
use app\modules\report\models\MenuItems;
use app\modules\report\models\MenuItemsSearch;
#use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenuItemsController implements the CRUD actions for MenuItems model.
 */
class MenuitemsController extends Controller {

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

    /**
     * Lists all MenuItems models.
     * @return mixed
     */
    public function actionIndex() {

        $rolesById = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());

        $condition = '';
        if (isset($rolesById['SQL-EDITOR']->name)) {
            $condition = "menu_items_user_create is null || menu_items_user_create = " . Yii::$app->user->getId();
        }



        $searchModel = new MenuItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $condition);
        /*
          $dataProvider = new ActiveDataProvider([
          'query' => MenuItems::find(),
          'sort' => ['defaultOrder' => ['menu_group_id' => SORT_ASC, 'menu_items_id' => SORT_DESC]]
          ]);
         */
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single MenuItems model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MenuItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $model = new MenuItems();

        $model->menu_items_columns = "@#COUMNS
	[
          'label' => 'รหัส',
          'attribute' => 'hospcode',
          'format' => 'raw',
    ],
	[
          'label' => 'หน่วยบริการ',
          'attribute' => 'hosname',
          'format' => 'raw',
    ],";

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->menu_items_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MenuItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $flashError = '';
        $flashMsg = '';
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $flashError = 'success';
            $flashMsg = 'สถานะ:บันทึกข้อมูลเรียบร้อยแล้ว';
            \Yii::$app->getSession()->setFlash($flashError, $flashMsg);
            return $this->redirect(['update', 'id' => $model->menu_items_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MenuItems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MenuItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MenuItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MenuItems::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
