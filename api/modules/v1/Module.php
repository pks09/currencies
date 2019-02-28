<?php
/**
 * @author: Kirill Ponosov <ponosov.k@ya.ru>
 */

namespace api\modules\v1;

use yii\filters\auth\HttpBearerAuth;

class Module extends \yii\base\Module
{

    public $defaultRoute = 'v1';

    public $controllerNamespace = 'api\modules\v1\controllers';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBearerAuth::className();
        return $behaviors;
    }

}