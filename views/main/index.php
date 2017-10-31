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
        'placeholder' => 'Введите Ваш логин'
    ]])
    ->textInput(['class' => 'form-control text-center']) ?>
<?= $form->field($model, 'password')->passwordInput(['class' => 'form-control text-center']) ?>
<?= $form->field($model, 'rememberMe')->checkbox(['label' => 'Запомнить меня']) ?>
<div class="form-group">
    <?= Html::submitButton('Вход', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end() ?>

<div class="form-group">
    <?= Html::a('Регистрация', ['main/signup'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Забыли пароль?', ['main/remember-me'], ['class' => 'btn btn-primary']) ?>
</div>
