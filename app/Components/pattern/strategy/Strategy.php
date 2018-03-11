<?php

namespace App\Components\pattern\strategy;

/**
 * 抽象类 算法类
 * Class Strategy
 * @package App\Components\pattern\strategy
 */
abstract class Strategy{

    /**
     * 策略算法入口，定义策略类所有支持的算法的公共接口
     * @return mixed
     */
    public abstract function algorihm();
}