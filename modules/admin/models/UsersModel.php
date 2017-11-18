<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 017 17.11.17
 * Time: 11:42
 */

namespace app\modules\admin\models;


use yii\db\ActiveRecord;

class UsersModel extends ActiveRecord
{

    public static function tableName()
    {
        return 'user';
    }

}