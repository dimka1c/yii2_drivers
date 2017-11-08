<?php

echo 'обработано записей : ' . $addressProcessed .'<br>';
echo 'Новых клиентов : ' . $newRecords .'<br>';
//debug( $newClients );

?>

<form action="<?= \yii\helpers\Url::to('/services')?>" method="post">
    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
    <button type="submit" class="btn btn-default">Назад</button>
</form>
