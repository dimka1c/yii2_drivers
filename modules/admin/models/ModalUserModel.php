<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 018 18.11.17
 * Time: 19:14
 */

namespace app\modules\admin\models;


use yii\base\Model;
use yii\helpers\Html;

class ModalUserModel extends Model
{

    public $id;
    public $username;
    public $fullname;
    public $email;
    public $role;
    public $access;
    public $dataRegistration;

    public function rules() {
        return [
            [['id'], 'integer'],
            ['username', 'required'],
            [['username'], 'trim'],
            [['username'], 'string', 'min' => '5', 'max' => '50', 'message' => 'от 5 до 50 символов'],
            ['username', 'filter', 'filter' => 'htmlspecialchars'],
            [['fullname'], 'trim'],
            [['fullname'], 'required'],
            [['fullname'], 'match', 'pattern' => '/^[А-ЯЁа-яё]+ [А-ЯЁ]\.[А-ЯЁ]\.$/u', 'message' => 'Пример: Иванов И.И.'],
            ['fullname', 'filter', 'filter' => 'htmlspecialchars'],
            [['email'], 'email'],
            [['email'], 'default'],
            [['email'], 'filter', 'filter' => 'htmlspecialchars'],
            [['role'], 'default'],
            [['access'], 'safe'],
            ['dataRegistration', 'safe'],
        ];
    }


}

