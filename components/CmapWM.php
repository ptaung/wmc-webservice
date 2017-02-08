<?php

/*
 * พัฒนาโดย ศิลา กลั่นแกล้ว สสจ.สุพรรณบุรี
 *
 */

namespace app\components;

use yii\base\Widget;
use app\components\Cprocess;
#use yii\web\JsExpression;
use dosamigos\google\maps\LatLng;
#use dosamigos\google\maps\services\DirectionsWayPoint;
#use dosamigos\google\maps\services\TravelMode;
#use dosamigos\google\maps\overlays\PolylineOptions;
#use dosamigos\google\maps\services\DirectionsRenderer;
#use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
#use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
#use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;

#use dosamigos\google\maps\layers\BicyclingLayer;

class Cmap extends Widget {

    public $province = 72;
    public $zoom = 8;
    public $strokeColor = '‪#‎FFFFFF‬';
    public $strokeOpacity = 0.8;
    public $strokeWeight = 2;
    public $fillColor = '#008000';
    public $fillOpacity = 0.7;
    public $areacode = 7203;

    public function init() {
        parent::init();
        /*
          if ($this->message === null) {
          $this->message = 'Welcome User';
          } else {
          $this->message = 'Welcome ' . $this->message;
          }
         *
         */
    }

    public function run() {
//ระบุ areacode
        $coordinates = Cprocess::getGeocoder($this->areacode);
//หาค่า Center ของแผนที่
        foreach ($coordinates['polygon'] as $key => $rows) {
            foreach ($rows as $value) {
                $array['x'][] = $value[1];
                $array['y'][] = $value[0];
            }
        }
        $lat = min($array['x']) + ((max($array['x']) - min($array['x'])) / 2);
        $lng = min($array['y']) + ((max($array['y']) - min($array['y'])) / 2);
        $center = new LatLng(['lat' => $lat, 'lng' => $lng]);
        $map = new Map([
            'center' => $center,
            'width' => '100%',
            #'height' => '300',
            'zoom' => $this->zoom,
        ]);
        foreach ($coordinates['polygon'] as $key => $rows) {
            $coords = [];
            foreach ($rows as $value) {
                $coords[] = new LatLng(['lat' => $value[1], 'lng' => $value[0]]);
            }
            $polygon = new Polygon([
                'paths' => $coords,
                'strokeColor' => $this->strokeColor,
                'strokeOpacity' => $this->strokeOpacity,
                'strokeWeight' => $this->strokeWeight,
                'fillColor' => $this->fillColor,
                'fillOpacity' => $this->fillOpacity
            ]);
// Add a shared info window
            $polygon->attachInfoWindow(new InfoWindow([
                'content' => '<p>' . $coordinates['areaname'][$key] . '</p>'
            ]));
            $map->addOverlay($polygon);
        }
        echo $map->display();
    }

}
