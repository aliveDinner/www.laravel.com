<?php

namespace App\Components\pattern\decorate;

use App\Components\pattern\decorate\Component;

/**
 * 装饰抽象类
 * Class Decorator
 * @package App\Components\pattern\decorate
 */
abstract class Decorator extends Component
{

    /**
     * @var null | \App\Components\pattern\decorate\Component
     */
    protected $component = null;

    /**
     * 设置 Component
     * @param \App\Components\pattern\decorate\Component $component
     */
    public function setComponent( Component $component ){
        $this->component = $component;
    }

    /**
     * 穿戴操作
     * @return mixed
     */
    public function operation(){
        if ($this->component != null){
            return $this->component->operation();
        }else{
            return '';
        }
    }
}