<?php

namespace console\controllers;

use yii\console\Controller;
use Yii;

class ImportController extends Controller
{

    public function actionIndex()
    {
        /** @var \console\components\import\currency\Importer $importer */
        $importer = Yii::$container->get('console\components\import\currency\Importer');
        $importer->run();
        $this->stdout('done' . PHP_EOL);
    }

}