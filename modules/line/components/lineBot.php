<?php

namespace app\modules\line\components;

use Yii;
use yii\httpclient\Client;

#use app\models\Chospital;

class lineBot {

    public $tokenApi = "https://notify-api.line.me/api/notify";
    public $token = "";



    public function send($message) {
        $stickerPackageId = rand(1, 2);
        $stickerId = ($stickerPackageId == 1 ? rand(100, 139) : rand(18, 47));

        $client = new Client();
        $response = $client->createRequest()
                        ->setUrl($this->tokenApi)
                        ->setMethod('post')
                        ->setData([
                            'message' => date('Y-m-d H:i:s') . "\n" . $message,
                                #'stickerId' => $stickerId,
                                #'stickerPackageId' => $stickerPackageId,
                        ])
                        ->addHeaders(['Authorization' => 'Bearer ' . $this->token])
                        ->setOptions([
                            CURLOPT_CONNECTTIMEOUT => 30, //5 connection timeout
                            CURLOPT_TIMEOUT => 3600, //10 data receiving timeout
                            CURLOPT_SSL_VERIFYHOST => 0,
                            CURLOPT_SSL_VERIFYPEER => false
                        ])->send();
        if ($response->isOk) {
            $resp = $response->content;
        } else {
            $resp = $response->content;
        }
        return $resp;
        /*
          echo '<pre>';
          print_r($response->data);
          echo '</pre>';
          echo '<pre>';
          print_r($response);
          echo '</pre>';
         *
         */
    }

}
