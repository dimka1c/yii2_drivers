<?php

namespace app\modules\driver\models;

use yii\db\ActiveRecord;

class Client extends ActiveRecord
{


    public static function tableName()
    {
        return 'client';
    }


}