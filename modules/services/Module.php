<?php

namespace app\modules\services;
use app\components\behaviors\AccessBehaviors;

/**
 * services module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\services\controllers';

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
            'access' => [
                'class' => AccessBehaviors::className(),
                'root' => ['admin'],
            ],
        ];
    }
}
