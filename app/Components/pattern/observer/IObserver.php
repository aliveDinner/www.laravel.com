<?php

namespace App\Components\pattern\observer;

/**
 * 观察者模式 抽象观察者【未必是抽象类，也可以是接口】
 * Class Observer
 * @package App\Components\pattern\observer
 */
interface IObserver
{
    /**
     * @return mixed|string
     */
    public function getName();

    /**
     * @return mixed
     */
    public function update();

}