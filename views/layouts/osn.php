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
        <!-- Style -->
        <link href="/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/style.css" type="text/css"/>
        <!-- //Style -->

        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
        <!-- Fonts -->
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="container-fluid">
        <div class="container top-line">
            <h1>Омега-Автопоставка</h1>
            <div class="clear-loading spinner">
                <span></span>
            </div>

            <?php
            if (Yii::$app->session->hasFlash('registration_new_user')) {
                echo Yii::$app->session->getFlash('registration_new_user', true);
            }
            ?>
        </div>
        <div class="container-fluid">
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
        </div>
        <div class="navbar-fixed-bottom row-fluid">
            <div class="navbar-inner">
                <div class="container">
                    <p class="copiryght">Copyright by Parshyn Dmitry специально для Омега-Автопоставка КРД-Днепр</p>
                </div>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>