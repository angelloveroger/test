window.onload=function(){ 
/*===================================================javascript数据类型============*/
	// var num = 1;				//int 数字
	// var str = 'abc';			//string  字符串
	// var bool = true;			//boolean  布尔
	// var a = null; 				//null	空
	// var arr1 = [1,2,3,4,5];		//array  数组
	// var arr2 = new Array('hello','kitty');	//array
	// var arr3 = new Array();		//array
	// arr3[1] = 5;
	// arr3[2] = 'hello';
	// arr3[3] = 'world';

/*===================================================javascript运算符============*/
/*算数运算符( + - * / % ++ -- )*/
	// var a = 10;
	// var b = 2;
	//alert(a++);  //10 先赋值，在运算
	//alert(++a);  //11 先运算，在赋值

/*赋值运算符( = += -= *= /= %= )*/

/*比较运算符( > < >= <= == === != !== )*/
	// var a = 5;
	// var b = '5';
	//alert(a==b);    //true  只比较值,!=同理  
	//alert(a===b);	  //false 比较值和类型,!==同理

/*逻辑运算符( && || ! )*/

/*===================================================javascript流程控制============*/
	// var a = 5;
	// var b = 5;
	// var arr = [1,2,3,4,5]; 
/*
分支控制 (if(){}else{}语句; 三元运算符； switch(){}语句)
*/
	//if(a > b){ alert(1); }else{ alert(2); } //2
	//alert(a>b ? 1 : 2); //2
	//switch (a){ case 1:alert(1);break; case 2:alert(2);break; default: alert('其他值'); }  //其他值

/*
循环控制 ( for(){}循环； for/in； while(){}循环；do{}while(){} )
*/
	//for(var i=0; i<arr.length; i++){ alert(arr[i]); }	    	// 1 2 3 4 5
	//var i; for(i in arr ){ alert(arr[i]); }					// 1 2 3 4 5
	//var i=0; while(i < arr.length){ alert(arr[i]); i++; } 	// 1 2 3 4 5 先判断 再执行
	//var i=0; do{ alert(arr[i]); i++; }while(i < arr.length){ }// 1 2 3 4 5 先执行一次 再判断

/*===================================================javascript函数============*/
/*
定义 function functionName(param1, param2){}  调用 functionName(param1, param2);
*/
	//function add(x, y){ return x+y; } alert(add(5,6)); // 11

/*===================================================javascript局部变量，全局变量============*/
/*
函数体外部用var和不用var申明的变量都是全局变量，在任何地方都可以调用；
函数体内部用var申明的变量是局部变量，只有在函数体内部可以调用；
函数体内部不用var申明的变量为全局变量，函数被调用之后，该全局变量生效；
*/

/*===================================================javascript异常捕获============*/
/*
try{代码块}catch(捕获异常){抛出异常}
*/
	//try{ alert(xx); }catch(err){ document.write(err);  //xx is not defined
/*
自定义异常处理机制  throw
*/
	//try{ var yy = ''; if(yy==''){ throw 'yy为空'; } }catch(err){ alert(err); } //yy为空

/*===================================================javascript事件============*/


/*===================================================javascript DOM对象============*/
/* 
DOM 零级事件处理程序
	obj.eventName=functionName/【function(){逻辑处理}】
DOM 二级事件处理程序
	obj.addEventListener(eventName，functionName[，boolean])	添加事件句柄
	obj.removeEvertListener(eventName，functionName)   			移除事件句柄
*/
	// var obj = document.getElementById('inputid');
	// obj.addEventListener('click', doInput); 
	// function doInput(event){
	// 	var objA = document.getElementById('aid');
	// 	objA.innerHTML='网易';				//设置元素html
	// 	objA.href='http://www.163.com';		//设置元素属性
	// 	objA.target='_blank';				//添加元素属性
	// 	objA.style.background='#00ffff';	//设置背景颜色

	// 	alert(event.type);		//获取事件类型
	// 	alert(event.target);    //获取事件目标
	// 	event.stopPropagation();	//阻止事件冒泡
	// 	event.preventDefault();		//阻止默认时间的执行
	// }
	// var objDiv = document.getElementById('divid');
	// objDiv.addEventListener('click', doDiv); 
	// function doDiv(){
	// 	alert('事件冒泡');
	// }
/*
事件冒泡：如果元素绑定事件，事件执行完成后会向上级元素逐级寻找有绑定事件的元素，并执行寻找到的元素绑定的事件
如：id为aid的input元素绑定了点击事件，执行完成之后，它会去寻找他的父级元素div是否有绑定事件，
如果有就执行，执行完毕或者没有就继续寻找上级，一直到顶级document文档
*/


/*===================================================javascript 对象============*/
/*定义：
①：new Object();  
②：{sex:'man', eat:function(){}}
*/
	//var people = new Object(); // 声明对象
	//people.age = 30;			 // 添加对象属性
	//people.eat = function(){}	 // 添加对象方法
	//var people = {sex:'man', eat:function(){}}; //声明对象并添加属性和方法
/*定义：
①：function functionName(){} new functionName();
*/
	// function people(age, eat){
	// 	this.age = age;
	// 	this.eat = eat;
	// }
	// var people = new people(30, function(){});   // 声明变量并创建属性和方法  

/*
string对象
string.length  返回字符串长度
string.toUpperCase()/string.toLowerCase()  将字符串全部转为大写/小写
string.indexOf(findStr[, start]) 字符串findStr在string首次出现的位置，存在返回位置，不存在返回-1，
string.match(findStr)  findStr是否存在于string，存在返回findStr，不存在返回null 
string.replace(findStr, replaceStr) 将字符串string中findStr替换为replaceStr  
string.split(delimiter[, limit]) 字符串string按照delimiter分割为limit个数组 
*/
	//var str = 'abcdefg';
	//alert(str.length);		// 7
	//alert(str.indexOf('c'));	// 2
	//alert(str.match('cd'));		// cd
	//alert(str.replace('fg', 'xy')); // abcdexy
	//alert(str.toUpperCase());   // ABCDEFG
	//var str = 'abcd,efg,hij,klmn';
	//alert(str.split(',', 2)[1]); 	// efg
/*
date对象
定义：new Date();
*/
	//var date = new Date();
	//alert(date.getFullYear()); 		// 2018
	//alert(date.getTime());		// 1545276818819
/*
array对象
arr.length 返回数组arr长度
arr.concat(arr1) 将数组arr1合并到数组arr
arr.sort()   数字排序，默认升序；arr.sort(function(a, b){return b-a})  降序
arr.push(element) 数组arr末尾追加元素element，返回追加之后数组长度   
arr.reverse()  将数组arr反转
*/
	//var arr1 = [1,2,3];
	//var arr2 = ['hello', 'world', 'kitty'];
	//alert(arr2.length);		// 3
	//alert(arr1.concat(arr2)[0]);	// [1, 2, 3, 'hello', 'world'];
	//alert(arr1.sort();		// ['hello', 'kitty', 'world']
	//alert(arr1.push('b'));  	// 4
	//alert(arr1.reverse());		// 3,2,1
/*
Math对象
Math.random()	随机小数
Math.max(int1,int2,int2)  最大值
Math.min(int1,int2,int2)  最小值
Math.abs()				  绝对值
*/
	//alert(Math.random());		// 0.8182527952443517
	//alert(Math.max(1,2,3,5,4,8,5,4)); 	// 8
	//alert(Math.abs(-8));		// 8

/*
DOM obj
getElementById()  根据id获取对象节点
getElementsByName()		根据name获取对象节点
getElementsByTagName() 	根据tagName获取对象节点
obj.getAttribute(attrName)  获取对象obj属性attrName
obj.setAttribute(attrName, value)  设置对象obj属性attrName为value
obj.childNodes  获取obj子节点
obj.parentNode  获取obj父节点
obj.nodeType    获取objobj类型 1：元素节点  2：属性节点
obj.nodeName	获取obj节点名称
document.body.offsetWidth/document.documentElement.offsetWidth    DOM对象宽度
document.body.offsetHeight/document.documentElement.offsetHeight    DOM对象高度
document.createElement(tarName) 创建元素tarName
obj.appendChild(tarName) 往obj末尾插入元素tarName
obj.insertBefore(tarName, node) 往obj对象子节点node前插入元素tarName
obj.removeChild(node) 移除obj中子节点元素node
*/
	//var obj = document.getElementsByName('name');
	//var obj = document.getElementsByTagName('input');
	//var obj = document.getElementById('divid');   // 获取对象节点
	//alert(obj.getAttribute('name'));	    // hello 获取对象name属性 
	//obj.setAttribute('name', 'kitty');	//设置对象name属性
	//alert(obj.childNodes[3].nodeType);	// 1	
	//var obj = document.getElementById("div-2");
	//alert(obj.parentNode.nodeName);		// DIV
	// var input = document.createElement('input'); // DOM对象创建节点
	// input.type='button';		// 设置子节点属性
	// input.value='appendChild创建节点'; // 设置子节点属性
	// obj.appendChild(input);	// 插入子节点
	
	// var obj = document.getElementById("div-2");
	// var input1 = document.createElement('input');	// DOM对象创建节点
	// input1.type='text';		// 设置子节点属性
	// input1.value='insertBefore创建节点';	// 设置子节点属性
	// var obj1 = document.getElementById('div-3');
	// obj.insertBefore(input1, obj1);		// 插入子节点
	
	// var obj = document.getElementById('div-4');
	// obj.removeChild(obj.childNodes[1])	// 移除子节点
	
	//var width = document.documentElement.offsetWidth;		//DOM宽度
	//var height = document.documentElement.offsetHeight;	DOM高度	
	//var width = document.body.offsetWidth;	//DOM宽度
	// var height = document.body.offsetHeight;		//DOM高度
	
/*
WINDOW obj
window.innerWidth  窗口宽度
window.innerHeight 窗口高度
window.open([url, name, features, replace]) 新开窗口
window.close()  关闭窗口
*/
	
/*
计时器
setInterval(闭包函数, 时间间隔)		计时器
clearInterval(计时器)	停止计时器
selTimeout(闭包函数, 延时时间)	延时器
clearTimeout(延时器)	清除延时器   
 */	
	// var obj = document.getElementById('timeData');
	// var timer = setInterval(function (){
	// 	var date = new Date();
	// 	var time = date;	// var time = date.toLocaleTimeString();
	// 	obj.innerHTML=time;
	// }, 1000);	// 设定计时器
	// var obj1 = document.getElementById('stopTime');
	// obj1.addEventListener('click', function(){ clearInterval(timer); });  // 清除计时器
	
	// var delayed = function(){
	// 	timeO = setTimeout(function(){
	// 		alert(1);
	// 		delayed();
	// }, 1500);}	// 设置延时器
	// delayed();
	// var obj = document.getElementById('clearFrame');
	// obj.addEventListener('click', function(){ clearTimeout(timeO); });	//清楚延时器

/*
history obj
history.back()	回退
history.forward()  加载历史列表中的下一个 URL
history.go(number|url)
*/
	// var obj = document.getElementById('hisBack');
	// obj.addEventListener('click', function(){ history.back(); });	// 后退一步

/*
screen obj
screen.availHeight	屏幕可用高度
screen.height 	屏幕高度
screen.availWidth 	屏幕可用宽度
screen.width 	屏幕宽度
*/

/*===================================================javascript 面向对象============*/
/*
定义：
①
*/
	// var people = {
	// 	name: 'roger',
	// 	age: 30,
	// 	eat: function(someThings){
	// 	  return 'eat ' + someThings; 
	// 	}
	// }
	// alert(people.name);	// 调用
/*
定义：
②
*/
	// function People(){}
	// People.prototype = {
	// 	name: 'angel',
	// 	age : 18,
	// 	eat : function(someThings){ return 'eat ' + someThings; }
	// }
	// var p = new People(); alert(p.name);		// 调用
	// (function(){
	// 	function People(){}   // 定义类
	// 	People.prototype.say = function(){ return 'say '; } // 添加类方法
	// 	People.prototype.name = 'roger';  // 添加类属性 
	// 	window.People = People;	// 向外暴露接口，以便调用
	// }());
	// (function(){
	// 	function Girl(){}	// 定义类
	// 	Girl.prototype = new People();	// 继承People 
	// 	var pSay = Girl.prototype.say;	// 零时变量装载父类方法
	// 	Girl.prototype.say = function(){ alert(pSay.call(this)); alert('子类say方法'); }
	// 	window.Girl = Girl; // 向外暴露接口，以便调用
	// }());
	// var girl = new Girl(); 	// 实例化类对象
	// girl.say(); 	// 调用类方法




















}