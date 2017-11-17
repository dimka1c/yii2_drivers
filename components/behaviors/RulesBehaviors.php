<?php
/*
 * возвращает имя модуля в зависимости от прав пользователя
 */

namespace app\components\behaviors;

use yii\base\Behavior;


class RulesBehaviors extends Behavior
{
    public function getPath()
    {
        $role = \Yii::$app->user->identity->role;
        if ($role == 'admin') {
            return '/admin';
        } elseif ($role == 'driver') {
            return '/driver';
        } elseif ($role == 'user') {
            return  '/user';
        } else {
            return  '/';
        }
    }

}