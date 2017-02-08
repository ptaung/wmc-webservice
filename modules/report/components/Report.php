<?php

namespace app\modules\report\components;

use yii\web\Controller;
use yii\data\ArrayDataProvider;
use yii\helpers\Inflector;
use yii\helpers\VarDumper;
use app\modules\report\models\MenuItems;
use app\modules\report\models\MenuGroup;
use app\modules\report\models\Chospital;

class Report extends Controller {

    public $columns = [];
    public $sqlQuery = [];
    public $pageSize = 200; //จำนวนหน้าที่แสดงผล
    public $dataset;
    public $filter = [];

    public function init() {
        parent::init();
//กำหนดการเชื่อมต่อฐานข้อมูล
        $this->dataset = \Yii::$app->db_datacenter;
    }

    public function strReplace($replaceMap = []) {
        $request = $this->getFilter(); //
#echo '<pre>';
#print_r($request->get());
#echo '</pre>';
#exit;




        @list($startDate, $endDate) = explode('to', @$request['filterDate']);
        @$this->filter['startDate'] = trim($startDate);
        @$this->filter['endDate'] = trim($endDate);
        $this->filter['filterSearch'] = @$request['filterSearch'];
        $this->filter['filterAmp'] = @$request['filterAmp'];
        $this->filter['filterTmp'] = @$request['filterTmp'];
        $this->filter['filterShow'] = '';
        $this->filter['filterHospcode'] = @$request['filterHospcode'];

        if (@$request['filterShow'] == 'all') {
            $this->filter['filterShow'] = "'03','05','06','07'";
        } elseif (@$request['filterShow'] == 'hos') {
            $this->filter['filterShow'] = "'05','06','07'";
        } else if (@$request['filterShow'] == 'pcu') {
            $this->filter['filterShow'] = "'03'";
        } else {
            $this->filter['filterShow'] = "'03','05','06','07'";
        }

        $mapKeyword = [
            '{search}' => @$this->filter['filterSearch'],
            '{startdate}' => @$this->filter['startDate'],
            '{enddate}' => @$this->filter['endDate'],
            '{provcode}' => \Yii::$app->params['provcode'],
            '{amp}' => $this->filter['filterAmp'] = ($this->filter['filterAmp'] <> '' ? "='{$this->filter['filterAmp']}'" : NULL),
            '{tmp}' => ($this->filter['filterTmp'] <> '' ? "='{$this->filter['filterTmp']}'" : NULL),
        ];
#รับค่าหน่วยบริการมาจาก Link
        if (@$request['link'] <> '' && strlen(@$request['link']) == 5) {
            $mapKeyword = array_merge($mapKeyword, ['{hospcode}' => @$request['link']]);
            $mapKeyword = array_merge($mapKeyword, ['{table}' => 'dw_' . @$request['link'] . '.']);
        }
        $this->filter['filterHospcode'] = ($this->filter['filterHospcode'] <> '' ? "='{$this->filter['filterHospcode']}'" : NULL);

        if (@$request['filterHospcode'] <> '' && strlen(@$request['filterHospcode']) == 5) {
            $mapKeyword = array_merge($mapKeyword, [
                '{table}' => 'dw_' . @$request['filterHospcode'] . '.',
                '{hoscode}' => " = '{$request['filterHospcode']}'",
            ]);
        }
        if (count($replaceMap) > 0)
            $mapKeyword = array_merge($mapKeyword, $replaceMap);

        $keysearch = [];
        $keymap = [];

        foreach ($mapKeyword as $key => $value) {
            $keysearch[] = $key;
            $keymap[] = $value;
        }

        $query = str_replace($keysearch, $keymap, $this->sqlQuery);

        #echo '<pre>';
        #print_r($query);
        #echo '</pre>';
        #exit;

        return $query;
    }

    /*
     * getFilter
     * รับค่า filter จากหน้าเว็บ
     * @return array
     */

    public static function getFilter($var = '') {
        $request = \Yii::$app->request;
        if (!empty($var)) {
            return $request->get($var);
        } else {
            return $request->get();
        }
    }

    /*
     * ประมวลผลคำสั่งจากฐานข้อมูล
     */

