<?php


return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=wm_webservice',
    'username' => '',
    'password' => '',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    // Duration of schema cache.
    'schemaCacheDuration' => 3600,
    // Name of the cache component used to store schema information
    'schemaCache' => 'cache',
    'tablePrefix' => 'wm_',
];


