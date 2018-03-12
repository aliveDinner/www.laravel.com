<?php

namespace App\Components\pattern\builder;

/**
 * 建造者模式 抽象建造者类 ，确定产品由那些部分组成
 * Class Builder
 * @package App\Components\pattern\builder
 */
abstract class Builder
{

    /**
     * @return mixed
     */
    public abstract function buildPartA();
    /**
     * @return mixed
     */
    public abstract function buildPartB();
    /**
     * @return mixed
     */
    public abstract function getResult();

}