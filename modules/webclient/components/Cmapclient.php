<?php

/*
 * พัฒนาโดย ศิลา กลั่นแกล้ว สสจ.สุพรรณบุรี
 *
 */

namespace app\modules\webclient\components;

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

class Cmapclient extends Widget {

    public $area = 72;
    public $zoom = 8;
    public $height = 300;
    public $strokeColor = '‪#‎FFFFFF‬';
    public $strokeOpacity = 0.5;
    public $strokeWeight = 2;
    public $fillColor = '#008000';
    public $fillOpacity = 0.5;
    public $color = ['#7cb5ec', '#1d599d', '#90ed7d', '#f7a35c', '#8085e9', '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'];
    public $point = [];
    public $condition = '';
    public $content = '';
    public $icon = '';

    public function init() {
        parent::init();
    }

    public function run() {
        $request = \Yii::$app->request;

        if (count($coordinates) > 0 || 1) {
            $array['x'] = [];
            $array['y'] = [];
//หาค่า Center ของแผนที่
            foreach ($this->point as $key => $rows) {
                if (!empty($rows['lat']) && !empty($rows['lng']) && (double) $rows['lat'] > 0 && (double) $rows['lng'] > 0) {
                    $array['x'][] = (double) $rows['lat'];
                    $array['y'][] = (double) $rows['lng'];
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


            #$icon_green = "http://maps.google.com/mapfiles/ms/icons/green-dot.png";
            #$icon_red = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
            $icon_red = "https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/32/Map-Marker-Board-Pink.png";
            $icon_green = "https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/32/Map-Marker-Board-Chartreuse.png";
            $icon_info = "https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/32/Map-Marker-Board-Azure.png";

            foreach ($this->point as $key => $row) {
                $coord = new LatLng(['lat' => $row['lat'], 'lng' => $row['lng']]);

                if (isset($row[$this->condition]) && $row[$this->condition] <> 0) {
                    $icon = $icon_green;
                } else {
                    $icon = $icon_red;
                }

                if ($this->icon)
                    $icon = $this->icon;

                $marker = new Marker([
                    'position' => $coord,
                    'title' => $row['person_name'],
                    'icon' => $icon,
                ]);

                foreach ($this->point[0] as $key => $rows) {
                    if ($key == 0) {
                        $mapKeyword['{' . $key . '}'] = $rows;
                    }
                }

                $keysearch = [];
                $keymap = [];

                foreach ($mapKeyword as $key => $value) {
                    $keysearch[] = $key;
                    $keymap[] = $value;
                }

                $string = str_replace($keysearch, $keymap, $this->content);

                $marker->attachInfoWindow(new InfoWindow([
                    'content' => '<p>' . $row['person_name'] . '</p>บ้านเลขที่ ' . $row['address_name'] . $string
                ]));

                $map->addOverlay($marker);
            }

            return $map->display();
        } else {
            return;
        }
    }

}
