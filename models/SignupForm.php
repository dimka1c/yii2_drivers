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
    public $verifyCode;

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
            [['fullname'], 'match', 'pattern' => '/^[А-ЯЁа-яё]+ [А-ЯЁ]\.[А-ЯЁ]\.$/u', 'message' => 'Пример: Иванов И.И.'],
            [['fullname'], 'unique', 'targetClass' => User::className(), 'message' => 'Такой пользователь уже зарегистрирован'],
            [['email'], 'email'],
            [['email'], 'default'],
            [['verifyCode'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LcoRTYUAAAAAHBvOLHZON1XnYdbqww8GxeBMZKG', 'uncheckedMessage' => 'Я не бот']

        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'Логин (обязательное поле)',
            'password' => 'Пароль (обязательное поле)',
            'fullname' => 'Полное имя (обязательное поле)',
            'email' => 'Email (для восстановления пароля)',
            'verifyCode' => false,
        ];
    }
}