<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 005 05.11.17
 * Time: 18:20
 */

namespace app\models;


use yii\base\Model;

class RememberForm extends Model
{
    public $email;
    public $verifyCode;

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            [['verifyCode'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LcoRTYUAAAAAHBvOLHZON1XnYdbqww8GxeBMZKG', 'uncheckedMessage' => 'Я не бот']
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Введите email, который был указан при регистрации',
            'verifyCode' => false,
        ];
    }
}