    public function process() {
        $query = $this->strReplace();
        try {
            $result = $this->dataset->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => $this->pageSize,
                ],
            ]);
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
        }

        return $dataProvider;
    }

    public function processByManyDb() {
//init filter
        $this->strReplace();
//แก้ไขคำสั่ง SQL ตาม filter

        $m = Chospital::find()->where(
                        "provcode = '" . \Yii::$app->params['provcode'] . "'
                    AND hostype IN ({$this->filter['filterShow']})
        AND CONCAT(provcode,distcode) {$this->filter['filterAmp']}
        AND hoscode {$this->filter['filterHospcode']}
        "
                )->all();
        $data = [];
        foreach ($m as $model) {
            $query = $this->strReplace(['{hospcode}' => $model->hoscode, '{table}' => 'dw_' . $model->hoscode . '.']);
            $result = $this->dataset->createCommand($query)->queryAll();
            //เพิ่มข้อมูลเพิ่มเติม
            $result[0]['hoscode'] = $model->hoscode;
            $result[0]['hosname'] = $model->hosname;
            array_push($data, $result[0]);
        }

        #echo '<pre>';
        #print_r($data);
        #echo '</pre>';
        #exit;


        $attributes = @count($data[0]) > 0 ? array_keys($data[0]) : array(); //หาชื่อ field ในตาราง
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => $attributes,
            ],
            'pagination' => [
                'pageSize' => $this->pageSize,
            ],
        ]);

        return $dataProvider;
    }

    public function getMenuDetail($item) {
        $model = MenuItems::find()->where('menu_items_id =' . $item)->one();
        return $model;
    }

    public function getMenuGroupDetail($id) {
        $model = MenuGroup::find()->where('menu_group_id =' . $id)->one();
        return $model;
    }

    /*
     * getListDb
     * คืนค่าการเชื่อมต่อฐานข้อมูลใน Config
     * @return array
     */

    public static function getListDb() {
        $listDb = [];
        foreach (\Yii::$app->getComponents() as $key => $value) {
            if (strpos($key, 'db') !== FALSE) {
                $listDb[$key] = $key;
            } else {
                continue;
            }
        }
        return $listDb;
    }

    /*
     * getListModules
     * ใช้แสดงรายการ Modules
     * @return array $ref
     */

    public function getListModules() {

        $key = __METHOD__;
        $ref = [];
        $cache = null;
        if ($cache === null || ($result = $cache->get($key)) === false) {
            $result = [];
            $this->getRouteRecrusive(Yii::$app, $result);
        }
        foreach ($result as $key => $module) {
            if (substr($module, 0, 3) === '/wm' && !strpos($module, '*')) { //แสดงรายการเฉพาะโมดูล WM
                $ref[] = $module;
            }
        }
        return $ref;
    }

    /**
     * Get route(s) recrusive
     * @param \yii\base\Module $module
     * @param array $result
     */
    private function getRouteRecrusive($module, &$result) {
        $token = "Get Route of '" . get_class($module) . "' with id '" . $module->uniqueId . "'";
        Yii::beginProfile($token, __METHOD__);
        try {
            foreach ($module->getModules() as $id => $child) {
                if (($child = $module->getModule($id)) !== null) {
                    $this->getRouteRecrusive($child, $result);
                }
            }

            foreach ($module->controllerMap as $id => $type) {
                $this->getControllerActions($type, $id, $module, $result);
            }

            $namespace = trim($module->controllerNamespace, '\\') . '\\';
            $this->getControllerFiles($module, $namespace, '', $result);
            $result[] = ($module->uniqueId === '' ? '' : '/' . $module->uniqueId) . '/*';
        } catch (\Exception $exc) {
            Yii::error($exc->getMessage(), __METHOD__);
        }
        Yii::endProfile($token, __METHOD__);
    }

    private function getControllerFiles($module, $namespace, $prefix, &$result) {
        $path = @Yii::getAlias('@' . str_replace('\\', '/', $namespace));
        $token = "Get controllers from '$path'";
        Yii::beginProfile($token, __METHOD__);
        try {
            if (!is_dir($path)) {
                return;
            }
            foreach (scandir($path) as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                }
                if (is_dir($path . '/' . $file)) {
                    $this->getControllerFiles($module, $namespace . $file . '\\', $prefix . $file . '/', $result);
                } elseif (strcmp(substr($file, -14), 'Controller.php') === 0) {
                    $id = Inflector::camel2id(substr(basename($file), 0, -14));
                    $className = $namespace . Inflector::id2camel($id) . 'Controller';
                    if (strpos($className, '-') === false && class_exists($className) && is_subclass_of($className, 'yii\base\Controller')) {
                        $this->getControllerActions($className, $prefix . $id, $module, $result);
                    }
                }
            }
        } catch (\Exception $exc) {
            Yii::error($exc->getMessage(), __METHOD__);
        }
        Yii::endProfile($token, __METHOD__);
    }

    private function getControllerActions($type, $id, $module, &$result) {
        $token = "Create controller with cofig=" . VarDumper::dumpAsString($type) . " and id='$id'";
        Yii::beginProfile($token, __METHOD__);
        try {
            $controller = Yii::createObject($type, [$id, $module]);
            $this->getActionRoutes($controller, $result);
            $result[] = '/' . $controller->uniqueId . '/*';
        } catch (\Exception $exc) {
            Yii::error($exc->getMessage(), __METHOD__);
        }
        Yii::endProfile($token, __METHOD__);
    }

    private function getActionRoutes($controller, &$result) {
        $token = "Get actions of controller '" . $controller->uniqueId . "'";
        Yii::beginProfile($token, __METHOD__);
        try {
            $prefix = '/' . $controller->uniqueId . '/';
            foreach ($controller->actions() as $id => $value) {
                $result[] = $prefix . $id;
            }
            $class = new \ReflectionClass($controller);
            foreach ($class->getMethods() as $method) {
                $name = $method->getName();
                if ($method->isPublic() && !$method->isStatic() && strpos($name, 'action') === 0 && $name !== 'actions') {
                    $result[] = $prefix . Inflector::camel2id(substr($name, 6));
                }
            }
        } catch (\Exception $exc) {
            Yii::error($exc->getMessage(), __METHOD__);
        }
        Yii::endProfile($token, __METHOD__);
    }

}
