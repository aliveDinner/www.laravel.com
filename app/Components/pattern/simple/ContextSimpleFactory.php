<?php

namespace App\Components\pattern\simple;

/**
 * 简单工厂
 * Class SimpleFactory
 * @package App\Components\pattern\simple
 */
class SimpleFactory
{

    /**
     * @var null|\App\Components\pattern\simple\SimpleFactory
     */
    public $instance = null;

    /**
     * @param string $type
     * @return mixed
     */
    public function context($type)
    {
        switch ($type){
            case 'A':{
                $this->instance = new static();
            }break;
            case 'B':{
                $this->instance = new static();
            }break;
            case 'C':{
                $this->instance = new static();
            }break;
            default:{

            }break;
        }
    }

    public function getResult(){
        return $this->instance ? '简单工厂初始化成功' : '简单工厂初始化失败';
    }
}