<?php

namespace App\Components\pattern\decorate;

/**
 * 装饰模式 抽象类
 * Class Component
 * @package App\Components\pattern\decorate
 */
abstract class Component
{

    /**
     * 穿戴操作
     * @return mixed
     */
    public abstract function operation();
}