<?php

namespace app\modules\client\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model {

    /**
     * @var UploadedFile
     */
    public $files;

    public function rules() {
        return [
            [['files'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg,rar,zip,pdf'],
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $this->imageFile->saveAs(\Yii::getAlias('@app') . '/_backup/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

}
