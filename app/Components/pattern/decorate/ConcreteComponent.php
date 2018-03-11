<?php

namespace App\Components\pattern\decorate;

use App\Components\pattern\decorate\Component;

/**
 * 简单工厂
 * Class SimpleFactory
 * @package App\Components\pattern\simple
 */
class ConcreteComponent extends Component
{

    /**
     * 穿戴操作 实现
     * @return mixed
     */
    public function operation(){
        return '具体对象的操作';
    }
}