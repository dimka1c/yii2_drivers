<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\ListDriver;


debug(Yii::$app->user->identity->fullname);

?>

<div class="form-group">
    <?= Html::a('Выход', ['main/logout'], ['class' => 'btn btn-primary']) ?>
</div>

<?php
$dataProvider = new ActiveDataProvider([
    'query' => ListDriver::find(),
    'pagination' => [
        'pageSize' => 20,
    ],
]);
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'namedriver',
        'ml_driver',
        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Действия',
            'headerOptions' => ['width' => '80'],
            'template' => '{view} {update} {delete}{link}',
        ],
    ],
    'tableOptions' => [
        'class' => 'table table-striped'
    ],
    'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
    ]);
?>
