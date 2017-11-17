<?php

namespace app\modules\admin;

use app\components\behaviors\AccessBehaviors;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        \Yii::configure($this, require __DIR__ . '/config/config.php');
    }

/*    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            \Yii::$app->getResponse()->redirect(['main']);
        }
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (\Yii::$app->user->identity->role != 'admin') {
           \Yii::$app->getResponse()->redirect(['main']);
        }
    }*/

    public function behaviors()
    {
        return [
/*            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    //throw new \Exception('У вас нет доступа к этой странице');
                    $urlFlash = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                    \Yii::$app->session->setFlash('accessDenied',
                        "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <strong>Ошибка доступа</strong> Для доступа к странице <b>$urlFlash</b> необходимо авторизироваться
                            </div>"
                    );
                    \Yii::$app->response->redirect(['main']);
                },
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],*/
            'access' => [
                'class' => AccessBehaviors::className(),
                'root' => ['admin'],
            ]
        ];
    }
}
