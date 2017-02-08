<?php

namespace app\modules\budgetreq\controllers;

use Yii;
use app\modules\budgetreq\models\PhOrder;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;

/**
 * OrderController implements the CRUD actions for PhOrder model.
 */
class OrderController extends Controller {

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
     * Lists all PhOrder models.
     * @return mixed
     */
    public function actionIndex() {

        //$searchModel = new PhOrder;
        #$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        $dataProvider = new ActiveDataProvider([
            'query' => PhOrder::find(Yii::$app->request->getQueryParams()),
            'sort' => ['defaultOrder' => ['hospcode' => SORT_ASC, 'order_priority' => SORT_ASC, 'request_id' => SORT_ASC]]
        ]);

// validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $id = Yii::$app->request->post('editableKey');
            $model = PhOrder::findOne($id);
            // store a default json response as desired by editable
            $out = Json::encode(['output' => '', 'message' => '']);
            $post = [];
            $posted = current($_POST['PhOrder']);
            $post['PhOrder'] = $posted;

            // load model like any single model validation
            if ($model->load($post)) {
                // can save model or do something before saving model
                $model->order_date_modify = new \yii\db\Expression('NOW()');
                $model->save();
                $output = '';

                if (isset($posted['order_priority'])) {
                    $output = $model->order_priority;
                }

                $out = Json::encode(['output' => $output, 'message' => '']);
            }
            // return ajax json encoded response and exit
            echo $out;
            return;
        }


        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                        //'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single PhOrder model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PhOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PhOrder();

        if ($model->load(Yii::$app->request->post())) {

            $model->order_date = new \yii\db\Expression('NOW()');

            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PhOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $obj = ['project', 'spec', 'cost', 'breakeven', 'etc'];
        $model = $this->findModel($id);
        $model->scenario = 'update'; //บังคับให้ไฟล์ต้อง upload  เฉพาะหน้าแก้ไขเท่านั้น
        //----------------------------------------------------------------------
        $subfix = $model->hospcode . '_' . $id . '.pdf';

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {

                foreach ($obj as $label) {// Loop upload ไฟล์
                    $var = 'file_' . $label; //ตัวแปลรับไฟล์
                    $varModel = 'order_file_' . $label; //ตัวแปลเพิ่มข้อมูล

                    $model->$var = UploadedFile::getInstance($model, 'file_' . $label);

                    if ($model->$var) {//บันทึกเฉพาะที่มีการเลือกไฟล์
                        $fn = 'uploads/file' . ucfirst($label) . '_' . $subfix;
                        $model->$var->saveAs($fn);
                        $model->$var = null;
                        $model->$varModel = $fn;
                    }
                }

                //----------------------------------------------------------------------
                //บันทึกค่าแก้ไขล่าสุด
                $model->order_date_modify = new \yii\db\Expression('NOW()');
                if ($model->save()) {
                    return $this->redirect(['index']);
                } else {
                    return $this->render('update', [
                                'model' => $model,
                    ]);
                }
            }
            return $this->render('update', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PhOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {

        try {
            $this->findModel($id)->delete();
        } catch (\Exception $e) {
            // throw Exception('ไม่สามารถลบข้อมูลนี้ได้เนื่องจากมีการใช้งานข้อมูลนี้แล้ว');
            throw new \yii\web\HttpException(400, 'ไม่สามารถลบข้อมูลนี้ได้เนื่องจากมีการใช้งานข้อมูลนี้แล้ว');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the PhOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PhOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PhOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
