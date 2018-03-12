<?php

namespace App\Components\pattern\simple;

use App\Components\pattern\simple\FactoryProduct;
/**
 * 工厂方法模式 具体产品A 的实现类
 * Class ConcreteFactoryProduct
 * @package App\Components\pattern\simple
 */
class ConcreteFactoryProductA extends FactoryProduct
{
    public function getResult(){
        return '具体产品A ';
    }
}