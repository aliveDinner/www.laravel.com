var app = angular.module('Site', [])
    .constant('Home_URL', 'https://www.laravel.com/pages/index.html')
    .constant('JS_URL', 'https://www.laravel.com/script/')
    .constant('CSS_URL', 'https://www.laravel.com/css/')
    .constant('APP_URL', 'https://www.laravel.com/')
    .constant('M_URL', 'https://m.laravel.com/')
    .constant('B_URL', 'https://cms.laravel.com/')
    .constant('API_URL', 'https://api.laravel.com/')
    .constant('W_URL', 'https://worker.laravel.com/')
    .constant('SUCCESS_CODE', '200')
    ;

function isArray(value) {
    return Object.prototype.toString.call(value) === "[object Array]";
}

function isFunction(value) {
    return Object.prototype.toString.call(value) === "[object Function]";
}

function isRegExp(value) {
    return Object.prototype.toString.call(value) === "[object RegExp]";
}

function isNativeJSON() {
    return window.JSON && Object.prototype.toString.call(JSON) === "[object JSON]";
}

/*
 定义类 时 需要注意 作用域 安全的构造函数
 不安全的因素：由于this是运行时分配，如使用 new 指令实例化类 this会指向 实例化对象；
 如果直接调用构造函数 那么 this 会指向全局 对象 window ，
 然后你的代码就会覆盖window原生的同名函数或属性，埋下bug;
 推荐使用安全方式编写类或函数
 */
function Helper(name) {
    if (this instanceof Helper) {
        this.name = name;
    } else {
        return new Helper(name);
    }
}

// 浏览器兼容函数编写规范
// 使用 call 或 apply 来继承
function X() {
    if (A) {
        A.call(X); // 如果存在A 让 X 继承 A
    } else if (B) {
        B.call(X); // 如果存在B 让 X 继承 B
    } else {
        throw new Error('no A or B');
    }
    return new X();
}

/*
 使用 Object.preventExtensions()  来声明 对象 是 不可扩展对象;
 var person = {name:'wdd'};
 undefined
 Object.preventExtensions(person);
 Object {name: "wdd"}
 person.age = 10;
 10
 person
 Object {name: "wdd"}
 Object.isExtensible(person);
 false
 */

/*
 密封对象 Object.seal 密封对象不可扩展，并且不能删除对象的属性或方法，但是属性值可以修改
 */

/*
 冰冻对象 Object.freeze 冰冻对象不可扩展，并且不能修改，只可访问
 */

/*
 函数节流 思想：某些代码不可以没有间断的连续重复执行 （即反复执行）
 */
var processor = {
    timeoutId: null,
    //实际进行处理的方法
    performProcessing: function () {
        console.log('重复执行中...');
    },
    //初始化调用方法
    process: function () {
        clearTimeout(this.timeoutId);
        var that = this;
        this.timeoutId = setTimeout(function () {
            that.performProcessing();
        }, 100);
    }
};

//尝试开启执行
// processor.process();

/*
 text 转 数组
 */
var toArray = function (data) {
    return eval('(' + data + ')');
};

/**
 * 动态规划求解
 * @param num
 * @returns {number}
 */
// var getClimbingWays = function (num) {
//   if (num<1){
//       return 0;
//   }
//   if (num === 1){
//       return 1;
//   }
//   if (num ===21){
//       return 2;
//   }
//   var a = 1;
//   var b = 2;
//   var temp = 0;
//
//   for(var i=3;i<=num;i++){
//       temp = a + b;
//       a = b;
//       b = temp;
//   }
//
//   return temp;
// };

/*
 中央定时器
 */

var timers = {
    timerId: 0,
    timers: [],
    add: function (fn) {
        this.timers.push(fn);
    },
    start: function () {
        if (this.timerId) {
            return;
        }
        (function runNext() {
            if (timers.timers.length > 0) {
                for (var i = 0; i < timers.timers.length; i++) {
                    if (timers.timers[i]() === false) {
                        timers.timers.splice(i, 1);
                        i--;
                    }
                }
                timers.timerId = setTimeout(runNext, 16);
            }
        })();
    }
};

/*
 AJAX 进度条
 */

function progress() {
    var myXhr = $.ajaxSettings.xhr();
    if (myXhr.upload) {
        myXhr.upload.addEventListener('progress', function (e) {
            if (e.lengthComputable) {
                $('progress').attr({
                    value: e.loaded,
                    max: e.total,
                });
            }
        }, false);
    }
    return myXhr;
}

/*
 AJAX 跨域
 */
function ajaxJump(url, _Callback) {
    $.ajax({
        url: url,
        dataType: 'jsonp',
        processData: false,
        type: 'get',
        jsonpCallback: _Callback,
        success: function (data) {
            console.log(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest.status);
            console.log(XMLHttpRequest.readyState);
            console.log(textStatus);
        }
    });
}
//对字符串处理的方法
String.prototype.trim = function (str) {//删除左右两端的空格
    str = str || "";
    return this.replace(/(^\s*)|(\s*$)/g, '');
};
String.prototype.ltrim = function (str) {//删除左边的空格
    str = str || "";
    return this.replace(/(^\s*)/g, '');
};
String.prototype.rtrim = function (str) {//删除右边的空格
    str = str || "";
    return this.replace(/(\s*$)/g, '');
};