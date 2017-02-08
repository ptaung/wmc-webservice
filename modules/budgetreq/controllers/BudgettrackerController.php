<?php

namespace app\modules\budgetreq\controllers;

use Yii;
use app\modules\budgetreq\models\PhStepEbidding;
use app\modules\budgetreq\models\PhStepShopping;
use app\modules\budgetreq\models\PhStepSpecial;
use app\modules\budgetreq\models\PhStepDeal;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PhstepebiddingController implements the CRUD actions for PhStepEbidding model.
 */
class BudgettrackerController extends Controller {

    /**
     * @inheritdoc
     */
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
     * Lists all PhStepEbidding models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider_ebidding = new ActiveDataProvider([
            'query' => PhStepEbidding::find(),
        ]);
        $dataProvider_shopping = new ActiveDataProvider([
            'query' => PhStepShopping::find(),
        ]);
        $dataProvider_special = new ActiveDataProvider([
            'query' => PhStepSpecial::find(),
        ]);
        $dataProvider_deal = new ActiveDataProvider([
            'query' => PhStepDeal::find(),
        ]);


        $dataView_ebidding = new ActiveDataProvider([
            'query' => PhStepEbidding::find(),
        ]);
        $dataView_shopping = new ActiveDataProvider([
            'query' => PhStepShopping::find(),
        ]);
        $dataView_special = new ActiveDataProvider([
            'query' => PhStepSpecial::find(),
        ]);
        $dataView_deal = new ActiveDataProvider([
            'query' => PhStepDeal::find(),
        ]);

        return $this->render('index', [
                    'dataEbidding' => $dataProvider_ebidding,
                    'dataShopping' => $dataProvider_shopping,
                    'dataSpecial' => $dataProvider_special,
                    'dataDeal' => $dataProvider_deal,
                    'dataEbidding_complete' => $dataView_ebidding,
                    'dataShopping_complete' => $dataView_shopping,
                    'dataSpecial_complete' => $dataView_special,
                    'dataDeal_complete' => $dataView_deal,
        ]);
    }

    public function actionUpdateebidding($id) {
        $model = PhStepEbidding::findOne($id);
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => $model->save()];
        }
        return $this->renderAjax('_form_ebidding', [
                    'model' => $model,
                    'url' => \Yii::$app->request->post('url'),
                    'step' => \Yii::$app->request->post('step'),
        ]);
    }

    public function actionUpdatespecial($id) {
        $model = PhStepSpecial::findOne($id);
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => $model->save()];
        }
        return $this->renderAjax('_form_special', [
                    'model' => $model,
                    'url' => \Yii::$app->request->post('url'),
                    'step' => \Yii::$app->request->post('step'),
        ]);
    }

    public function actionUpdateshopping($id) {
        $model = PhStepShopping::findOne($id);
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => $model->save()];
        }
        return $this->renderAjax('_form_shopping', [
                    'model' => $model,
                    'url' => \Yii::$app->request->post('url'),
                    'step' => \Yii::$app->request->post('step'),
        ]);
    }

    public function actionUpdatedeal($id) {
        $model = PhStepDeal::findOne($id);
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => $model->save()];
        }
        return $this->renderAjax('_form_deal', [
                    'model' => $model,
                    'url' => \Yii::$app->request->post('url'),
                    'step' => \Yii::$app->request->post('step'),
        ]);
    }

    /**
     * Displays a single PhStepEbidding model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PhStepEbidding model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PhStepEbidding();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->step_ebidding_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PhStepEbidding model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->step_ebidding_id]);
        } else {
            return $this->renderP('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PhStepEbidding model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PhStepEbidding model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhStepEbidding the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PhStepEbidding::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
