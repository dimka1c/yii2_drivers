<?php
    debug ('asd');
?>

<h3>create-ml</h3>
<p>Создание МЛ</p>

<?php
    if (!empty($model->mail)) {
        foreach ($model->mail as $mail) {
            debug($mail);
            echo '<br>';
        }
    }
?>