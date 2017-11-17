<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 011 11.11.17
 * Time: 16:41
 */

namespace app\components\behaviors;


use app\modules\admin\Module;
use yii\base\Behavior;
use yii\web\Controller;
use Yii;


class AccessBehaviors extends Behavior
{
    public $root = [];

    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'userAccess',
            Module::EVENT_BEFORE_ACTION => 'userAccess',
        ];
    }


    public function userAccess()
    {
        // если не авторизированный пользователь - на регистрацию
        if (\Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('accessDenied',
                "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <strong>Ошибка доступа</strong> Для доступа необходимо авторизироваться
                            </div>"
            );
            Yii::$app->getResponse()->redirect(['main']);
        }
        if (empty($this->root)) { // если поле пустое, разрешаем доступ всем
            return true;
        }
        $userRoot = Yii::$app->user->identity->role;
        if (is_array($this->root)) {
            foreach ($this->root as $root) {
                if ($userRoot == $root) {
                    return true;
                }
            }
        }
        if (!empty($userRoot)) {
            Yii::$app->getResponse()->redirect(['main/access-denied']);
        } else {
            Yii::$app->getResponse()->redirect(['main']);
        }

    }

}