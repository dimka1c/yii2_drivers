<div class="alert alert-success alert-dismissable" id="messageLoading" style="display: none">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong id="messageTitle"></strong><p id="messageText"></p>
</div>
<?php
use yii\widgets\ActiveForm;

$this->registerJsFile('js/upload.js', ['depends' => 'yii\bootstrap\BootstrapPluginAsset']);
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'uploadForm']]) ?>

<?= $form->field($model, 'upfile[]')->fileInput(['multiple' => true, 'accept' => 'xls/*']) ?>

<div id="load" class="btn-group" data-toggle="buttons">
</div>

    <button class="submit button">Submit</button>
    <button class="reset-button">Очистить</button>

<?php ActiveForm::end() ?>

<div id="showPercentLoading" style="display: none">
    <div class="progress progress-striped active">
        <div id="percent" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
            0%
        </div>
    </div>
</div>
