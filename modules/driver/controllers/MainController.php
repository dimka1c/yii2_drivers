<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 007 07.11.17
 * Time: 10:55
 */

namespace app\modules\driver\controllers;

use app\modules\driver\models\Client;
use Yii;
use yii\base\ErrorException;
use yii\helpers\Url;

class MainController extends AppDriverController
{

    public function actionIndex()
    {
        return $this->render('main');
    }

}