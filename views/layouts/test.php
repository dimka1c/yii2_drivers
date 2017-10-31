<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
$this->registerJsFile('/js/no_auth.js',  ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrapper">
        <?= $content ?>


        <div class="data">
            <div class="column">
                <div class="days_site" id="days"></div>
            </div>
        </div>
        <div class="clock">
            <div class="column">
                <div class="timer" id="hours"></div>
            </div>
            <div class="timer">:</div>
            <div class="column">
                <div class="timer" id="minutes"></div>
            </div>
            <div class="timer">:</div>
            <div class="column">
                <div class="timer" id="seconds"></div>
            </div>
        </div>
    </div>

    <div class="navbar-fixed-bottom row-fluid">
        <div class="navbar-inner">
            <div class="container">
                <p class="copiryght">Copyright by Parshyn Dmitry специально для Омега-Автопоставка КРД-Днепр</p>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>