<?php

/*
 * พัฒนาโดย ศิลา กลั่นแกล้ว สสจ.สุพรรณบุรี
 *
 */

// Turn off all error reporting
error_reporting(0);
#error_reporting(E_ALL);
#ini_set("display_errors", 1);
//ปิดการแจ้งเตือน
error_reporting(error_reporting() & ~E_NOTICE);

date_default_timezone_set('Asia/Bangkok');
ini_set("max_execution_time", -1);
ini_set('memory_limit', '4048M');
#ini_set('post_max_size', '4048M');
#ini_set('upload_max_filesize', '4048M');


$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'datalink-center',
    'name' => 'datalink-center',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'admin', 'oauth2'], # 'bootstrap' => ['log', 'userCounter', 'admin'],
    'language' => 'th_TH',
    'defaultRoute' => 'webclient/dashboard/',
    'modules' => [
        'silasoft' => [
            'class' => 'app\modules\silasoft\Module',
        ],
        'social' => [
            'class' => 'kartik\social\Module',
            'facebook' => [
                'appId' => '417004155162408', //WMDatacenter 2016
                'language' => 'th_TH',
            //'secret' => 'FACEBOOK_APP_SECRET',
            ],
        ],
        'line' => ['class' => 'app\modules\line\Module',],
        'ws' => ['class' => 'app\modules\ws\Module',],
        'client' => ['class' => 'app\modules\client\Module',],
        'emr' => ['class' => 'app\modules\emr\Module',],
        'wmcsync' => ['class' => 'app\modules\wmcsync\Module',],
        'hdcsync' => ['class' => 'app\modules\hdcsync\Module',],
        'wmservice' => ['class' => 'app\modules\wmservice\Module',],
        'webclient' => ['class' => 'app\modules\webclient\Module',],
        'webservice' => ['class' => 'app\modules\webservice\Module',],
        'report' => [ 'class' => 'app\modules\report\Module',],
        'backuprestore' => ['class' => '\oe\modules\backuprestore\Module',],
        'news' => [ 'class' => 'app\modules\news\Module',],
        'gridview' => ['class' => '\kartik\grid\Module'],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'mainLayout' => '@app/themes/adminlte/views/layouts/main.php',
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            #'enableRegistration' => FALSE,
            'modelMap' => [
                'RegistrationForm' => 'app\modules\silasoft\models\ExtRegistrationForm',
                'Profile' => 'app\modules\silasoft\models\ExtProfile',
                'UserSearch' => 'app\modules\silasoft\models\ExtUserSearch',
            ],
            'controllerMap' => [
                'security' => 'app\modules\silasoft\controllers\ExtsecurityController',
                'admin' => 'app\modules\silasoft\controllers\ExtadminController',
            ],
            #'enableUnconfirmedLogin' => FALSE,
            'enableConfirmation' => TRUE,
            'confirmWithin' => 21600,
            'cost' => 12,
            #'admins' => ['admin'],
            'mailer' => [
                #'sender' => 'no-reply@myhost.com', // or ['no-reply@myhost.com' => 'Sender name']
                #'welcomeSubject' => 'ยินดีต้อนรับเข้าสู่ระบบสนับสนุนข้อมูลสุขภาพ',
                #'confirmationSubject' => 'Confirmation subject',
                #'reconfirmationSubject' => 'Email change subject',
                #'recoverySubject' => 'Recovery subject',
                'viewPath' => '@app/themes/bootstrap4/views/mail',
            ],
        ],
        'oauth2' => [
            'class' => 'filsh\yii2\oauth2server\Module',
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 3600 * 24,
            'storageMap' => [
                'user_credentials' => 'app\models\OauthUser',
            #'public_key' => 'restapi\storage\PublicKeyStorage',
            #'access_token' => 'restapi\storage\JwtAccessToken',
            ],
            'grantTypes' => [
                'authorization_code' => [ 'class' => 'OAuth2\GrantType\AuthorizationCode'],
                'client_credentials' => [ 'class' => 'OAuth2\GrantType\ClientCredentials'],
                'user_credentials' => ['class' => 'OAuth2\GrantType\UserCredentials',],
                'refresh_token' => [
                    'class' => 'OAuth2\GrantType\RefreshToken',
                    'always_issue_new_refresh_token' => true
                ]
            ]
        ]
    ],
    'components' => [
        'user' => [
            'identityClass' => 'app\models\OauthUser', #server
            'autoRenewCookie' => true,
            #'authTimeout' => 60,
            #'enableSession' => false,
            'enableAutoLogin' => false,
        ],
        #'response' => [
        #'format' => yii\web\Response::FORMAT_JSON,
        #'charset' => 'UTF-8',
        #],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
            ],
        ],
        'session' => [
            'class' => 'yii\web\Session',
            #'class' => '\app\modules\silasoft\components\CustomDbSession',
            #'sessionTable' => 'wm_session_user',
            'cookieParams' => ['httponly' => true, 'lifetime' => (60 * 180)],
            'timeout' => (60 * 180),
            'useCookies' => true,
        ],
        'userCounter' => [
            'class' => 'app\components\UserCounter',
            'tableUsers' => 'pcounter_users',
            'tableSave' => 'pcounter_save',
            'autoInstallTables' => true,
            'onlineTime' => 5, // min
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:j M Y',
            'datetimeFormat' => 'php:j M Y H:i',
            'timeFormat' => 'php:H:i',
            'timeZone' => 'UTC',
            'locale' => 'th-TH',
            'nullDisplay' => '',
        ],
