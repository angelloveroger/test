# PHP中类的属性/方法访问控制



> ## *1.类的 `属性`* 
>> |访问|表达式|`static`|`PUBLIC`|`PROTECTED`|`PRIVATE`|      
>> |:-:|:-:|:-:|:-:|:-:|:-:|             
>> |类内部|`$this->attr`|`$this::$attr` \| `self::$attr`|可访问|可访问|可访问|
>> |类实例|`(new class())->attr`|`(new class())::$attr`|可访问|`致命错误`|`致命错误`|
>> |子类内部|`$this->attr`|`$this::$attr` \| `parent::$attr`|可访问|可访问|`致命错误`|   
>> |子类实例|`(new sonClass())->attr`|`(new sonClass())::$attr`|可访问|`致命错误`|`致命错误`|
> ---           

> ## *2.类的 `方法`*
>> |访问|表达式|`static`|`PUBLIC`|`PROTECTED`|`PRIVATE`|       
>> |:-:|:-:|:-:|:-:|:-:|:-:|
>> |类内部|`$this->func()`|`self::func()`|可访问|可访问|可访问|        
>> |类实例|`(new class())->func()`|`(new class())::func()`|可访问|`致命错误`|`致命错误`|
>> |子类内部|`$this->func()`|`self::func()` \| `parent::func()`|可访问|可访问|`致命错误`|       
>> |子类实例|`(new sonClass())->func()`|`(new sonClass())::func()`|可访问|`致命错误`|`致命错误`|
> --- 

> ## 3.访问属性关键词（```PUBLIC,PROTECTED,PRIVATE```）总结：
 >> ### 1.`PUBLIC`修饰的`属性`或者`方法`，在`类内部`，`类实例`，`子类内部`，`子类实例`中均可访问        
 >> ### 2.`PROTECTED`修饰的`属性`或者`方法`，仅可以在`类内部`，`子类内部`访问     
 >> ### 3.`PRIVATE`修饰的`属性`或者`方法`，仅可在`类内部`访问       
 > ---