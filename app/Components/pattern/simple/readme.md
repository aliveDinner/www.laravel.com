

## 设计模式——简单工厂模式

是面向对象的简单使用。

工厂方法模式是简单工厂模式的进一步抽象和推广

类 SimpleFactory 是简单工厂模式

## 设计模式——工厂方法模式

工厂方法模式是简单工厂模式的进一步抽象和推广

类 FactoryLine 是工厂方法模式

过程：

$creatorA = new ConcreteFactoryCreatorA();

$productA = $creatorA->getResult();