//การตั้งค่า THEME เอง
        'view' => [
            'theme' => [
                'pathMap' => [
                    #'@app/views' => '@app/themes/bootstrap4/views',
                    '@app/views' => '@app/themes/adminlte/views',
                    '@app/mail' => '@app/themes/bootstrap4/views/user',
                    '@dektrium/user/views' => '@app/themes/bootstrap4/views/user' //Overriding views user
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                #'dmstr\web\AdminLteAsset' => [
                #'skin' => 'skin-yellow',
                #],
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyChuSyh1MRNOLDGbsGdBqidaJHGB3aOjgY', //AIzaSyChuSyh1MRNOLDGbsGdBqidaJHGB3aOjgY
                        'language' => 'th',
                        'version' => '3.1.18'
                    ]
                ]
            ]
        ],
        'request' => [
            'enableCookieValidation' => false,
            'cookieValidationKey' => 'kfghskghjdkjghadrk534534590809809234 = 34242423423@#$@#$%^$%^$&%^&^$%$%#$%#$%',
            // Enable JSON Input:
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@app/runtime/cache'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
        #'viewPath' => '@app/mail',
        /*
          'transport' => [
          'class' => 'Swift_SmtpTransport',
          'host' => 'smtp.gmail.com',
          'username' => 'webapp.contact2267@gmail.com',
          'password' => 'qw2267er##',
          'port' => '587',
          'encryption' => 'tls',
          ],
         *
         */
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        #'phdb' => require(__DIR__ . '/phdb.php'),
        'db_datacenter' => require(__DIR__ . '/db_datacenter.php'), //Datacenter
        'db_hdc' => require(__DIR__ . '/db_hdc.php'), //Datacenter
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            //'enableStrictParsing' => true,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'webservice'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'ws/api'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'ws/wdc'],
                'POST oauth2/<action:\w+>' => 'oauth2/rest/<action>',
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'news/default/show',
            'user/security/*',
            'user/recovery/*',
            'user/registration/*',
            'user/settings/*',
            'site/*',
            'qrcode/gen',
            'api/wdc/*',
            'client/*',
            'webservice/*',
            'hdcsync/*',
            'gridview/export/*',
            'auth/*',
            'ws/*',
            'oauth2/*',
            'line/*'
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    #$config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
