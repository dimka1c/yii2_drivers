<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 011 11.11.17
 * Time: 18:19
 */

namespace app\modules\admin\models;


use yii\db\ActiveRecord;

class DriversModel extends ActiveRecord
{

    public static function tableName()
    {
        return 'drivers';
    }

}