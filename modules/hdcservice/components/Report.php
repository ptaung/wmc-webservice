<?php

namespace app\modules\hdcservice\components;

use yii\web\Controller;
use yii\data\ArrayDataProvider;
use yii\helpers\Inflector;
use yii\helpers\VarDumper;
use app\modules\hdcservice\models\MenuItems;
use app\modules\hdcservice\models\MenuGroup;
use app\modules\hdcservice\models\Chospital;

class Report extends Controller {

    public $columns = [];
    public $sqlQuery = [];
    public $pageSize = 200; //จำนวนหน้าที่แสดงผล
    public $dataset;
    public $filter = [];
    public $tableFilter;
    public $clabel;

    public function init() {
        parent::init();
//กำหนดการเชื่อมต่อฐานข้อมูล
        $this->dataset = \Yii::$app->db_hdc;
    }

    public function getClabel() {
        return $this->clabel;
    }

    public function strReplace($replaceMap = []) {
        $request = $this->getFilter(); //

        @$this->filter['filterByear'] = @$request['filterByear'];
        @$this->filter['filterZone'] = @$request['filterZone'];
        @$this->filter['filterChw'] = @$request['filterChw'];
        @$this->filter['filterAmp'] = @$request['filterAmp'];
        @$this->filter['filterTmb'] = @$request['filterTmb'];
        @$this->filter['filterCup'] = @$request['filterCup'];
        @$this->filter['filterHospital'] = @$request['filterHospital'];

        $groupby = " ";
        $arealabel = "1";

        if (strlen($this->filter['filterZone']) == 2) {
            $wherefield = "changwatcode"; #จังหวัด
            $groupby = "LEFT(areacode,2)";
            $sql = "SELECT concat(changwatcode,' ',changwatname) as arealabel ,s.* FROM cchangwat {join} WHERE zonecode = '{$this->filter['filterZone']}'";
            $this->clabel = "จังหวัด";
        }
        if (strlen($this->filter['filterChw']) == 2) {
            $wherefield = "ampurcodefull"; #อำเภอ
            $groupby = "LEFT(areacode,4)";
            $sql = "SELECT concat(ampurcode,' ',ampurname) as arealabel,s.* FROM campur {join} WHERE changwatcode = '{$this->filter['filterChw']}'";
            $this->clabel = "อำเภอ";
        }
        if (strlen($this->filter['filterAmp']) == 4) {
            $wherefield = "tamboncodefull"; #ตำบล
            $groupby = "LEFT(areacode,6)";
            $sql = "SELECT concat(tamboncode,' ',tambonname) as arealabel,s.* FROM ctambon {join} WHERE ampurcode = '{$this->filter['filterAmp']}'";
            $this->clabel = "ตำบล";
        }
        if (strlen($this->filter['filterTmb']) == 6) {
            $wherefield = "villagecodefull"; #หมู่บ้าน
            $groupby = "LEFT(areacode,8)";
            $sql = "SELECT concat(villagecode,' ',villagename) as arealabel,s.* FROM cvillage {join} WHERE tamboncode = '{$this->filter['filterTmb']}'";
            $this->clabel = "หมู่บ้าน";
        }
        if (strlen($this->filter['filterCup']) == 5) {
            $wherefield = "hsub"; #หน่วยบริการในเครือข่าย
            $groupby = "hospcode";
            $sql = "SELECT concat(cmastercup.hsub, chospital.hosname) as arealabel,s.*
                        FROM cmastercup
                        INNER JOIN chospital ON chospital.hoscode = cmastercup.hsub
                        {join}
                        WHERE 1 #chospital.provcode = '{$this->filter['filterChw']}'
                        AND cmastercup.hmain = '{$this->filter['filterCup']}'
                        ORDER BY chospital.distcode,chospital.subdistcode";
            $this->clabel = "เครือข่ายบริการสุขภาพ";
        }


        $mapKeyword = [
            '{table}' => @$this->tableFilter,
            '{byear}' => @$this->filter['filterByear'],
            '{areacode}' => $groupby . ' as areacode',
        ];

        foreach ($mapKeyword as $key => $value) {
            $keysearch[] = $key;
            $keymap[] = $value;
        }

        $query = str_replace($keysearch, $keymap, $this->sqlQuery); //SQL จากระบบหน้าเว็บ
        $groupby = "GROUP BY {$groupby}";
        $where = "WHERE b_year = '{$this->filter['filterByear']}'";
        $leftjoin = "LEFT JOIN ({$query} {$where} {$groupby}) s ON s.areacode = {$wherefield} ";


        $mapKeyword = [
            '{byear}' => @$this->filter['filterByear'],
            '{arealabel}' => $groupby . ' as areacode ',
            '{join}' => $leftjoin,
        ];

        foreach ($mapKeyword as $key => $value) {
            $keysearch[] = $key;
            $keymap[] = $value;
        }
        $sql = str_replace($keysearch, $keymap, $sql); //SQL จากระบบ

        return $sql;
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
        #echo '<pre><br><br><br>';
        #print_r($this->clabel);
        #print_r($query);
        #echo '</pre>';
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

    public static function getMenuDetail($item) {
        $model = MenuItems::find()->where("menu_items_id = '{$item}'")->one();
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
        $token = "Create controller with cofig = " . VarDumper::dumpAsString($type) . " and id = '$id'";
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
