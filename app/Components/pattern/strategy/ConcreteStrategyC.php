<?php

namespace App\Components\pattern\strategy;

use App\Components\pattern\strategy\Strategy;

/**
 * 具体算法C
 * Class StrategyC
 * @package App\Components\pattern\strategy
 */
class ConcreteStrategyC extends Strategy{

    /**
     * 算法A 实现方法
     */
    public function algorihm(){
        return '算法C实现';
    }
}