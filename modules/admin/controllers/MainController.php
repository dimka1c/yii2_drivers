<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\DriversModel;
use app\modules\admin\models\EmailModel;
use app\modules\admin\models\ModalUserModel;
use app\modules\admin\models\UsersModel;
use yii\web\Controller;
use Yii;


/**
 * Default controller for the `admin` module
 */
class MainController extends Controller
{

    public $layout = 'admin';
    public $role;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateMl()
    {
//        $ml = imap_open($this->module->params['email']['host'], $this->module->params['email']['username'], $this->module->params['email']['password']) or die('Cannot connect to: ' . $this->module->params['email']['host'] . '. <b>ERROR</b>' . imap_last_error());

        $model = new EmailModel($this->module->params);
        $model->getMessages();
        return $this->render('create-ml', compact('model'));
    }

    public function actionDrivers()
    {
        $drivers = DriversModel::find()->all();
        return $this->render('drivers', ['drivers' => $drivers]);
    }

    public function actionRuns()
    {
        return $this->render('runs');
    }

    public function actionRoutings()
    {
        return $this->render('routings');
    }

    public function actionUsers()
    {
        if (Yii::$app->request->isAjax && $action = Yii::$app->request->post()) {
            if (isset($action['action']) ){
                if ($action['action'] == 'access') {
                    $user = UsersModel::findOne(['id' => $action['id']]);
                    $user->access = $user->access ^ 1;
                    if ($user->save()) {
                        return json_encode($user->access);
                    }
                }
            }
            return json_encode('error');
        }
        $users = UsersModel::find()->all();
        $model = new ModalUserModel();
        return $this->render('users', [
            'users' => $users,
            'model' => $model,
            'roles' => $this->module->params['roles']
        ]);
    }

    public function actionViewUser()
    {
        if (Yii::$app->request->isAjax && $id = Yii::$app->request->post('id')) {
            $user = UsersModel::find()
                ->select(['id','username','fullname','email','data_registration','role','access'])
                ->where(['id' => $id])
                ->asArray()
                ->all();
            array_push($user[0], $this->module->params['roles']);
            return json_encode($user[0]);

        }
        if ( !empty($id = Yii::$app->request->get('id')) ) {
            $user = UsersModel::find()->where(['id' => $id])->all();
            debug ($user);
        };

    }

    public function actionSaveUser() {

        if (Yii::$app->request->isAjax && Yii::$app->request->post()) {
            $model= new ModalUserModel();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $user = UsersModel::findOne(['id' => $model->id]);
                if ($user) {
                    if ($user->username == $model->username &&
                        $user->fullname == $model->fullname &&
                        $user->email == $model->email &&
                        $user->role == $model->role &&
                        $user->access == $model->access) {
                            return 'изменений нет';
                    }
                    $user->username = $model->username;
                    $user->fullname = $model->fullname;
                    $user->email = $model->email;
                    $user->role = $model->role;
                    $user->access = $model->access;
                    if ($user->save()) {
                        return $user->id; //записали новые значения
                    } else {
                        return 'Ошибка записи в базу данных';
                    }
                } else {
                    return 'ошибка, пользователь не найден';
                }
            } else {
                return 'не верно заполнены поля';
            }
        }
        return 'ошибка сервера';
    }
}
