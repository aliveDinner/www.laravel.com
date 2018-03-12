

## 设计模式——策略模式(strategy)

策略模式是一种定义一系列算法的方法，从概念上来看，所有这些算法完成的都是相同的工作，
只是实现不同，它可以以相同的方式调同所有的算法，减少了各种算法类与使用算法类之间的耦合。

## Strategy 类（抽象类），定义所有支持的算法或行为 的公共接口

## ConcreteStrategy，封装了具体的算法或行为，继承与Strategy

## Context 类，是与Strategy聚合关系，用一个ConcreteStrategy类配置，维护一个队Strategy对象的引用

## 策略与简单工厂结合 ContextFactory 【如果算法变更多，就使用策略与抽象工厂模式结合 （反射技术）】



