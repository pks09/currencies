<?php
namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

class CurrencyController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Currency';
}