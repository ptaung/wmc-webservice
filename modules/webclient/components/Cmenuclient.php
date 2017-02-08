<?php

/*
 * พัฒนาโดย ศิลา กลั่นแกล้ว สสจ.สุพรรณบุรี
 *
 */

namespace app\modules\webclient\components;

use app\modules\webclient\components\Cwebclient;
#use app\modules\webclient\models\WuseGroupLocal;
use yii\helpers\html;

class Cmenuclient {

    public static function getMenu($id, $dataitems) {
        $item = [];
        if (isset($dataitems[$id])) {
            foreach ($dataitems[$id] as $model) {
                $item[] = ['label' => Html::tag('i', '', ['class' => 'glyphicon glyphicon-record']) . ' ' . $model['menu_group_name'], 'url' => ['/webclient/default/menu', 'id' => $model['menu_group_id']], 'items' => Cmenuclient::getMenu($model['menu_group_id'], $dataitems)];
            }
        }
        return $item;
    }

    public static function getMainMenu($lable = '', $link = NULL) {

        $dataMenu = Cwebclient::getReportSerive(NULL, NULL, NULL, $link);

        $menu = [];
        $cc = [];
        foreach ($dataMenu['data'] as $value) {
            if ($value['individual'] <> 1) {
                #if ($value['menu_group_submenu'] == '')
                @$cc['all'] +=1;
                @$cc[$value['menu_group_id']] +=1;
                $menu[$value['menu_group_id']] = [
                    'menu_group_id' => $value['menu_group_id'],
                    'menu_group_name' => $value['menu_group_name'],
                    'menu_group_submenu' => $value['menu_group_submenu'],
                ];
                /*
                  if ($value['menu_group_submenu'] <> '')
                  $menusub[$value['menu_group_submenu']] = [
                  'menu_group_id' => $value['menu_group_id'],
                  'menu_group_name' => $value['menu_group_name'],
                  'menu_group_submenu' => $value['menu_group_submenu'],
                  ];
                 *
                 */
            }
        }
        #echo '<pre>';
        #print_r($menu);
        #echo '</pre>';
        #exit;

        $item[] = [ 'encode' => false, 'label' => 'รายงานไม่ได้จัดกลุ่ม <span class="badge pull">' . @$cc['all'] . '</span> ', 'url' => ['/webclient/default/menu', 'id' => '0', 'rsource' => $link], 'items' => []];
        foreach ($menu as $model) {
            $item[] = [ 'encode' => false, 'label' => $model['menu_group_name'] . ' <span class="badge pull">' . @$cc[$model['menu_group_id']] . '</span> ', 'url' => ['/webclient/default/menu', 'id' => $model['menu_group_id']], 'rsource' => $link, 'items' => [] /* Cmenuclient::getMenu($model['menu_group_id'], $menusub) */];
        }

        return [ 'encode' => false, 'icon' => 'glyphicon glyphicon-stats', 'label' => $lable, 'url' => '#', 'visible' => !\Yii::$app->user->isGuest, 'items' => $item];
        #return [ 'encode' => false, 'icon' => 'glyphicon glyphicon-stats', 'label' => '<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> &nbsp;&nbsp;' . $lable, 'url' => '#', 'visible' => !\Yii::$app->user->isGuest, 'items' => $item];
    }

    /*
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
     *
     */
}
