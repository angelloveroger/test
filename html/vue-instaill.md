

> ### 1.初始化项目
>>      npm init -y      
> ---
> ### 2.安装 ``JQuery``
>>      npm install jquery -S
>> - *该方式为最新版本安装*
>> ---
>> - `-S` 将包安装到 `dependencies` 下，即生产环境依赖包，部署生产环境时候会打包该依赖包
>> ---
>> - *`jquery` 模块安装完成之后 我们需要在 `index.js` 文件中 以 `ES6` 的语法引入 `jquery` ，具体如下：*
>>>      import $ from 'jquery'; 
> ---
> ### 3.安装 ``webpack``                       
>>      npm install webpack@5.42.1 webpack-cli@4.7.2 -D
>> - *该方式为指定版本安装*
>> ---
>>      npm install webpack webpack-cli -D
>> - *该方式为最新版本安装*
>> ---
>> - `-D` 将包安装到 `devDependencies` 下，即开发环境依赖包，部署生产环境的时候不会打包该依赖包
> ---       
> ### 4.项目根目录创建 `webpack.config.js` 并配置如下：
>>      module.exports = {
>>          mode: 'development'
>>      }
> ---
> ### 5.配置项目根目录 `package.json` 下 `scripts` 选项，新增一项（`"dev":"webpack"`）
>>      "scripts": {
>>          "dev": "webpack"
>>        }
> ---
> ### 6.运行 `webpack` 进行项目打包
>>      npm run dev
>> - `dev` 为上一步配置中的键名，可以更改其他名字     
>> ---  
>> - *默认情况下 手动运行打包脚本 打包的文件为：`./src/index.js` 打包之后文件保存路径为：`./dist/main.js` 如果需要指定打包文件和打包后文件名及保存路径 需要配置 `webpack.config.js` 配置如下：*
>>>      const path = require('path');
>>>      module.exports = {
>>>          mode: 'development',
>>>          entry: path.join(__dirname, './src/index.js'),
>>>          output: {
>>>              path: path.join(__dirname, './dist/'),
>>>              filename: 'hundle.js'
>>>          }
>>>      }
> ---
> ### 7.安装 `webpack-dev-server`     
> - *项目每一次修改都需要手动运行打包(`npm run dev`)才可预览效果 所以为方便开发 需要保存项目即可以自动打包 需要安装webpack插件*        
>>      npm install webpack-dev-server@3.11.2 -D
>> - *该方式为指定版本安装*         
>> ---
>>      npm install webpack-dev-server -D
>> - *该方式为最新版本安装*
>> ---
>>  - *安装完成之后 需要对 `package.json` 下 `scripts` 中 `dev`项进行配置（`"dev":"webpack serve"`） 配置完成后 启动服务之后会 插件会实时监听代码变动 每次变动 都会自动打包 这时候需要启用 `http` 协议来查看页面 而不是 `file` 协议查看*          
>>>      "scripts": {
>>>          "dev": "webpack serve"
>>>        } 
>> - *安装完成之后 再运行*
>>>     npm run dev
> ---
> ### 8.安装 `html-webpack-plugin`
> - *项目安装 `webpack-dev-server` 之后 每次http协议进入项目 都不是在项目根目录 而是需要进入 `src/index.html` 访问路径为：`localhost:8080/src/xxx.html` 如果需要访问到根目录就可以看到页面效果 需要安装该插件*       
>>      npm install html-webpack-plugin@5.3.2 -D        
> - *该方式为指定版本安装* 
> ---
>>      npm install html-webpack-plugin -D      
> - *该方式为最新版本安装*
> ---
>> - *安装完成之后需要在 `webpack.config.js` 中进行配置 具体操作如下：* 
>> - *1.导入 `html-webpack-plugin` 插件得到一个构造函数 `HtmlPlugin`* 
>> - *2.实例化导入的插件得到一个实例 `htmlPlugin`* 
>> - *3.将实例化的插件挂载到 `webpack` 中*
>> - *最终得到的 `webpack.config.js` 文件如下：*
>>>      const path = require('path');
>>>      const HtmlPlugin = require('html-webpack-plugin');
>>>      const htmlPlugin = new HtmlPlugin({
>>>         template: "./src/index.html",
>>>         filename: "./index.html"
>>>      });
>>>      module.exports = {
>>>          mode: 'development',
>>>          entry: path.join(__dirname, './src/index.js'),
>>>          output: {
>>>              path: path.join(__dirname, './dist/'),
>>>              filename: 'hundle.js'
>>>          },
>>>          plugins: [htmlPlugin]
>>>      }      
>> - *安装完成后 运行脚本*
>>>     npm run dev
>> ---
>> - *如果想要每次运行项目之后 web页面能够自己打开 而且可以选择用ip访问 并指定访问端口号 具体需要在 `webpack.config.js` 中 `mode` 同级新增配置如下：*
>>>     devServer: {
>>>         open: true,
>>>         host: '127.0.0.1',
>>>         port: 8888
>>>     }
> ---
> ### 9.安装 `css-loader`
> - *`webpack` 只能打包 `.js` 类型文件  所以 对于项目中的样式文件(`.css`) 我们需要引入 `css-loader` 模块来 `webpack` 对其进行打包*
>>     npm i style-loader@3.0.0 css-loader@5.2.6 -D        
>> - *该方式为指定版本安装*
>> ---
>>>     npm i style-loader css-loader -D        
>> - *该方式为最新版本安装*        
>> ---
>> - *安装完成之后* 
>> - *1.我们需要在 `index.js` 中以 `ES6` 语法将样式(`.js`)文件当作模块包引入到项目中 如下：*       
>>>     import './src/index.css';
>> - *2.然后在 `webpack.config.js` 中 `mode` 同级新增配置如下：*
>>>     module: {
>>>        rules: [
>>>            {test: /\.css$/, use:['style-loader', 'css-loader']}
>>>        ]    
>>>     }      
> ---
> ### 10.安装 `less-loader`
> - *安装 `less-loader` 让 `webpack` 对 `.less` 文件打包*
>>     npm i less-loader@10.0.1 less@4.1.1 -D      
>> - *该方式为指定版本安装*
>> ---
>>     npm i less-loader less -D       
>> - *该方式为最新版本安装*
>> --- 
>> - *安装完成后 需要在 `webpack.config.js` 中 `mode` 同级新增配置 最终 `module` 块配置如下：*
>>>     module: {
>>>        rules: [
>>>            {test: /\.css$/, use: ['style-loader', 'css-loader']},
>>>            {test: /\.less$/, use: ['style-loader', 'css-loader', 'less-loader']}
>>>        ]    
>>>     }  
> ---
> ### 11.安装 `url-loader`
> - *安装 `url-loader` 让 `webpack` 对资源型文件打包*
>>     npm i url-loader@4.1.1 file-loader@6.2.0 -D      
>> - *该方式为指定版本安装*
>> ---
>>     npm i url-loader file-loader -D       
>> - *该方式为最新版本安装*
>> --- 
>> - *安装完成后 需要在 `webpack.config.js` 中 `mode` 同级新增配置 最终 `module` 块配置如下：*
>>>     module: {
>>>        rules: [
>>>            {test: /\.css$/, use: ['style-loader', 'css-loader']},
>>>            {test: /\.less$/, use: ['style-loader', 'css-loader', 'less-loader']}
>>>            {test: /\.jpg|png|gif$/, use: ['url-loader']}
>>>        ]    
>>>     }  
> ### 12.安装 `babel-loader`
> - *安装 `babel-loader` 让 `webpack` 对高级JS语法代码打包*
>>     npm i babel-loader@8.2.2 @babel/core@7.14.6 @babel/plugin-proposal-decorators@7.14.5 -D      
>> - *该方式为指定版本安装*
>> ---
>>     npm i babel-loader @babel/core @babel/plugin-proposal-decorators -D       
>> - *该方式为最新版本安装*
>> --- 
>> - *1.安装完成后 需要在 `webpack.config.js` 中 `mode` 同级新增配置 最终 `module` 块配置如下：*
>>>     module: {
>>>
>>>        rules: [
>>>            {test: /\.css$/, use: ['style-loader', 'css-loader']},
>>>            {test: /\.less$/, use: ['style-loader', 'css-loader', 'less-loader']}
>>>            {test: /\.jpg|png|gif$/, use: ['url-loader']},
>>>            {test: /\.js$/, use: ['babel-loader], exclude: /node-modules/}
>>>        ]    
>>>     } 
>> - 2.*再在项目根目录创建 `babel-config.js` 配置如下：*   
>>>     
>>>       module.exports = {
>>>         plugins: [
>>>             ['@babel/plugin-proposal-decorators', {legacy: true}]
>>>         ]
>>>       } 
> ---
> ### 13.项目上线
> - *项目开发完成之后 需要对项目进行打包上线 这时候只需要在 `webpack.json` 下 `scripts` 新增配置即可 最终得到 `scripts` 如下：*
>>      "scripts"： {
>>          "dev": "webpack serve",
>>          "go": "webpack --mode production"
>>      }
>> ---
>> - *配置完成之后  只需执行*
>>>     npm run go
>> ---     
> ### 14.安装 `clean-webpack-plugin`
> - *项目上线打包的时候能够自动移除 `dist` 文件夹*
>>      npm install clean-webpack-plugin 
>> - *然后在 `webpack.config.js`配置*
>>>     const {CleanWebpackPlugin} = require('clean-webpack-plugin');
>>>     plugins: [new new CleanWebpackPlugin()]  
>> ---


|标识|语法|名称|说明|
|:-:|:-:|:-:|:-:|
|v-text|v-text='user'|数据绑定/内容输出|`user` 为数据key|
|v-html|v-html='html'|数据绑定/html输出|`html` 值为：`<span style="color: red;">html解析渲染</span>`|
|{{}}|{{user}}|数据绑定/插值输入|`user` 为数据key|   
|v-bind|v-bind:title='title'|属性绑定(`:`)|可简写为 `:title='title'`| 
|v-on|v-on:click='cleanInput'|事件绑定(`@`)|可简写为 `@click='cleanInput'`|
|.prevent .stop|@click.stop='claanInput'|事件修饰符|`.prevent` 阻止默认属性 `.stop` 阻止事件冒泡|
|.esc .enter|@keyup.enter='submit'|按键修饰符|`.esc` `.enter`|      
|v-model|v-model.lazy='name'|双向绑定|`v-model` 专有修饰符 `.number` `.trim` `.lazy`|
|v-if| v-else-if v-else|条件渲染|条件为假时 直接不渲染html元素|
|v-show||条件渲染|条件为假时 只是通过 `display` 属性隐藏了html元素|
|v-for|v-for='(user, index) in users'|列表渲染 搭配 `:key`|`:key` 需要指定唯一 一般使用 id|








# 常用合集
>> ***npm淘宝镜像cnpm的安装***
>>>
>>>     npm install -g cnpm --registry=http://registry.npm.taobao.org
>>>
>> ***vue-cli脚手架构建工具安装***
>>>
>>>     cnpm install vue-cli
>>>
>> ***创建一个基于webpack的名为fiistVue的项目***
>>>
>>>     vue init webpack firstVue
