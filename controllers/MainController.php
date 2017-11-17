<?php

namespace app\controllers;

use app\components\behaviors\RulesBehaviors;
use app\models\LoginForm;
use app\models\RememberForm;
use app\models\SignupForm;
use app\models\User;
use yii\web\Controller;
use Yii;
use yii\helpers\Url;

class MainController extends Controller
{

    public $layout = 'default';

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->login()) {
                    // пользователь зареган
                    return $this->redirect(Url::to($this->getPath()));
                }
            }
            return $this->render('index', compact('model'));
        }
        return $this->redirect(Url::to($this->getPath()));
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            $this->goHome();
        }

        //patteern regexp for фамилия И.О.
        // ^[А-ЯЁа-яё]+ [А-ЯЁ]\.[А-ЯЁ]\.$

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
        if (Yii::$app->user->isGuest) {
            $model = new RememberForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $user = User::findByUserEmail($model->email);
                if ($user) {
                    // нашли пользователя и отправляем новый пароль на email
                    // Запишем новый пароль в базу данных
                    $newPassword = Yii::$app->security->generateRandomString(10);
                    $user->password = Yii::$app->security->generatePasswordHash($newPassword);
                    if ($user->save()) {
                        // после успешной записи отправим новый пароль на почту
                        debug($newPassword);
                        debug($user->password);
                        $mail = Yii::$app->mailer->compose()
                            ->setFrom('omega.dnepr@gmail.com')
                            ->setTo($user->email)
                            ->setSubject('Восстановление пароля omega.dnepr')
                            ->setTextBody("Вы запросили восстановление пароля на сайте omega.dnepr\n
                                      Ваш новый пароль:\n" . $newPassword)
                            ->send();

                        Yii::$app->session->setFlash('rememberMe',
                            '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Внимание!</strong> Новый пароль выслан на email
                            </div>'
                        );
                        return $this->redirect('/main/index');
                    } else {
                        // не удалось сохранить пароль в базе данных
                        Yii::$app->session->setFlash('rememberMe',
                            '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Ошибка!</strong> Не удалось поменять пароль
                            </div>'
                        );
                        return $this->render('rememberme', compact('model'));
                    }
                }
            }
            return $this->render('remember', compact('model'));
        }
        return $this->goHome();
    }

    public function actionAccessDenied()
    {
        $this->layout = 'accessdenied';
        return $this->render('accessdenied');
    }

    public function behaviors()
    {
        return [
            'route' => [
                'class' => RulesBehaviors::className(),
            ],
        ];
    }


}