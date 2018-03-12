<?php

namespace App\Components\pattern\template;

/**
 * 模板方法
 * Class Template
 * @package App\Components\pattern\template
 */
abstract class Template
{

    /**
     * 抽象行为A，放到子类实现
     * @return mixed
     */
    public abstract function primitiveOperationA();

    /**
     * 抽象行为B，放到子类实现
     * @return mixed
     */
    public abstract function primitiveOperationB();

    /**
     * 模板方法，给出逻辑执行的骨架
     * 而逻辑的组成是一些相应的抽象操作，他们都延迟到子类实现
     * @return string
     */
    public function run()
    {
        $res = '';
        $res .= $this->primitiveOperationA();
        $res .= $this->primitiveOperationB();
        return $res;
    }
}