<?php

use yii\helpers\Html;

debug(Yii::$app->user->identity->fullname);

?>

<div class="form-group">
    <?= Html::a('Выход', ['main/logout'], ['class' => 'btn btn-primary']) ?>
</div>