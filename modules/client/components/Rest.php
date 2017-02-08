<?php

namespace app\modules\client\components;

use linslin\yii2\curl;
use yii\base\Object;

class Rest {

    static $logpath = "";
    static $log_status = 'wmc-status'; //Log filename status
    static $log_info = 'wmc-info'; //Log filename info
    static $log_sender = 'wmc-working'; //Log filename sender
    static $log_process = 'wmc-process'; //Log filename
    static $log_error = 'wmc-error'; //Log filename
    static $log_filesize = 'wmc-filesize'; //Log filename
    static $log_zip = 'wmc-zipfile'; //Log filename
    static $log_time = 'wmc-time'; //Log filename
    static $tables_sync = []; // Load จาก Server
    static $checkSumQuery = [];
    static $datatable = [];
    static $table = []; //กรณีต้องการ sync เป็นบางตารางก็กำหนดได้เลยในค่านี้
    static $hcode; //รหัสสถานบริการ
    #static $webservice_url = 'http://127.0.0.1/yiiproject/web/index.php/client/';
    static $webservice_url = 'http://wm.spo.go.th/wmc/web/index.php/client/';
    static $splitLimit = 10000; // split data order to small for upload
    static $loop = 10000; //สำหรับจัดกลุ่มระหว่างตรวจสอบ bydate
    private $webservice_username;
    private $webservice_password;
    private $webservice_secretkey;

    public function init() {

    }

    public function run() {
        $n = \Yii::getAlias('@app') . '\_backup\file_17022016_final_123.pdf';
        self::post($n, 'test/index2');
    }

    public static function post($data, $function) {
        //Load items from webservice

        $link = self::$webservice_url . $function;
        //Init curl
        try {
            $cfile = curl_file_create($data); // try adding
            #$cfile2 = curl_file_create($data); // try adding
            #$array = http_build_query(['name' => 'Sila Klanklaeo']);

            $post = [
                'files' => $cfile,
                'depname' => 'Sila Klanklaeo'
            ];

            $curl = new curl\Curl();
            $response = $curl
                    ->setOption(CURLOPT_POSTFIELDS, $post)
                    #->setOption(CURLOPT_POSTFIELDS, http_build_query(['hospcode' => '08264']))
                    #->setOption(CURLOPT_FOLLOWLOCATION, TRUE)
                    ->setOption(CURLOPT_USERPWD, \Yii::$app->params['cusername'] . ":" . \Yii::$app->params['cpassword'])
                    #->setOption(CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4)
                    ->setOption(CURLOPT_FAILONERROR, true)
                    ->setOption(CURLOPT_CONNECTTIMEOUT, 18000)
                    ->setOption(CURLOPT_TIMEOUT, 36000)
                    ->setOption(CURLOPT_RETURNTRANSFER, true)
                    ->setOption(CURLOPT_BUFFERSIZE, 512)
                    ->setOption(CURLOPT_BINARYTRANSFER, true)
                    ->setOption(CURLOPT_MAXREDIRS, 3)// stop after 3 redirects
                    ->setOption(CURLOPT_ENCODING, 'gzip,deflate')
                    ->setOption(CURLOPT_HEADER, false)
                    ->setOption(CURLOPT_SSL_VERIFYPEER, false)
                    ->setOption(CURLOPT_SSL_VERIFYHOST, false)
                    ->post($link);
            /*
              $response = $curl->reset()
              ->setOption(CURLOPT_POSTFIELDS, http_build_query(['hospcode' => '08264']))
              ->post($link);
             *
             */
        } catch (\Exception $exc) {
            echo $exc->getMessage();
        }
        echo $curl->response;
        echo '<pre>';
        print_r($curl->getInfo());
        echo '</pre>';
    }

}
