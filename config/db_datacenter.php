<?php

/*
  return [
  'class' => 'yii\db\Connection',
  'dsn' => 'mysql:host=127.0.0.1;dbname=wm2016',
  'username' => 'sa',
  'password' => 'sa',
  'charset' => 'utf8',
  'enableSchemaCache' => true,
  // Duration of schema cache.
  'schemaCacheDuration' => 3600,
  // Name of the cache component used to store schema information
  'schemaCache' => 'cache',
  ];
 */


return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=192.168.9.99;port=3306;dbname=pcu_audit',
    'username' => 'ptaung',
    'password' => 'qw2267er',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    // Duration of schema cache.
    'schemaCacheDuration' => 3600,
    // Name of the cache component used to store schema information
    'schemaCache' => 'cache',
];

