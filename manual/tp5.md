# `thinkphp5` 学习文档

> ## 一.配置
>>***1.thinkphp的配置加载顺序由上而下，优先顺序由下而上***
>>>   |**配置名称**|**配置位置**|**配置说明**|
>>>   |--|--|--|
>>>   |*惯例配置*| `thinkphp/convention.php` |---|
>>>   |*应用配置*| `application/config.php` |*如果配置 `CONF_PATH`，相应配置文件位置会发生变化*|
>>>   |*扩展配置*| `application/extra` |*如果配置 `CONF_PATH`，相应配置文件位置会发生变化*|
>>>   |*场景配置*| `application/home.php`|*需要在应用配置中配置 `app_status=>home` ，如果配置 `CONF_PATH`，相应配置文件位置会发生变化*|
>>>   |*模块配置*| `application/模块/config.php` |*如果配置 `CONF_PATH`，相应配置文件位置会发生变化*|
>>>   |*动态配置*|  `\think\Config::set(key, value)` |*在代码中配置，要有第三个参数，配置的作用域*|  
>>>
>>***
>>***2.读取常规配置***
>>>  |**tp语法代码**|**作用**|**说明**|
>>>  |--|--|--|
>>>  |`\think\Config::get()` *或者* `config()`|*读取所有配置*|--|
>>>  |`\think\Config::get('app_status')` *或者* `config('app_status')`|*读取 `app_status` 配置*|--|
>>>  |`\think\Config::get('database.username')` *或者* `config('database.us>name')`|*读取二级(数据库用户名)配置*|--|
>>>  |`\think\Config::has('app_status')` *或者* `config('?app_status')`|*查看 `app_status` 是否存在*|--|
>>>  |`\think\Config::set('app_status', 'home', 'User')` *或者* `config('app_status', 'home', 'User')`|*动态设置 `app_status` 的值, `User` 为作用域，为可选参数*|--|
>>>
>> ***
>>***3.读取环境变量配置***
>>>    |**tp语法代码**|**作用**|**说明**|
>>>    |--|--|--|
>>>    |`\think\Env::get('app_debug', true)`|*获取环境变量中的 `app_debug` 的值，不存在则使用默认值 `true`*|*需要在项目根目录创建 `.env` 文件*|
>>>    |`\think\Env::get('database.username')`| *获取环境变量中二级(数据库用户名)配置*|*需要在项目根目录创建 `.env` 文件*|
>>>
>>>>   **①.环境变量 `.env` 配置单个参数**
>>>>
>>>>          app_debug=true
>>>>  **②.环境变量 `.env` 配置数组参数**   
>>>>
>>>>          database_username=roger
>>>>          database_host=localhost
>>>>  **或者**
>>>>
>>>>          [database]
>>>>          username=roger
>>>>          host=localhost
>>>***

