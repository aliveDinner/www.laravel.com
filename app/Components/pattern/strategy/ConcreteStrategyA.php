<?php

namespace App\Components\pattern\strategy;

use App\Components\pattern\strategy\Strategy;

/**
 * 具体算法A
 * Class StrategyA
 * @package App\Components\pattern\strategy
 */
class ConcreteStrategyA extends Strategy{

    /**
     * 算法A 实现方法
     */
    public function algorihm(){
        return '算法A实现';
    }
}