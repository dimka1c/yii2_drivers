<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 030 30.10.17
 * Time: 16:53
 */

namespace app\controllers;

use app\models\ListDriver;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class AuthController extends Controller
{

    //public $layout = false;

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin') {
            //$model = new ListDriver();
            //$allDrivers = ListDriver::find()->asArray()->all();
            return $this->render('index');
        }
        return $this->redirect(Url::to('/main/access-denied'));
    }

}