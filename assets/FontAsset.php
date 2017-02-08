<?php

namespace app\assets;

use yii\web\AssetBundle;

class FontAsset extends AssetBundle {

    public $basePath = 'http://fonts.googleapis.com';
    public $baseUrl = 'http://fonts.googleapis.com';
    public $css = [
        'css?family=Prompt:300'
    ];

}
