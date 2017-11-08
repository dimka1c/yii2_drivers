<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin([
    /*
                                'action' => 'test/test',
                                'id' => 'signuoForm',
                                'method' => 'post'
    */
]) ?>
<?= $form->field($model, 'email',
    ['inputOptions' => [
        'placeholder' => 'Например: email@example.com'
    ]])
    ->Input('email', ['class'=>'form-control text-center']) ?>
<?= $form->field($model, 'verifyCode')->widget(
    \himiklab\yii2\recaptcha\ReCaptcha::className(),
    ['siteKey' => '6LcoRTYUAAAAAALZ8uJyASHOiwzY7dB9GVlQAOjw']
)
?>

<div class="form-group">
    <?= Html::submitButton('Выслать пароль', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end() ?>

<div class="form-group">
    <?= Html::a('Авторизация', ['main/index'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Регистрация', ['main/signup'], ['class' => 'btn btn-primary']) ?>
</div>
