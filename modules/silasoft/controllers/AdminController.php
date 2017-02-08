<?php

namespace app\modules\silasoft\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;

/**
 * Default controller for the `silasoft` module
 */
class AdminController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $session = \Yii::$app->session;

        if (\Yii::$app->request->get('adminMode') == FALSE) {
            $session->remove('adminMode');
            $this->redirect(['/']);
        }
        if (\Yii::$app->request->get('adminMode') == TRUE) {
            if (!$session->has('adminMode'))
                $session->set('adminMode', TRUE);
        }
        return $this->render('index');
    }

    public function actionKillprocess($id) {
        try {
            \Yii::$app->db->createCommand("KILL {$id};")->execute();
            echo 'success';
        } catch (\Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function actionProcesslist() {
        $query = "SELECT * FROM INFORMATION_SCHEMA.PROCESSLIST WHERE user NOT IN ('BmsGateway');";
        try {
            $result = Yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                #'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 1000,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('processlist', ['dataProvider' => $dataProvider]);
    }

    public function actionClearcache() {
        Yii::$app->cache->flush();
        echo 'Completed';
    }

}
