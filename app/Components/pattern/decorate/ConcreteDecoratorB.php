<?php

namespace App\Components\pattern\decorate;

use App\Components\pattern\decorate\Decorator;

/**
 * 装饰抽象类 具体装饰类
 * Class ConcreteDecoratorB
 * @package App\Components\pattern\decorate
 */
class ConcreteDecoratorB extends Decorator
{
    /**
     * 穿戴操作
     * @return mixed
     */
    public function operation(){
        //首先运行远Component的operation；在执行本类独有的功能。
        $res = parent::operation();
        $this->state = 'New State';
        return $res.'具体装饰对象B的操作';
    }

    private function behavior(){
        return 'B独有的';
    }
}