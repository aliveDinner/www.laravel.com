<?php

namespace App\Components\pattern\observer;

use App\Components\pattern\observer\EventHandler;
/**
 * 观察者模式 具体主题【具体通知者】
 * Class ConcreteSubject
 * @package App\Components\pattern\observer
 */
class ConcreteSubject extends EventHandler
{
    public function __construct($SubjectState)
    {
        $this->setSubjectState($SubjectState);
    }
}