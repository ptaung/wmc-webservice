<?php

namespace app\modules\ws\models;

use yii\base\Model;

class Upload extends Model {

    public $zipFile;

    public function rules() {
        return [
            [['zipFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'zip'],
        ];
    }

    /*
      public function upload() {
      if ($this->validate()) {
      $this->zipFile->saveAs('log/' . $this->zipFile->baseName . '.');
      return true;
      } else {
      return false;
      }
      }
     */
}
