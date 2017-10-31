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

    <button class="submit button">Submit</button>

<?php ActiveForm::end() ?>

<div id="load" class="btn-group" data-toggle="buttons">
</div>