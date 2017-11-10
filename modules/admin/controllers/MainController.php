<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\EmailModel;
use yii\web\Controller;


/**
 * Default controller for the `admin` module
 */
class MainController extends Controller
{

    public $title = 'Администратор';
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
        return $this->render('drivers');
    }

    public function actionRuns()
    {
        return $this->render('runs');
    }

    public function actionRoutings()
    {
        return $this->render('routings');
    }
}
