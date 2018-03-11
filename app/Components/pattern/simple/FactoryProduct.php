<?php

namespace App\Components\pattern\simple;

/**
 * 工厂方法模式 抽象产品类
 * Class FactoryLine
 * @package App\Components\pattern\simple
 */
abstract class FactoryProduct
{
    /**
     * @return mixed
     */
    public abstract function getResult();
}