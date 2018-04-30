<?php

namespace modules\api\v1;

use Yii;

class Module extends \modules\api\Module
{
    public $controllerNamespace = 'modules\api\v1\controllers';
    public function init()
    {
        //Yii::$app->user->identityClass = 'modules\api\models\ApiUserIdentity';
        //Yii::$app->user->enableSession = false;
        //Yii::$app->user->loginUrl = null;
        parent::init();
    }
}
