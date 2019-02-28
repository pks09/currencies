<?php
/**
 * @author: Kirill Ponosov <ponosov.k@ya.ru>
 */

namespace api\modules\v1;

class Module extends \yii\base\Module
{

    public $defaultRoute = 'v1';

    public $controllerNamespace = 'api\modules\v1\controllers';

}