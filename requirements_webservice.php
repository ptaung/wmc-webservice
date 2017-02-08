<?php

/**
 * Application requirement checker script.
 *
 * In order to run this script use the following console command:
 * php requirements.php
 *
 * In order to run this script from the web, you should copy it to the web root.
 * If you are using Linux you can create a hard link instead, using the following command:
 * ln requirements.php ../requirements.php
 */
// you may need to adjust this path to the correct Yii framework path
$frameworkPath = dirname(__FILE__) . '/vendor/yiisoft/yii2';

if (!is_dir($frameworkPath)) {
    echo '<h1>Error</h1>';
    echo '<p><strong>The path to yii framework seems to be incorrect.</strong></p>';
    echo '<p>You need to install Yii framework via composer or adjust the framework path in file <abbr title="' . __FILE__ . '">' . basename(__FILE__) . '</abbr>.</p>';
    echo '<p>Please refer to the <abbr title="' . dirname(__FILE__) . '/README.md">README</abbr> on how to install Yii.</p>';
}

require_once($frameworkPath . '/requirements/YiiRequirementChecker.php');
$requirementsChecker = new YiiRequirementChecker();

#$gdMemo = $imagickMemo = 'Either GD PHP extension with FreeType support or ImageMagick PHP extension with PNG support is required for image CAPTCHA.';
#$gdOK = $imagickOK = false;
/*
  if (extension_loaded('imagick')) {
  $imagick = new Imagick();
  $imagickFormats = $imagick->queryFormats('PNG');
  if (in_array('PNG', $imagickFormats)) {
  $imagickOK = true;
  } else {
  $imagickMemo = 'Imagick extension should be installed with PNG support in order to be used for image CAPTCHA.';
  }
  }

  if (extension_loaded('gd')) {
  $gdInfo = gd_info();
  if (!empty($gdInfo['FreeType Support'])) {
  $gdOK = true;
  } else {
  $gdMemo = 'GD extension should be installed with FreeType support in order to be used for image CAPTCHA.';
  }
  }
 *
 */

/**
 * Adjust requirements according to your application specifics.
 */
$requirements = array(
// Database :
    /*
      array(
      'name' => 'PDO SQLite extension',
      'mandatory' => false,
      'condition' => extension_loaded('pdo_sqlite'),
      'by' => 'All DB-related classes',
      'memo' => 'Required for SQLite database.',
      ),
     *
     */
    array(
        'name' => 'PDO MySQL extension',
        'mandatory' => false,
        'condition' => extension_loaded('pdo_mysql'),
        'by' => 'All DB-related classes',
        'memo' => 'Required for MySQL database.',
    ),
    // CAPTCHA:
    /*
      array(
      'name' => 'GD PHP extension with FreeType support',
      'mandatory' => false,
      'condition' => $gdOK,
      'by' => '<a href="http://www.yiiframework.com/doc-2.0/yii-captcha-captcha.html">Captcha</a>',
      'memo' => $gdMemo,
      ),
      array(
      'name' => 'ImageMagick PHP extension with PNG support',
      'mandatory' => false,
      'condition' => $imagickOK,
      'by' => '<a href="http://www.yiiframework.com/doc-2.0/yii-captcha-captcha.html">Captcha</a>',
      'memo' => $imagickMemo,
      ),
     *
     */
    // PHP ini :
    'phpExposePhp' => array(
        'name' => 'Expose PHP',
        'mandatory' => false,
        'condition' => $requirementsChecker->checkPhpIniOff("expose_php"),
        'by' => 'Security reasons',
        'memo' => '"expose_php" should be disabled at php.ini',
    ),
    'phpAllowUrlInclude' => array(
        'name' => 'PHP allow url include',
        'mandatory' => false,
        'condition' => $requirementsChecker->checkPhpIniOff("allow_url_include"),
        'by' => 'Security reasons',
        'memo' => '"allow_url_include" should be disabled at php.ini',
    ),
    'phpPostMaxSize' => array(
        'name' => 'PHP Post Max Size',
        'mandatory' => false,
        'condition' => ini_get('post_max_size') >= 20,
        'by' => 'WMC-Service',
        'memo' => '"post_max_size" [NOW=' . ini_get('post_max_size') . '] should be =>20MB at php.ini',
    ),
    'upload_max_filesize' => array(
        'name' => 'PHP Upload Max FileSize',
        'mandatory' => false,
        'condition' => ini_get('upload_max_filesize') >= 20,
        'by' => 'WMC-Service',
        'memo' => '"upload_max_filesize" [NOW=' . ini_get('upload_max_filesize') . '] should be =>20MB at php.ini',
    ),
    'max_input_vars' => array(
        'name' => 'PHP max_input_vars',
        'mandatory' => true,
        'condition' => ini_get('max_input_vars') >= 3000,
        'by' => 'WMC-Service',
        'memo' => '"max_input_vars" [NOW=' . ini_get('max_input_vars') . '] should be =>3000 at php.ini',
    ),
    'date_default_timezone' => array(
        'name' => 'PHP date_default_timezone',
        'mandatory' => true,
        'condition' => ini_get('date.timezone') == 'Asia/Bangkok',
        'by' => 'WMC-Service',
        'memo' => '"date.timezone" [NOW=' . ini_get('date.timezone') . '] should be "Asia/Bangkok" at php.ini',
    ),
    'datetime' => array(
        'name' => 'PHP datetime',
        'mandatory' => true,
        'condition' => $requirementsChecker->getNowDate(),
        'by' => 'WMC-Service',
        'memo' => '"datetime" [NOW=' . $requirementsChecker->getNowDate() . '] should be "+7" at php.ini',
    ),
);

#$requirementsChecker->checkYii()->check($requirements)->render();
$requirementsChecker->check($requirements)->render();

