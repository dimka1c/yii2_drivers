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
<?= $form->field($model, 'username',
        ['inputOptions' => [
            'placeholder' => 'от 5 до 50 символов'
        ]])
        ->textInput(['class' => 'form-control text-center']) ?>
<?= $form->field($model, 'password')->passwordInput(['class' => 'form-control text-center']) ?>
<?= $form->field($model, 'fullname',
        ['inputOptions' => [
            'placeholder' => 'Например: Иванов И.И.'
        ]])
        ->textInput(['class'=>'form-control text-center']) ?>
<?= $form->field($model, 'email',
    ['inputOptions' => [
        'placeholder' => 'Например: email@example.com'
    ]])
    ->Input('email', ['class'=>'form-control text-center']) ?>

    <div class="form-group">
        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end() ?>

<div class="form-group">
    <?= Html::a('Авторизация', ['main/index'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Забыли пароль?', ['main/remember-me'], ['class' => 'btn btn-primary']) ?>
</div>
