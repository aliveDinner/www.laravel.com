<?php

namespace App\Components\pattern\strategy;

use App\Components\pattern\strategy\Strategy;

/**
 * 具体算法B
 * Class StrategyB
 * @package App\Components\pattern\strategy
 */
class ConcreteStrategyB extends Strategy{

    /**
     * 算法A 实现方法
     */
    public function algorihm(){
        return '算法B实现';
    }
}