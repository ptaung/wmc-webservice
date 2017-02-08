<?php

namespace app\modules\budgetreq\controllers;

use Yii;
use app\modules\budgetreq\models\PhOperationRequest;
#use app\modules\budgetreq\models\PhOperation;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

#use yii\helpers\Json;
//use yii\web\JsExpression;

/**
 * OperationreqController implements the CRUD actions for PhOperationRequest model.
 */
class OperationreqController extends Controller {

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
     * Lists all PhOperationRequest models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => PhOperationRequest::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhOperationRequest model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

//สำหรับให้ Ajax เรียกใช้งาน
    public function actionReq($id, $order_id) {

        //$model = PhOperationRequest::find()->with('oporder')->where(['request_id' => $id])->one();
        //$sql = "SELECT * FROM ";
//            'query' => PhOperationRequest::find()->where(['request_id' => $id, 'order_id' => $order_id])


        $dataProvider = new ActiveDataProvider([
            // 'query' => PhOperationRequest::findBySql($sql)
            'query' => PhOperationRequest::find()->joinWith('oporder')->where(['request_id' => $id])//, 'ph_operation_order.order_id' => $order_id])
        ]);

        return $this->renderAjax('req', [
                    'dataProvider' => $dataProvider,
                    'order_id' => $order_id,
        ]);
    }

    /**
     * Creates a new PhOperationRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PhOperationRequest();
        #$duallistbox = PhOperation::find(); //แสดงในตัวเลือก


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {

            return $this->render('create', [
                        'model' => $model,
                        'duallistbox' => '',
            ]);
        }
    }

    /**
     * Updates an existing PhOperationRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        #$duallistbox = PhOperation::find($id); //แสดงในตัวเลือก

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->operation_request_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'duallistbox' => '',
            ]);
        }
    }

    /**
     * Deletes an existing PhOperationRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PhOperationRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhOperationRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PhOperationRequest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
