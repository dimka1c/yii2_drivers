<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 016 16.10.17
 * Time: 19:57
 */

namespace app\controllers;


use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use yii\web\Controller;
use Yii;
use yii\helpers\Url;


class MainController extends Controller
{

    public function actionIndex()
    {
        $this->layout = 'osn';
        if (Yii::$app->user->isGuest) {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->login()) {
                    // пользователь зареган
                    return $this->redirect(Url::to('auth/index'));
                }
            }
            return $this->render('index', compact('model'));
        }
        return $this->redirect(Url::to('auth/index'));
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSignup()
    {
        $this->layout = 'osn';
        if (!Yii::$app->user->isGuest) {
            $this->goHome();
        }
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new User();
            $user->username = trim($model->username);
            $user->password = Yii::$app->security->generatePasswordHash($model->password);
            //$user->accessToken = "";
            //$user->authKey = Yii::$app->security->generateRandomString(64);
            $user->role = 'user';
            $user->access = 0;
            $user->fullname = $model->fullname;
            $user->email = $model->email;
            if ($user->save()) {
                Yii::$app->session->setFlash('registration_new_user',
                '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Регистрация прошла успешно</strong> Свяжитесь с Вашим руководителем для получения доступа
                    </div>'
                );
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('registration_new_user',
                    '<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Ошибка регистрации</strong> Повторите попытку позже
                    </div>'
                );
            }
        }
        return $this->render('signup', compact('model'));
    }

    public function actionRememberMe()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->render('remember');
        }
        $this->goHome();
    }

    public function actionAccessDenied()
    {
        $this->layout = 'accessdenied';
        return $this->render('accessdenied');
    }

}