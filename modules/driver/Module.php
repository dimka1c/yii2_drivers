<?php

namespace app\modules\driver;

use app\components\behaviors\AccessBehaviors;
use yii\filters\AccessControl;

/**
 * driver module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\driver\controllers';


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

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
            ]*/
            'access' => [
                'class' => AccessBehaviors::className(),
                'root' => ['driver'],
            ]
        ];
    }
}


