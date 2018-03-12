<?php

namespace App\Components\pattern\facade;

/**
 * 外观模式
 * Class Facade
 * @package App\Components\pattern\facade
 */
class Facade
{

    /**
     * @var null|\App\Components\pattern\facade\ConcreteBuilderA
     */
    public $one = null;
    /**
     * @var null|\App\Components\pattern\facade\SubFacadeTwo
     */
    public $two = null;
    /**
     * @var null|\App\Components\pattern\facade\ConcreteBuilderB
     */
    public $three = null;

    /**
     *
     */
    public function MethodA()
    {
        $this->one->getResult();
        $this->three->getResult();
    }
    /**
     *
     */
    public function MethodB()
    {
        $this->two->getResult();
        $this->three->getResult();
    }

}