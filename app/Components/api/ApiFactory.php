<?php

namespace App\Components\api;

/**
 * Api 加密解密 单例类
 * Class ApiCrypt
 * @package App\Components\api
 *
 * @method
 *
 */
class ApiFactory
{

    /**
     * 默认适配
     * @var string|ApiService
     */
    private $driver = '\App\Components\api\ApiCurl';

    /**
     * 默认别名
     * @var string
     */
    private $alias = 'curl';

    /**
     * 保存例实例在此属性中
     * @var
     */
    private static $_instance;

    /**
     * 私有构造函数，防止外界实例化对象
     * RsaCrypt constructor.
     * @throws \Exception
     */
    private function __construct()
    {

    }

    /**
     * 私有克隆函数，防止外办克隆对象
     */
    private function __clone()
    {

    }

    /**
     * 静态方法，单例统一访问入口 将对象注册到全局的树上
     * @param string $alias
     * @return ApiService|null
     */
    public static function get(string $alias = '')
    {
        if (is_null(self::$_instance) || isset (self::$_instance)) {
            $instance = new self ();
            $config = require __DIR__ . DIRECTORY_SEPARATOR . 'ApiConfig.php';
            $config = array_merge($config, config('api'));
            $driver = isset($config['allow'][$config['driver']]) ? $config['allow'][$config['driver']] : (!empty($config['default']) ? $config['default'] : $instance->driver);
            return self::$_instance[$instance->alias] = $driver::getInstance();
        }
        return isset(self::$_instance[$alias]) ? self::$_instance[$alias] : null;
    }

    /**
     * 将对象注册到全局的树上
     * @param string $alias
     * @param ApiService $object
     * @return ApiFactory|null
     */
    public static function set(string $alias = '', ApiService $object = null)
    {
        self::$_instance[$alias] = $object;//将对象放到树上
    }

    /**
     * 静态方法，单例统一访问入口 移除某个注册到树上的对象。
     * @param string $alias
     * @return ApiFactory|null
     */
    public static function unset(string $alias = '')
    {
        unset(self::$_instance[$alias]);//移除某个注册到树上的对象。
    }

}