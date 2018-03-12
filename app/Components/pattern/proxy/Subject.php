<?php

namespace App\Components\pattern\proxy;

/**
 * 代理模式 定义 RealSubject 和Proxy 的共用接口
 * Class Subject
 * @package App\Components\pattern\proxy
 */
abstract class Subject
{
    /**
     * @return mixed
     */
    public abstract function request();
}