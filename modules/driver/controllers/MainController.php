<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 007 07.11.17
 * Time: 10:55
 */

namespace app\modules\driver\controllers;

class MainController extends AppDriverController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionOne()
    {
        return $this->render('index');
    }

}