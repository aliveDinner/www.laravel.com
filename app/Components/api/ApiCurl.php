<?php

namespace App\Components\api;

use App\Components\api\ApiService;

/**
 * Api 加密解密 单例类 适配器模式 ApiCurl
 * Class ApiCrypt
 * @package App\Components\api
 */
class ApiCurl extends ApiService
{

    /**
     * curl 地址
     * @var string
     */
    private $url = 'http://60.205.149.5/index.php';

    /**
     * curl 请求方法
     * @var string
     */
    private $method = 'post';

    /**
     * curl 请求等待时长
     * @var string
     */
    private $timeout = '60';

    /**
     * curl 请求是否返回缓存
     * @var string
     */
    private $returnCookie = false;

    /**
     * curl 请求是否使用证书
     * @var string
     */
    private $CA = false;

    /**
     * curl 证书路径
     * @var string
     */
    private $CAT = './cacert.pem';

    /**
     * curl 请求头
     * @var array
     */
    private $header = [
        'content-type:application/x-www-form-urlencoded;charset=utf-8'
    ];

    /**
     * 密匙
     * @var string
     */
    private $key = 'zl6cUkhltbDXyyqf';

    /**
     * 保存例实例在此属性中
     * @var ApiCurl|ApiCurl
     */
    private static $_instance;

    /**
     * 私有构造函数，防止外界实例化对象
     * ApiCurl constructor.
     * @param array $options
     * @throws \Exception
     */
    private function __construct(array $options = [])
    {
        if (!empty($options) && is_array($options)) {
            foreach ($options as $key => $option) {
                if ($key == 'header') {
                    if (is_array($options)) {
                        $this->header = array_merge($this->header, $options);
                    } elseif (is_string($options)) {
                        $this->header = array_merge($this->header, [$options]);
                    }
                    continue;
                }
                if (property_exists($this, $key) && is_string($option) && !empty($option)) {
                    $this->$key = $option;
                    continue;
                }
            }
        }
    }

    /**
     * 私有克隆函数，防止外办克隆对象
     */
    private function __clone()
    {

    }

    /**
     * 静态方法，单例统一访问入口
     * @param $options
     * @return ApiService|ApiCurl
     */
    public static function getInstance($options = [])
    {
        if (is_null(self::$_instance) || isset (self::$_instance)) {
            $config = require __DIR__ .DIRECTORY_SEPARATOR . 'ApiConfig.php';
            $config = array_merge($config, config('api'));
            $options = array_merge($config['options']['curl'], $options);
            self::$_instance = new self ($options);
        }
        return self::$_instance;
    }

    /**
     * 解密【获取前解密】
     * @param string|array $data
     * @return mixed|string
     */
    public static function getDecrypt($data)
    {
        if (!is_string($data)) {
            $data = '';
        }
        return self::decrypt($data);
    }

    /**
     * 加密【获取前加密】
     * @param string|array $data
     * @return mixed|string
     */
    public static function getEncrypt($data)
    {
        if (!(is_string($data) || is_array($data))) {
            $data = [];
        }
        return self::encrypt(is_string($data) ? $data : self::getContent($data));
    }

    /**
     * @description curl方法
     * @param $url
     * @param array $param
     * @param string $method
     * @param array $header
     * @param int $timeout
     * @param bool $returnCookie
     * @param bool $CA
     * @return mixed
     */
    private static function curl($url, $param = [], $method = 'post', $header = [], $timeout = 60, $returnCookie = false, $CA = false)
    {

        $SSL = substr($url, 0, 8) == "https://" ? true : false;

        if (strtolower($method) == 'get') {
            $newParam = '';
            if (is_array($param)) {
                foreach ($param as $key => $value) {
                    $newParam .= '&' . $key . '=' . $value;
                }
            }
            $param = $newParam;
            if (stristr($url, '?') !== false) {
                $url .= $param;
            } else {
                $url .= '?' . ltrim($newParam, '&');
            }
        }

        $curlPost = $param;
        $ch = curl_init();                                      //初始化curl
        curl_setopt($ch, CURLOPT_URL, $url);                 //抓取指定网页

        if (is_numeric($timeout) && $timeout != '0') {
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout - 2);
        }

        if ($SSL && $CA) {
            $cacert = getcwd() . '/cacert.pem'; //CA根证书
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);   // 只信任CA颁布的证书
            curl_setopt($ch, CURLOPT_CAINFO, $cacert); // CA根证书（用来验证的网站证书是否是CA颁布）
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名，并且是否与提供的主机名匹配
        } else if ($SSL && !$CA) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1); // 检查证书中是否设置域名
        }

        curl_setopt($ch, CURLOPT_HEADER, 0);                    //设置header
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);           // 增加 HTTP Header（头）里的字段
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);            //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Expect:']); //避免data数据过长问题
        if (strtolower($method) == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);  //post提交方式
            curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curlPost)); //data with URLEncode
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);        // 终止从服务端进行验证
        $data = curl_exec($ch);                                 //运行curl

        //var_dump(curl_error($ch));                   //查看报错信息

        curl_close($ch);

        if ($data === false) {//请求失败
            $ret = '';
        } else {
            if ($returnCookie) {
                list($header, $body) = explode("\r\n\r\n", $data, 2);
                preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
                $info['cookie'] = substr($matches[1][0], 1);
                $info['content'] = $body;
                $ret = $info;
            } else {
                $ret = $data;
            }
        }

        return $ret;
    }

    /**
     * 加密【发送前加密】
     * @param string $content
     * @param string $key
     * @param array $header
     * @return mixed|string
     */
    public static function encrypt(string $content = '', string $key = '', array $header = [])
    {
        $instance = self::getInstance();
        $url = $instance->url;
        $param = [
            'type' => 'encrypt',
            'content' => $content,
            'key' => (empty($key) ? $instance->key : $key),
        ];
        $post = 'post';
        $header = array_merge($instance->header, $header);
        return self::curl($url, $param, $post, $header);
    }

    /**
     * 解密【获取前解密】
     * @param string $content
     * @param string $key
     * @param array $header
     * @return mixed|string
     */
    public static function decrypt(string $content = '', string $key = '', array $header = [])
    {
        $instance = self::getInstance();
        $url = $instance->url;
        $param = [
            'type' => 'decrypt',
            'content' => $content,
            'key' => (empty($key) ? $instance->key : $key),
        ];
        $post = 'post';
        $header = array_merge($instance->header, $header);
        return self::curl($url, $param, $post, $header);
    }
}