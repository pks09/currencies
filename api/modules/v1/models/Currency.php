<?php
namespace api\modules\v1\models;

class Currency extends \common\models\Currency
{
    public function fields()
    {
        return [
            'id' => 'id',
            'name' => 'name',
            'rate' => 'rate',
        ];
    }}