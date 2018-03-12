

## 设计模式——装饰模式

装饰模式：动态地给一个对象添加一些额外的职责，就增加功能来说，装饰模式比生成子类更为灵活。

此模式里，使用setComponent来对对象进行包装。
这样每个装饰对象的实现就和如何使用这个对象分离开了，每个装饰对象只关心自己的功能，
不需要关心如何被添加到对象链当中。

提醒：

1）Component 是定义一个对象接口，可以给这些对象动态添加职责。
ConcreteComponent是定义了一个具体的对象，也可以给这个对象添加一些职责。
Decorator，装饰抽象类，继承了Component，从外类来扩展Component类的功能，
但对于Component来说，是无需知道Decorator的存在的。
至于ConcreteDecorator就是具体的装饰对象，起到给Component添加职责的功能。

2）变通：如果只有一个ConcreteComponent类而没有抽象的Component类，
那么Decorator类可以是ConcreteComponent的一个子类。
同样道理如果只有一个ConcreteDecorator类，那么久没有必要建立一个单独的Decorator类，
而可以把Decorator和ConcreteDecorator的责任合并成一个类。

## 总结

装饰模式是为已有功能动态添加更多功能的一种方式。

优点：把类中的装饰功能从勒种搬移去除，这样可以简化原有的类。
    这样做更大的好处就是有效地把类的核心职责和装饰功能区分开了。
    并且可以去除相关类中重复的装饰逻辑。
    
注意：装饰的顺序很重要。比如加密数据和过滤词汇都可以是数据持久化前的装饰功能，
    但若先加密了数据再用过滤功能就会出问题了。


