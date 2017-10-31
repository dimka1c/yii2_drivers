<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 030 30.10.17
 * Time: 18:40
 */

namespace app\models;


use yii\db\ActiveRecord;

class ListDriver extends ActiveRecord
{

    public static function tableName()
    {
        return 'drivers';
    }

    public function AllDrivers()
    {
        return self::find()->all();
    }

}