<?php

/*
 * พัฒนาโดย ศิลา กลั่นแกล้ว สสจ.สุพรรณบุรี
 *
 */

namespace app\components;

use app\modules\report\models\MenuGroup;
use yii\helpers\html;

class Cmenu {

    public static function getMenu($id) {
        $item = [];
        $subitem = [];
        $findsubitem = [];
        foreach (MenuGroup::find()->where("menu_group_submenu={$id}")->all() as $model) {
            $item[] = ['label' => Html::tag('i', '', ['class' => 'glyphicon glyphicon-record']) . ' ' . $model->menu_group_name, 'url' => ['/report/default/menu', 'id' => $model->menu_group_id], 'items' => Cmenu::getMenu($model->menu_group_id)];
        }
        return $item;
    }

    public static function getMainMenu($lable) {
        $item = [];
        foreach (MenuGroup::find()->where("menu_group_submenu is null || menu_group_submenu = ''")->all() as $model) {
            $item[] = ['label' => $model->menu_group_name, 'url' => ['/report/default/menu', 'id' => $model->menu_group_id], 'items' => Cmenu::getMenu($model->menu_group_id)];
        }
        return ['label' => $lable, 'url' => '#', 'items' => $item,];
    }

    public static function getTarget($source_table) {

        if (strlen($source_table) > 5) {
            try {
                $query = "SELECT ROUND((sum(result)/sum(target))*100,2) as p FROM {$source_table} WHERE b_year = (SELECT
                yearprocess + 543
            FROM
                sys_config) ;";
                $data = \Yii::$app->db->createCommand($query)->queryScalar();
            } catch (\Exception $exc) {
                $data = 0;
            }
        } else {
            $data = 0;
        }

        return $data;
    }

    public static function getGeocoder($areacode) {
        $coordinates = [];
        $polygon = [];
        try {
            $query = "SELECT
                            CONCAT('อ.', ampurname, ' จ.', changwatname) AS areaname,
                            areacode,
                            areatype,
                            geojson
                        FROM
                            campur
                                INNER JOIN
                            cchangwat ON cchangwat.changwatcode = campur.changwatcode
                                INNER JOIN
                            geojson ON areacode = ampurcodefull
                                AND areatype = '3'
                                AND LENGTH(geojson) > 0
                                AND cchangwat.changwatcode = '{$areacode}'";
            $data = \Yii::$app->db->createCommand($query)->queryAll();
            foreach ($data as $key => $rows) {
                $coordinates['areaname'][] = $rows['areaname'];
                $geo = \GuzzleHttp\json_decode($rows['geojson'], true);
                array_push($polygon, $geo['coordinates'][0][0]);
            }
        } catch (\Exception $exc) {
            $data = [];
        }

        $coordinates['polygon'] = $polygon;

        return $coordinates;
    }

}
