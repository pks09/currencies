<?php

namespace console\components\import;

interface ProviderInterface
{
    /*
     * Возвращает массив массивов с ключами, совпадающими с
     * полями соответствующей таблицы БД
     * @return array
     */
    public function getData();
}

