<?php
    use yii\helpers\Url;

    $_csrf = Yii::$app->request->getCsrfToken();
?>

<div class="services-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        Здесь будут располагаться сервисные функции сайта
    </p>
    <p>
        путь к файлу:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>

<div class="panel panel-primary">
    <div class="panel-body">
        <p>Запись содержимого ранее сохраненных csv-файлов в базу данных (таблица client).</p>
        Исключается дублирование клиентов по следующим параметрам: наименование клиента, город клиента, адрес клиента
    </div>
    <div class="panel-footer">
        <form action="<?= Url::to('services/service/read-csv')?>" method="post">
            <input type="hidden" name="_csrf" value="$_csrf">
            <button type="submit" class="btn btn-primary">Выполнить</button>
        </form>
    </div>
</div>