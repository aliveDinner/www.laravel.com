<?php

namespace App\Components\pattern\observer;

use App\Components\pattern\observer\ConcreteSubject;
use App\Components\pattern\observer\IObserver;

/**
 * 观察者模式 具体观察者
 * Class Observer
 * @package App\Components\pattern\observer
 */
class ConcreteObserver implements IObserver
{

    private $name;

    private $observerState;

    /**
     * @var \App\Components\pattern\observer\ConcreteSubject
     */
    private $concreteSubject;

    /**
     * 指向具体主题对象
     * @param $name
     * @param $concreteSubject
     */
    public function concreteObserver($name,ConcreteSubject $concreteSubject){
        $this->name = $name;
        $this->concreteSubject = $concreteSubject;
    }

    /**
     * @return mixed
     */
    public function update(){
        return $this->observerState = $this->concreteSubject->getSubjectState();
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return \App\Components\pattern\observer\ConcreteSubject
     */
    public function getConcreteSubject()
    {
        return $this->concreteSubject;
    }

    /**
     * @param \App\Components\pattern\observer\ConcreteSubject $concreteSubject
     */
    public function setConcreteSubject($concreteSubject)
    {
        $this->concreteSubject = $concreteSubject;
    }

}