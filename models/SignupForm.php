<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 018 18.10.17
 * Time: 18:15
 */

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    const SCENARIO_REGISTER = 'register';

    public $username;
    public $password;
    public $fullname;
    public $email;

    public function rules() {
        return [
            ['username', 'required'],
            [['username'], 'trim'],
            [['username'], 'unique', 'targetClass' => User::className(), 'message' => 'Этот логин занят'],
            [['username'], 'string', 'min' => '5', 'max' => '50', 'message' => 'от 5 до 50 символов'],
            //[['username'], 'on' => self::SCENARIO_REGISTER],
            [['password'], 'required'],
            [['fullname'], 'trim'],
            [['fullname'], 'required'],
            [['fullname'], 'unique', 'targetClass' => User::className(), 'message' => 'Такой пользователь уже зарегистрирован'],
            [['email'], 'email'],
            [['email'], 'default'],

        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'Логин (обязательное поле)',
            'password' => 'Пароль (обязательное поле)',
            'fullname' => 'Полное имя (обязательное поле)',
            'email' => 'Email (для восстановления пароля)',
        ];
    }
}