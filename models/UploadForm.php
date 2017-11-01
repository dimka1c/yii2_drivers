<?php

namespace app\models;

use yii\base\Model;
use Yii;

class UploadForm extends Model
{

    public $upfile;

    public function rules()
    {
        return [
            [['upfile'], 'file', 'skipOnEmpty' => false, 'extensions' => null, 'maxFiles' => 100, 'maxSize' => null],
        ];
    }


    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->upfile as $file) {
                $file->saveAs(Yii::getAlias('@webroot') . '/uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}