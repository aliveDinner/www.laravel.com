<?php

namespace App\Components\pattern\simple;

/**
 * 工厂方法模式 的 工厂抽象接口
 * Class FactoryCreator
 * @package App\Components\pattern\simple
 */
abstract class FactoryCreator
{
    /**
     * @return mixed|\App\Components\pattern\simple\FactoryProduct
     */
    public abstract function create();
}