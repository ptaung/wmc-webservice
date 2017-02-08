<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

#use doamigos\qrcode\formats\MailTo;

use dosamigos\qrcode\QrCode;
use yii\helpers\Html;

class QrcodeController extends \yii\web\Controller {

    public function actionGen($text) {
        $text = Html::encode(base64_decode($text));
        return QrCode::png($text);
    }

}
