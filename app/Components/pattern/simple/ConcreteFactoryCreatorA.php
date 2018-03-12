<?php

namespace App\Components\pattern\simple;

use App\Components\pattern\simple\FactoryCreator;
/**
 * 工厂方法模式 的 工厂抽象 具体产品A 创建类 的 实现
 * Class ConcreteFactoryCreator
 * @package App\Components\pattern\simple
 */
class ConcreteFactoryCreatorA extends FactoryCreator
{
    /**
     * @return \App\Components\pattern\simple\FactoryProduct
     */
    public function create(){
        return new ConcreteFactoryProductA();
    }
}