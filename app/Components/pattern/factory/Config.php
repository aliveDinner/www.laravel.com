<?php

namespace App\Components\pattern\factory;

/**
 * Class Config
 * @package App\Components\pattern\factory
 */
class Config
{
    /**
     * @return mixed|\App\Components\pattern\factory\DataAccess
     */
    public static function get()
    {
        return [
            'db' => '\App\Components\pattern\factory\Mysql',
        ];
    }
}