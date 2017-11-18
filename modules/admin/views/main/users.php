<?php

use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

$this->registerJsFile('js/UsersAdminModule.js',  ['depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]]);

?>

<div class="container">
    <table class="table table-hover">
        <tr>
            <th>Пользователь</th>
            <th>Логин</th>
            <th>Email</th>
            <th>Роль</th>
            <th>Регистрация</th>
            <th>Доступ</th>
        </tr>

        <?php if (isset($users)) : ?>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td>
                        <a class="user_edit" id="<?=$user->id?>" href="<?= \yii\helpers\Url::to(['main/view-user/'.$user->id])?>"><?= $user->fullname ?></a>
                    </td>
                    <td>
                        <?= $user->username ?>
                    </td>
                    <td class="td_email" id="email_<?=$user->id?>">
                        <?php if ($user->email == null) : ?>
                            нет данных
                        <?php else : ?>
                            <?= $user->email ?>
                        <?php endif ?>
                    </td>
                    <td>
                        <div class="dropdown">
                            <a data-toggle="dropdown" href="#"><?= $roles[$user->role] ?></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <?php foreach ($roles as $role) : ?>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#"><?= $role ?></a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                        </div>
                    </td>
                    <td>
                        <span class="btn-group-sm">
                            <?= $user->data_registration ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($user->access) : ?>
                            <button type="button" class="btn btn-success btn-sm" id="<?= $user->id ?>">
                                <span class="glyphicon glyphicon-ok-circle"></span>
                                Запретить
                            </button>
                        <?php else : ?>
                            <button type="button" class="btn btn-danger btn-sm" id="<?= $user->id ?>">
                                <span class="glyphicon glyphicon-remove-circle"></span>
                                Разрешить
                            </button>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </table>
</div>


<!--<div id="service" class="service">
    <ul>
        <li class="active"><a href="#">За 30 дней</a></li>
        <li><a href="#">За 14 дней</a></li>
        <li><a href="#">За 7 дней</a></li>
        <li><a href="#">За 1 день</a></li>
        <li role="separator" class="divider"></li>
        <li class="active"><a href="#">С описанием</a></li>
        <li class=""><a href="#">Только заголовки</a></li>
    </ul>
</div>-->


<?php

$buttonFooter = '<button type="button" class="btn btn-primary" id="modalSave">Сохранить изменения</button>';


Modal::begin([
    'header' => '<h2>Редактирование данных пользователя</h2>',
    'id' => 'myModal',

//    'toggleButton' => [
//        'label' => 'click me',
//        'tag' => 'button',
//        'class' => 'btn btn-success',
//    ],
    'footer' => $buttonFooter,
]);
?>
<?php $form = ActiveForm::begin(['id' => 'modalForm']) ?>
<?= $form->field($model, 'id')
    ->hiddenInput(['id' => 'modalUserID', 'name' => 'ModalUserModel[id]'])
    ->label(false) ?>
<?= $form->field($model, 'fullname')
    ->textInput(['id' => 'inputFullName', 'name' => 'ModalUserModel[fullname]'])
    ->label('ФИО') ?>
<?= $form->field($model, 'username')
    ->textInput(['id' => 'inputLogin', 'name' => 'ModalUserModel[username]'])
    ->label('Логин') ?>
<?= $form->field($model, 'email')
    ->Input('email', ['id' => 'inputEmail', 'name' => 'ModalUserModel[email]'])
    ->label('Email') ?>
<?= $form->field($model, 'role')
    ->dropDownList([], ['id' => 'modalUserRole', 'name' => 'ModalUserModel[role]'])
    ->label('Права доступа') ?>
<?= $form->field($model, 'access')
    ->checkbox(['label' => 'Разрешен доступ', 'id' => 'inputAccess', 'name' => 'ModalUserModel[access]']) ?>
<?= $form->field($model, 'dataRegistration')
    ->textInput(['disabled' => true, 'id' => 'dataRegistration', 'name' => 'ModalUserModel[dataRegistration]'])
    ->label('Регистрация') ?>

<?php ActiveForm::end() ?>

<?php Modal::end(); ?>


<!-- START MODAL -->
<!--
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Редактирование пользователя</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="modalForm">
                    <input type="hidden" name="modalUserID" id="modalUserID">
                    <div class="form-group">
                        <label for="inputFullName" class="col-sm-2 control-label">ФИО</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="modalUserFullName" id="inputFullName" placeholder="ФИО">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="modalUserEmail" id="inputEmail" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLogin" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="modalUserLogin" id="inputLogin" placeholder="Логин">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRole" class="col-sm-2 control-label">Права</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="modalUserRole" id="modalUserRole">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dataRegistration" class="col-sm-2 control-label">Дата регистрации</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="modalUserDataRegistration" id="dataRegistration" placeholder="дата регистрации" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox col-sm-6">
                                <label>
                                    <input type="checkbox" name="modalUserAccess" id="inputAccess"> Активный
                                </label>
                            </div>
                            <div class="col-sm-4 col-sm-offset-2">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Сбросить пароль</button>
                            </div>
                            <div class="form-group" id="modalSaveMessage">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="modalSave">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>
--!>
<!-- END MODAL -->