> ## 二.路由
>>***1.thinkphp5的路由分为三种：***
>>>|**配置选项**|**模式名称**|**说明**|
>>>|--|--|--|
>>>|`'url_route_on'=>false`|*默认模式*|*关闭路由，完全使用默认 `path_info` 模式，此时不会解析任何路由规则，访问url：`http://serverName/index.php/module/controller/action/param/value/...`*|
>>>|`'url_route_on'=>true;'url_route_must'=>false`|*混合模式*|*该模式下，已有路由规则的按路由访问，没有路由规则的按 `path_info` 模式访问*|
>>>|`'url_route_on'=>true;'url_route_must'=>true`|*强制模式*|*该模式下，所有的访问都必须有路由规则，否则将抛出异常*|
>>***2.路由规则***
>>>    **①.动态路由注册**
>>>
>>> **路由配置文件默认位置位于 `application/route.php`，如果配置 `CONF_PATH` 之后，则位于 `CONF_PATH` 配置路径之下，配置规则如下：**  
>>>>        use think\Route;
>>>>        Route::rule('detail/:id', 'index/article/detail');     
>>>> * *此时路由注册到 `index` 模块下的 `article `控制器下的 `detail`方法，这时候的url访问为： `http://serverName/detail/5`，这时候会自动路由到 `http://serverName/index/article/detail/id/5`*
>>>
>>> **②.我们可以在rule方法中指定请求的类型，如下：**
>>>>  
>>>>        use think\Route;
>>>>        Route::rule('detail/:id', 'index/article/detail', 'POST');
>>>>
>>>>* *这时候，只有在 `POST` 请求下才有效，等效于：*
>>>>
>>>>        Route::POST('detail/:id', 'index/article/detail');    
>>>> *同理，thinkphp5还提供了不同请求类型定义路由规则的简化方法，如下：*  
>>>>
>>>>        Route::get('new/:id','News/read'); // 定义GET请求路由规则
>>>>        Route::post('new/:id','News/update'); // 定义POST请求路由规则
>>>>        Route::put('new/:id','News/update'); // 定义PUT请求路由规则
>>>>        Route::delete('new/:id','News/delete'); // 定义DELETE请求路由规则
>>>>        Route::any('new/:id','News/read'); // 所有请求都支持的路由规则  
>>>>
>>>> *如果希望多种访问方式有效，配置如下：*
>>>>
>>>>       use think\Route;
>>>>       Route::relue('detail/:id', 'index/article/detail', 'POST|GET');
>>>>
>>>>* *这时候， `POST` 和 `GET` 请求可以同时生效*  
>>>>
>>***3.路由表达式***
>>>  **①.路由表达式统一使用字符串定义，采用规则定义的方式**
>>>
>>> **规则表达式通常包含静态地址和动态地址，或者两种地址的结合，如下：**
>>>>
>>>>        '/' => 'index',                 // 首页访问路由
>>>>        'my'   => 'member/info',        // 静态地址
>>>>        'blog/:id' => 'blog/read',      // 静态和动态结合地址 
>>>>        ':user/:blog_id' => 'blog/read',// 全动态地址 
>>>>
>>> **②.可选定义**
>>>
>>> **支持对路由的可选参数定义，如下：**
>>>>
>>>>        'blog/:year/[:month]' => 'blog/archive';
>>>>  * *`[:month]` 变量用 `[]` 包含起来之后表示该变量是路由匹配的可选变量*
>>>>
>>>  **③.完全匹配**
>>>
>>> **规则匹配的时候只是对url从头开始匹配，只要url地址包含了定义的路由规则就会匹配成功，如果希望完全匹配，可以在路由表达式的最后使用 `$` 符号，如下：**
>>>>
>>>>        'new/:cate$' => 'news/categroy';
>>>>  * *此时，`http://serverName/index.php/new/info`会匹配成功，而`http://serverName/index.php/new/info/2`不会匹配成功*
>>>>
>>>>  *如果你希望所有的路由定义都是完全匹配的话，可以开启配置，如下：*
>>>>
>>>>        'route_complete_match' => true;
>>>>
>>>>  *当开启完全匹配的时候，如果个别的路由不需要使用完全匹配的时候，可以添加路由参数覆盖定义，如下：*
>>>>
>>>>        Route::rule('new/:id','News/read','GET|POST',['complete_match' => false]);
>>>>
>>> **③.额外参数**
>>>
>>> **在路由跳转的时候支持额外传入参数对（额外参数指的是不在URL里面的参数，隐式传入需要的操作中，有时候能够起到一定的安全防护作用）。如下：**
>>>>
>>>>        'blog/:id'=>'blog/read?status=1&app_id=5',
>>>>
>>>> * *此时路由规则定义中额外参数的传值方式都是等效的。 `status` 和 `app_id` 参数都是URL里面不存在的，属于隐式传值，当然并不一定需要用到，只是在需要的时候可以使用。*
>>
>> ***4.批量注册***
>>> **①.批量动态注册**  
>>>
>>> **如果在外面和规则里面同时传入了匹配参数和变量规则的话，路由规则定义里面的最终生效，但请求类型参数以最外层决定，如下：**  
>>>>
>>>>     Route::rule([
>>>>        'new/:id'  =>  'News/read',
>>>>        'blog/:id' =>  ['Blog/update',['ext'=>'shtml'],['id'=>'\d{4}']],
>>>>       ...
>>>>     ],'','GET',['ext'=>'html'],['id'=>'\d+']);
>>>>
>>>>* *以上的路由注册，最终 `blog/:id`只会在匹配 `shtml`后缀的访问请求， `id` 变量的规则则是 `\d{4}`*
>>>>
>>> **②.批量定义路由配置文件**  
>>>
>>> **路由配置文件默认位置位于 `application/route.php`，如果配置 `CONF_PATH` 之后，则位于 `CONF_PATH` 配置路径之下，配置规则如下：**
>>>>        return [
>>>>            'new/:id'   => 'News/read',
>>>>            'blog/:id'   => ['Blog/update',['method' => 'post|put'], ['id' => '\d+']],
>>>>        ];
>>>>
>>> ***`路由动态注册和配置定义的方式可以共存`***  
>>>>
>>  ***5.变量规则***
>>>  **①.全局变量规则**
>>>
>>>  **设置全局变量规则，全局路由有效，如下：**
>>>>        Route::pattern('name','\w+');
>>>>        
>>>>        Route::pattern([
>>>>            'cate'  =>  '\w+',
>>>>            'id'    =>  '\d+',
>>>>        ]);
>>>> * *此时单独为 `name` 设置规则，批量为 `cate` 和 `id` 设置了规则，此时添加的规则对所有路由都有效*
>>>>
>>> **②.局部变量规则**
>>>
>>> **局部变量规则，仅在当前路由有效，如下：**  
>>>>        Route::post('new/:name','News/read',[],['name'=>'\w+']);
>>>> * *此时定义了一个 `POST` 请求规则，并设置 `name` 变量规则， `name` 变量仅在当前访问时有效*
>>>>
>>> ***`如果一个变量同时定义了全局规则和局部规则，局部规则会覆盖全局变量的定义`***
>>>>
>> ***6.路由参数***
>>>
>>> **①.路由参数**
>>>
>>> **是指可以设置一些路由匹配的条件参数，主要用于验证当前的路由规则是否有效，主要包括：**
>>>> |**参数**|**说明**|
>>>> |--|--| 
>>>> |*method*|*请求类型检测，支持多个请求类型*|
>>>> |*ext*|*URL后缀检测，支持匹配多个后缀*|
>>>> |*deny_ext*|*URL禁止后缀检测，支持匹配多个后缀*|
>>>> |*https*|*检测是否https请求*|
>>>> |*domain*|*域名检测*|
>>>> |*before_behavior*|*前置行为（检测）*|
>>>> |*after_behavior*|*后置行为（执行）*|
>>>> |*callback*|*自定义检测方法*|
>>>> |*merge_extra_vars*|*合并额外参数*|
>>>> |*bind_model*|*绑定模型（V5.0.1+）*|
>>>> |*cache*|*请求缓存（V5.0.1+）*|
>>>> |*param_depr*|*路由参数分隔符（V5.0.2+）*|
>>>> |*ajax*|*Ajax检测（V5.0.2+）*|
>>>> |*pjax*|*Pjax检测（V5.0.2+）*|
>>>>
>>> **②.请求类型**
>>>
>>> **如果指定请求类型注册路由的话，无需设置method请求类型参数。如果使用了rule或者any方法注册路由，或者使用路由配置定义文件的话，可以单独使用method参数进行请求类型检测。如下：**
>>>>
>>>>        Route::rule('new/:id','News/read','post|get');
>>>>
>>>>        Route::any('new/:id','News/read',['method'=>'get|post']);
>>>>
>>> **③.URL后缀**
>>>
>>> **1.可以设置单个有效访问后缀，也可以设置多个有效访问后缀。如下：**
>>>>        Route::get('new/:id','News/read',['ext'=>'html']);
>>>>        Route::get('new/:id','News/read',['ext'=>'html|shtml']);
>>> **2.也可以设置禁止访问的URL后缀。如下：**
>>>>        Route::get('new/:id','News/read',['deny_ext'=>'jpg|png|gif']);
>>>>
>>> **④.域名监测**
>>>
>>> **1.支持使用完整域名进行检测，如下：**  
>>>>        Route::get('new/:id','News/read',['domain'=>'news.thinkphp.cn']);
>>> **2.支持使用子域名进行检测，如下：**
>>>>        Route::get('new/:id','News/read',['domain'=>'news']);
>>>>
>>> **⑤.HTTPS检测**
>>>
>>> **支持检测当前是否HTTPS访问，如下：**
>>>>        Route::get('new/:id','News/read',['https'=>true]);
>>>>
>>> **⑥.前置行为检测**  
>>> **⑦.后置行为执行**  
>>> **⑧.Callback检测**  
>>> **⑨.合并额外参数**  
>>> **⑩.配置文件中添加路由参数**  
>>> **①①.路由绑定模型**  
>>> **①②.缓存路由请求**  
>>>
>> ***7.路由地址定义***
>>> **路由地址表示定义的路由表达式最终需要路由到的地址以及一些需要的额外参数，支持下面5种方式定义：**
>>>>|**定义方式**|**定义格式**|
>>>>|--|--|
>>>>|*方式1：路由到模块/控制器*|*[模块/控制器/操作]?额外参数1=值1&额外参数2=值2...*|
>>>>|*方式2：路由到重定向地址*|*外部地址'（默认301重定向） 或者 ['外部地址','重定向代码']*|
>>>>|*方式3：路由到控制器的方法*|*@[模块/控制器/]操作*|
>>>>|*方式4：路由到类的方法*|*\完整的命名空间类::静态方法' 或者 '\完整的命名空间类@动态方法*|
>>>>|*方式5：路由到闭包函数*|*闭包函数定义（支持参数传入）*|

