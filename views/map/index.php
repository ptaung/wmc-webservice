<?php

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
//ระบุ areacode
$coordinates = Cprocess::getGeocoder('72');
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
    'zoom' => 8,
        ]);
foreach ($coordinates['polygon'] as $key => $rows) {
    $coords = [];
    foreach ($rows as $value) {
        $coords[] = new LatLng(['lat' => $value[1], 'lng' => $value[0]]);
    }
    $polygon = new Polygon([
        'paths' => $coords,
        'strokeColor' => '‪#‎FFFFFF‬',
        'strokeOpacity' => 0.8,
        'strokeWeight' => 2,
        'fillColor' => '#008000',
        'fillOpacity' => 0.7
    ]);
// Add a shared info window
    $polygon->attachInfoWindow(new InfoWindow([
        'content' => '<p>' . $coordinates['areaname'][$key] . '</p>'
    ]));
    $map->addOverlay($polygon);
}
echo $map->display();
