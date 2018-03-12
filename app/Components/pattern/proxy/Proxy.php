<?php

namespace App\Components\pattern\proxy;

use App\Components\pattern\proxy\RealSubject;
/**
 * 代理模式 中 Proxy 类
 * Class Proxy
 * @package App\Components\pattern\proxy
 */
class Proxy
{

    /**
     * @var null|\App\Components\pattern\proxy\RealSubject
     */
    public $realSubject = null;

    public function request(){
        if ($this->realSubject == null){
            $this->realSubject = new RealSubject();
        }
        return $this->realSubject->request();
    }
}