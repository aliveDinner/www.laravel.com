<?php

namespace App\Components\pattern\template;

/**
 * 模板方法 子类B 实现
 * Class Template
 * @package App\Components\pattern\template
 */
class ConcreteTemplateB
{

    /**
     * 抽象行为A，子类B 实现
     * @return mixed
     */
    public function primitiveOperationA(){
        return '子类B的实现A方法';
    }

    /**
     * 抽象行为B，子类B 实现
     * @return mixed
     */
    public function primitiveOperationB(){
        return '子类B的实现B方法';
    }
}