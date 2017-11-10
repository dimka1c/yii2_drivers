<h1>Module driver / DriverController</h1>
<a href="<?= \yii\helpers\Url::to('/main/logout'); ?>">Разлогинить пользователя</a>

    <div class="col-md-12">
        <div class="list-group col-md-3">
            <a href="<?= \yii\helpers\Url::to(['main/settings']) ?>" class="list-group-item active">Личный кабинет</a>
            <a href="#" class="list-group-item">Мой автомобиль</a>
            <a href="#" class="list-group-item">Мои маршруты</a>
            <a href="#" class="list-group-item">Данные о пробегах</a>
            <a href="#" class="list-group-item">Информация</a>
        </div>
        <div class="col-md-9">

        </div>
    </div>

<?php

debug (Yii::$app->user->identity->id);
//debug (Yii::$app->user->identity);
?>

