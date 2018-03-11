<?php

namespace App\Components\pattern\prototype;

use App\Components\pattern\prototype\Prototype;
/**
 * 具体原型类 A
 * Class ConcretePrototypeA
 * @package App\Components\pattern\prototype
 */
class ConcretePrototypeA extends Prototype{

    /**
     * 是否重写克隆方法
     * 创建当前对象的浅表副本。
     * 过程是创建爱你一个新对象，然后将当前对象的非静态字段【属性】复制到新对象中。
     * 分为 浅复制和深复制【引用的对象数据是否复制】
     * @return static
     */
    public function __clone(){
        $object = new static();
        $object->setId($this->getId());
        return $object;
    }

    /**
     * 创建当前对象的浅表副本。
     * 过程是创建爱你一个新对象，然后将当前对象的非静态字段【属性】复制到新对象中。
     * 分为 浅复制和深复制【引用的对象数据是否复制】
     * @return static
     */
    public function copy(){
        return clone $this;
    }


}