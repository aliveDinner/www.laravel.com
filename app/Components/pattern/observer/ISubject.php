<?php

namespace App\Components\pattern\observer;

/**
 * 观察者模式 抽象主题类【抽象通知者】【未必是抽象类，也可以是接口】
 * Class ISubject
 * @package App\Components\pattern\observer
 */
interface ISubject
{

    /**
     * @return mixed
     */
    public function getSubjectState();

    /**
     * 设置状态
     * @param $subjectState
     */
    public function setSubjectState($subjectState);

    /**
     * 通知
     * @return mixed
     */
    public function notify();

}