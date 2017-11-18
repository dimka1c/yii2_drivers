<h3>Список водителей</h3>

<?php

    $this->registerJsFile('/js/AdminDriverModal.js',  ['depends' => [\yii\web\JqueryAsset::className()]]);

?>


<div class="container">
    <table class="table table-hover">
        <tr>
            <th>ФИО водителя</th>
            <th>имя для МЛ</th>
            <th>Телефон</th>
            <th>Фото</th>
        </tr>
    <?php

        if (isset($drivers)) {
            foreach ($drivers as $driver) {
                echo '<tr>';
                    echo "<td id=$driver->id>";
                        echo "<a href='#' id=$driver->id class='drivername'>$driver->namedriver</a>";
                    echo '</td>';
                    echo '<td>';
                        echo $driver->ml_driver;
                    echo '</td>';
                    echo '<td>';
                        if ($driver_phone == null) {
                            echo 'нет данных';
                        } else {
                            echo $driver->driver_phone;
                        }
                    echo '</td>';
                    echo '<td>';
                        if ($driver->driver_photo == null ) {
                            echo 'нет фото';
                        } else {
                            echo $driver->driver_photo;
                        }
                    echo '</td>';

                echo '</tr>';
            }
        }
    ?>
        </table>
</div>

<div id="service" class="service">
    <ul>
        <li class="active"><a href="#">За 30 дней</a></li>
        <li><a href="#">За 14 дней</a></li>
        <li><a href="#">За 7 дней</a></li>
        <li><a href="#">За 1 день</a></li>
        <li role="separator" class="divider"></li>
        <li class="active"><a href="#">С описанием</a></li>
        <li class=""><a href="#">Только заголовки</a></li>
    </ul>
</div>
