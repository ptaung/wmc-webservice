<?php

namespace app\modules\silasoft\controllers;

use yii\web\Controller;
use Yii;
use yii\web\Response;

class LineController extends Controller {

    public function beforeAction($action) {
        if ($action->id == 'callback') {
            $this->enableCsrfValidation = false; //ปิดการใช้งาน csrf
        }
        return parent::beforeAction($action);
    }

    public function actionCallback() {
        $json_string = file_get_contents('php://input');
        $jsonObj = json_decode($json_string); //รับ JSON มา decode เป็น StdObj
        $to = $jsonObj->{"result"}[0]->{"content"}->{"from"}; //หาผู้ส่ง
        $text = $jsonObj->{"result"}[0]->{"content"}->{"text"}; //หาข้อความที่โพสมา
        $text_ex = explode(':', $text);

        $response_format_text = ['contentType' => 1, "toType" => 1, "text" => "ความลับนะ"];

        $to = 'u2a8ef93bbb6b19b3a446135b384f6d1f';
// toChannel?eventType

        $post_data = ["to" => [$to], "toChannel" => "1383378250", "eventType" => "138311608800106203", "content" => $response_format_text];
//ส่งข้อมูลไป
        $ch = curl_init("https://trialbot-api.line.me/v1/events");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charser=UTF-8', 'X-Line-ChannelID:1473827255', 'X-Line-ChannelSecret:7cc9f1eea424648c44d94766c476553a', 'X-Line-Trusted-User-With-ACL:u2a8ef93bbb6b19b3a446135b384f6d1f'));
        $result = curl_exec($ch);
        curl_close($ch);
        echo '<pre>';
        print_r($result);
        echo '</pre>';
    }

}
