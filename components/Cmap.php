<?php

/*
 * พัฒนาโดย ศิลา กลั่นแกล้ว สสจ.สุพรรณบุรี
 *
 */

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
#use app\components\Cprocess;
#use yii\web\JsExpression;
use dosamigos\google\maps\LatLng;
#use dosamigos\google\maps\services\DirectionsWayPoint;
#use dosamigos\google\maps\services\TravelMode;
#use dosamigos\google\maps\overlays\PolylineOptions;
#use dosamigos\google\maps\services\DirectionsRenderer;
#use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
#use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;

#use frontend\models\Sysreport;
#use dosamigos\google\maps\layers\BicyclingLayer;

class Cmap extends Widget {

    public $area = 72;
    public $zoom = 8;
    public $height = 300;
    public $strokeColor = '‪#‎FFFFFF‬';
    public $strokeOpacity = 0.5;
    public $strokeWeight = 2;
    public $fillColor = '#008000';
    public $fillOpacity = 0.5;
    public $color = ['#7cb5ec', '#1d599d', '#90ed7d', '#f7a35c', '#8085e9', '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'];

    public function init() {
        parent::init();
    }

    public function run() {

        $request = \Yii::$app->request;
        $this->area = \Yii::$app->params['provcode'];
        if (strlen($request->get('area')) == 4) {
            $ampcode = $request->get('area');
        } else {
            $ampcode = \Yii::$app->params['ampcode'];
        }

        $hospcode = \Yii::$app->user->identity->profile->hospcode;
        try {
            $data = \Yii::$app->db_datacenter->createCommand("SELECT CONCAT(provcode,distcode) as tt,hoscode,hostype,provcode,distcode,subdistcode FROM chospital WHERE hoscode = '{$hospcode}'")->cache(3600)->queryOne();
        } catch (\Exception $exc) {
            $return = "";
        }
        if ($data['hostype'] <> '01') {
            $ampcode = $data['tt'];
        }

        //$ampcode = $request->get('area');
        $kpi_id = $request->get('kpi_id');
        #$ampcode = 7207;
        #$this->area = 72;
//ระบุ areacode
        $coordinates = Cprocess::getGeocoder($this->area, $ampcode, $kpi_id);
        $pointHos = Cprocess::getGeocoderByHoscode($this->area, $ampcode);
        /*
          echo '<pre>';
          echo $kpi_id;
          print_r($data);
          echo '</pre>';
          exit;
         */
        if (count($coordinates) > 0) {
            $array['x'] = [];
            $array['y'] = [];
//หาค่า Center ของแผนที่
            foreach ($coordinates['polygon']['p'] as $key => $rows) {
                foreach ($rows as $value) {
                    $array['x'][] = $value[1];
                    $array['y'][] = $value[0];
                }
            }
            $lat = @min($array['x']) + ((@max($array['x']) - @min($array['x'])) / 2);
            $lng = @min($array['y']) + ((@max($array['y']) - @min($array['y'])) / 2);

            $center = new LatLng(['lat' => $lat, 'lng' => $lng]);
            $map = new Map([
                'scrollwheel' => FALSE,
                'center' => $center,
                'width' => '100%',
                'height' => $this->height,
                'zoom' => $this->zoom,
            ]);
            foreach ($coordinates['polygon']['p'] as $key => $rows) {
                $coords = [];
                foreach ($rows as $value) {
                    $coords[] = new LatLng(['lat' => $value[1], 'lng' => $value[0]]);
                }
                $polygon = new Polygon([
                    'paths' => $coords,
                    'strokeColor' => $this->strokeColor,
                    'strokeOpacity' => $this->strokeOpacity,
                    'strokeWeight' => $this->strokeWeight,
                    'fillColor' => $this->fillColor, //$this->color[rand(0, 9)],
                    //'fillColor' => @($coordinates['polygon']['point'][$key] == 1 ? 'green' : 'red'),
                    'fillOpacity' => $this->fillOpacity
                ]);
// Add a shared info window
                $polygon->attachInfoWindow(new InfoWindow([
                    'content' => '<p>' . $coordinates['polygon']['areaname'][$key] . '</p>'
                    . '<p>' . Html::a('ดูระดับสถานบริการ', ['index', 'kpi_id' => $kpi_id, 'area' => $coordinates['polygon']['areacode'][$key]]) . '</p>'
                ]));
                $map->addOverlay($polygon);
            }
            $icon_green = "http://maps.google.com/mapfiles/ms/icons/green-dot.png";
            $icon_red = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
            $icon = "https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/48/Map-Marker-Marker-Inside-Chartreuse.png";
            $icon = "https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/48/Map-Marker-Board-Chartreuse.png";
            $icon = "https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/48/Map-Marker-Marker-Inside-Chartreuse.png";
            $home = "https://cdn1.iconfinder.com/data/icons/flat-artistic-shopping-icons/32/home-20.png";
            $hos = "http://findicons.com/files/icons/186/perfect_city/48/hospital.png";
            $pcu = "http://findicons.com/files/icons/183/gis_gps_map/32/hospital.png";
            foreach ($pointHos as $key => $row) {


                $coord = new LatLng(['lat' => $row['lat'], 'lng' => $row['lon']]);
                $marker = new Marker([
                    'position' => $coord,
                    'title' => $row['hosname'],
                    'icon' => ($row['hostype'] == 'pcu' ? $pcu : $hos),
                ]);

                $marker->attachInfoWindow(new InfoWindow([
                    'content' => '<p>' . $row['hosname'] . '</p>'
                ]));

                $map->addOverlay($marker);
            }
            return $map->display();
        } else {
            return;
        }
    }

}
