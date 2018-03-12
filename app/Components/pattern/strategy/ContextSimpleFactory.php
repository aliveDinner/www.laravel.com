<?php

namespace App\Components\pattern\strategy;

use App\Components\pattern\strategy\ConcreteStrategyA;
use App\Components\pattern\strategy\ConcreteStrategyB;
use App\Components\pattern\strategy\ConcreteStrategyC;

/**
 * 策略与简单工厂结合 ContextFactory 【如果算法变更多，就使用策略与抽象工厂模式结合 （反射技术）】
 * Class ContextFactory
 * @package App\Components\pattern\strategy
 */
class ContextSimpleFactory
{

    /**
     * @var null|\App\Components\pattern\strategy\Strategy
     */
    public $strategy = null;

    /**
     * @param string $type
     * @return mixed
     */
    public function context($type)
    {
        switch ($type){
            case 'A':{
                $this->strategy = new ConcreteStrategyA();
            }break;
            case 'B':{
                $this->strategy = new ConcreteStrategyB();
            }break;
            case 'C':{
                $this->strategy = new ConcreteStrategyC();
            }break;
            default:{

            }break;
        }
    }

    public function getResult(){
        return $this->strategy ? $this->strategy->algorihm() : '简单工厂初始化失败';
    }
}