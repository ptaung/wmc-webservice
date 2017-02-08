<?php

namespace app\modules\webclient\components;

use linslin\yii2\curl;

class Cwebclient {

    public static function getReportSerive($item_id = NULL, $item_gid = NULL, $search = NULL) {
        //Load items from webservice
        $link = \Yii::$app->params['webserviceUrl'] . '/report/items';

        //Init curl
        $curl = new curl\Curl();
        $response = $curl->setOption(
                        CURLOPT_POSTFIELDS, http_build_query(
                                [
                                    'param' => [
                                        'hoscode' => \Yii::$app->params['codebase'],
                                        'item_id' => $item_id,
                                        'item_gid' => $item_gid,
                                        'search' => $search
                                    ]
                                ]
                ))
                ->setOption(CURLOPT_SSL_VERIFYPEER, 0)
                ->setOption(CURLOPT_USERPWD, \Yii::$app->params['cusername'] . ":" . \Yii::$app->params['cpassword'])
                ->setOption(CURLOPT_ENCODING, 'gzip')
                ->post($link);
        $ref = json_decode($response, TRUE);

        #echo '<pre>';
        #print_r($response);
        #echo '</pre>';
        #exit;

        if ($item_id === NULL) {
            return $ref;
        } else {
            return $ref['data'][0];
        }
    }

}