> ## 三.控制器
>> ***1.控制器的定义***
>>> **①.控制器的定义**  
>>>
>>> **控制器的定义比较灵活，可以无需继承任何的基础类，也可以继承官方封装的 `\think\Controller` 类或者其他的控制器类。一个典型的控制器类定义如下：**
>>>>        namespace app\index\controller;
>>>>        class Index {
>>>>            public function index() {
>>>>                return 'index';
>>>>            }
>>>>        }
>>>> * *此时控制器的实际位置位于 `application\index\controller\Index.php`*  
>>>>
>>>>  **命名空间默认以 `app` 为根命名空间。根命名空间可以在配置中修改 `app_namespace` 选项，如下：**  
>>>>
>>>>            'app_namespace' => 'myapp';
>>>> **在典型控制器下，如果需要在控制器里面渲染模板，可以使用系统 `think\View` 类， 如下：**  
>>>>
>>>>        namespace app\index\controller;
>>>>        use think\View;
>>>>        class Index  {
>>>>            public function index() {
>>>>                $view = new View();
>>>>                return $view->fetch('index');
>>>>            }
>>>>        }
>>>>
>>>> **也可以使用系统提供的 `view()` 助手函数渲染模板，如下：**
>>>>
>>>>        namespace app\index\controller;
>>>>        class Index  {
>>>>            public function index()  {
>>>>                return view('index');
>>>>            }
>>>>        }
>>>>
>>>> **如果继承了 `think\Controller`类的话，可以直接调用 `think\View` 及 `think\Request` 类的方法，如下：**
>>>>
>>>>        namespace app\index\controller;
>>>>        use think\Controller;
>>>>        class Index extends Controller {
>>>>            public function index() {
>>>>                // 获取包含域名的完整URL地址
>>>>                $this->assign('domain',$this->request->url(true));
>>>>                return $this->fetch('index');
>>>>            }
>>>>        }
>>> **②.渲染输出**
>>>
>>> **默认情况下，控制器的输出全部采用 `return` 的方式，无需进行任何的手动输出，系统会自动完成渲染内容的输出。如下：**
>>>>        namespace app\index\controller;
>>>>
>>>>        class Index  {
>>>>    
>>>>            public function hello() {
>>>>                return 'hello,world!';
>>>>            }
>>>>            
>>>>            public function json() {
>>>>                return json_encode($data);
>>>>            }
>>>>            
>>>>            public function read() {
>>>>                return view();
>>>>            }
>>>>        
>>>>        }
>>> **③.输出转换**
>>>
>>> **默认情况下，控制器的返回输出不会做任何的数据处理，但可以设置输出格式，并进行自动的数据转换处理，前提是控制器的输出数据必须采用 `return` 的方式返回。控制器定义如下：**
>>>>        namespace app\index\controller;
>>>>        
>>>>        class Index  {
>>>>            
>>>>            public function data() {
>>>>                return ['name'=>'thinkphp','status'=>1];
>>>>            }
>>>>        }
>>>> * *当我们将输出格式设置为 `JSON` 时，设置如下：*
>>>>
>>>>        'default_return_type' => 'json';
>>>> * *当我们访问 `http://localhost/index.php/index/Index/data` 时，输出的结果会显示为：*
>>>>
>>>>        {"name":"thinkphp","status":1}
>>>>
>>>> **`默认情况下，控制器在 `ajax`  请求时会对返回类型自动转换为  `json``**
>>>>
>> ***2.控制器的初始化***
>>>
>>> **如果定义的控制器类继承了 `think\Controller` 类，可以定义控制器初始化方法 `_initialize` ，在控制器方法调用的时候，会首先执行控制器中定义的 `_initialize` 的方法，如下：**
>>>>        namespace app\index\controller;
>>>>        
>>>>        use think\Controller;
>>>>        
>>>>        class Index extends Controller  {
>>>>        
>>>>            public function _initialize() {
>>>>                echo 'init<br/>';
>>>>            }
>>>>            
>>>>            public function hello() {
>>>>                return 'hello';
>>>>            }
>>>>        }
>>>> * *如果访问  `http://localhost/index.php/index/Index/hello` 时，返回结果会输出如下：*  
>>>>
>>>>        init
>>>>        hello   
>>>>
>> ***3.前置操作***     
>>>
>>> **可以为某个或者某些操作指定前置执行的操作方法，设置 `beforeActionList` 属性可以指定某个方法为其他方法的前置操作，数组键名为需要调用的前置方法名，无值的话为当前控制器下所有方法的前置方法。如下：**
>>>>
>>>>        ['except' => '方法名,方法名'];
>>>> * *表示这些方法不使用前置方法*
>>>>
>>>>            ['only' => '方法名,方法名']
>>>> * *表示只有这些方法使用前置方法。具体示例如下：*
>>>>
>>>>        namespace app\index\controller;
>>>>        
>>>>        use think\Controller;
>>>>        
>>>>        class Index extends Controller {
>>>>            protected $beforeActionList = [
>>>>                'first',
>>>>                'second' =>  ['except'=>'hello'],
>>>>                'three'  =>  ['only'=>'hello,data'],
>>>>            ];
>>>>            
>>>>            protected function first() {
>>>>                echo 'first<br/>';
>>>>            }
>>>>            
>>>>            protected function second() {
>>>>                echo 'second<br/>';
>>>>            }
>>>>            
>>>>            protected function three() {
>>>>                echo 'three<br/>';
>>>>            }
>>>>        
>>>>            public function hello() {
>>>>                return 'hello';
>>>>            }
>>>>            
>>>>            public function data() {
>>>>                return 'data';
>>>>            }
>>>>        }
>>>>  * *访问 `http://localhost/index.php/index/Index/hello` 输出结果如下：*
>>>>
>>>>        first
>>>>        three
>>>>        hello
>>>>  * *访问 `http://localhost/index.php/index/Index/data` 输出结果如下：*
>>>>
>>>>        first
>>>>        second
>>>>        three
>>>>        data
>>>>
>> ***4.页面跳转***
>>>
>>> **①.页面跳转**
>>>
>>> **在应用开发中，经常会遇到一些带有提示信息的跳转页面，例如操作成功或者操作错误页面，并且自动跳转到另外一个目标页面。系统的 `\think\Controller` 类内置了两个跳转方法 `success` 和  `error` ，用于页面跳转提示。**
>>>> *1.`success` 方法的默认跳转地址是 `$_SERVER["HTTP_REFERER"]` ， `error` 方法的默认跳转地址是 `javascript:history.back(-1);`。*
>>>>
>>>> *2.`success` 和 `error` 方法都可以对应的模板，默认的设置是两个方法对应的模板都是：*
>>>>
>>>>        THINK_PATH . 'tpl/dispatch_jump.tpl
>>>>>  * *我们可以更改默认模板，默认错误跳转对应的模板文件如下：*
>>>>>
>>>>>        'dispatch_error_tmpl' => APP_PATH . 'tpl/dispatch_jump.tpl',
>>>>> * *默认成功跳转对应的模板文件如下：*
>>>>>
>>>>>        'dispatch_success_tmpl' => APP_PATH . 'tpl/dispatch_jump.tpl',
>>>>> * *也可以使用项目内部的模板文件，如下：*
>>>>>
>>>>>        'dispatch_error_tmpl' => 'public/error',
>>>>>        'dispatch_success_tmpl' => 'public/success',
>>>>
>>> **②.页面重定向**
>>>
>>>> **`\think\Controller` 类的 `redirect`方法可以实现页面的重定向功能。如下：**
>>>>
>>>>        $this->redirect('News/category', ['cate_id' => 2]);
>>>> * *上面的用法是跳转到 `News` 模块的 `category` 操作，重定向后会改变当前的URL地址。*  
>>>> * *也可以用助手函数 `redirect` 实现重定向，如下：*
>>>>
>>>>        redirect('News/category');
>>>>
>> ***5.空操作***
>>> **①.空操作**
>>>
>>> **是指系统在找不到指定的操作方法的时候，会定位到空操作（_empty）方法来执行，利用这个机制，我们可以实现错误页面和一些URL的优化。示例如下：**
>>>>        namespace app\index\controller;
>>>>        
>>>>        class City  {
>>>>            public function _empty($name) {
>>>>                //把所有城市的操作解析到city方法
>>>>                return $this->showCity($name);
>>>>            }
>>>>            
>>>>            //注意 showCity方法 本身是 protected 方法
>>>>            protected function showCity($name) {
>>>>                //和$name这个城市相关的处理
>>>>                 return '当前城市' . $name;
>>>>            }
>>>>        }
>>>>
>>>> * *当我们访问*
>>>>
>>>>        http://serverName/index/city/beijing/
>>>>        http://serverName/index/city/shanghai/
>>>>        http://serverName/index/city/shenzhen/
>>>> * *由于 `City` 并没有定义 `beijing` 、 `shanghai` 或者 `shenzhen` 操作方法，因此系统会定位到空操作方法  `_empty` 中去解析， `_empty` 方法的参数就是当前URL里面的操作名，因此会看到依次输出的结果是：*
>>>>
>>>>        当前城市:beijing
>>>>        当前城市:shanghai
>>>>        当前城市:shenzhen
>>>> 
>> ***6.空控制器***
>>> **①.空控制器**
>>>
>>> **是指当系统找不到指定的控制器名称的时候，系统会尝试定位空控制器(Error)，利用这个机制我们可以用来定制错误页面和进行URL的优化。在 `index` 模块下定义空控制器如下：**
>>>>        namespace app\index\controller;
>>>>        use think\Request;
>>>>        
>>>>        class Error  {
>>>>            public function index(Request $request) {
>>>>                //根据当前控制器名来判断要执行那个城市的操作
>>>>                $cityName = $request->controller();
>>>>                return $this->city($cityName);
>>>>            }
>>>>            
>>>>            //注意 city方法 本身是 protected 方法
>>>>            protected function city($name) {
>>>>                //和$name这个城市相关的处理
>>>>                 return '当前城市' . $name;
>>>>            }
>>>>        }
>>>>
>>>> * *当我们访问*
>>>>
>>>>        http://serverName/index/beijing/
>>>>        http://serverName/index/shanghai/
>>>>        http://serverName/index/shenzhen/
>>>> * *由于系统并不存在 `beijing` 、 `shanghai` 或者 `shenzhen` 控制器，因此会定位到空控制器 `Error`）`去执行，会看到依次输出的结果是：*
>>>>
>>>>        当前城市:beijing
>>>>        当前城市:shanghai
>>>>        当前城市:shenzhen
>>>>        
>>>> ***`空控制器` Error `是可以定义的，如下：`***
>>>>
>>>>        'empty_controller'      => 'MyError';
>>>>
>> ***7.多级控制器***
>>> **`tp5` 支持任意层次级别的控制器，并且支持路由，如下：**
>>>>        namespace app\index\controller\one;
>>>>        use think\Controller;
>>>>        class Blog extends Controller {
>>>>            public function index() {
>>>>                return $this->fetch();
>>>>            }
>>>>            
>>>>            public function add() {
>>>>                return $this->fetch();
>>>>            }
>>>>            
>>>>            public function edit($id) {
>>>>                return $this->fetch();
>>>>            }
>>>>        }
>>>> * *该控制器类的文件位置为： `application/index/controller/one/Blog.php`*
>>>> * *访问地址可以使用： `http://serverName/index.php/index/one.blog/index`*
>>>>
>>>> **`如果要在路由定义中使用多级控制器，可以使用：`**
>>>>
>>>>        \think\Route::get('blog/add','index/one.Blog/add');















