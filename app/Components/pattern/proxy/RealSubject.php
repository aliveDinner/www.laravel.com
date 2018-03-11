<?php

namespace App\Components\pattern\proxy;

/**
 * 代理模式 中 RealSubject 类
 * Class RealSubject
 * @package App\Components\pattern\proxy
 */
class RealSubject
{
    /**
     * @return string
     */
    public function request(){
        return '真实的请求';
    }
}