<?php

namespace App\Components\pattern\observer;

use App\Components\pattern\observer\IObserver;
use App\Components\pattern\observer\ISubject;

/**
 * 观察者模式 抽象主题类【抽象通知者】
 * Class EventSubject
 * @package App\Components\pattern\observer
 */
class EventHandler implements ISubject
{
    private $subjectState;

    /**
     * 记住的观察者
     * @var array
     */
    private $lists = [];

    /**
     * 添加观察者
     * @param IObserver $observer
     */
    public function attach(IObserver $observer){
        $this->lists[$observer->getName()] = $observer;
    }

    /**
     * 移除观察者
     * @param IObserver $observer
     */
    public function detach(IObserver $observer){
        unset($this->lists[$observer->getName()]);
    }


    /**
     * 通知
     */
    public function notify(){
        foreach ($this->lists as $list){
            /**
             * @var $list IObserver
             */
            $list->update();
        }
    }

    /**
     * @return mixed
     */
    public function getSubjectState()
    {
        return $this->subjectState;
    }

    /**
     * @param mixed $subjectState
     */
    public function setSubjectState($subjectState)
    {
        $this->subjectState = $subjectState;
    }

}