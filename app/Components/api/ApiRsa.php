<?php

namespace App\Components\api;

use App\Components\api\ApiService;

/**
 * Api 加密解密 单例类 适配器模式 ApiRsa
 * Class ApiCrypt
 * @package App\Components\api
 */
class ApiRsa extends ApiService
{

    /**
     * 一些配置
     * @var array
     */
    private $options = [
        'private_key' => '-----BEGIN RSA PRIVATE KEY-----
MIICXgIBAAKBgQDVHdkah4XPfX4coxOEFm1acet07Ephc3TOt1bpnnx0N7RyCcvf
o5czpEUjDn0kIExpGKUL+txBPY3BT0gCou8tSzfZ2HQFHiYVTbQaMCoralstocig
8C73wfn+fiQo7l2SEM94NXuweRaccEIwxEPeEVbGWGH/a7+FeYKYsj/LXQIDAQAB
AoGBAI98FRvDetgECdCGCzG3V9C5OmnyXPHXpiE3VxDbX7dvedH9voHHxplCVDoS
Gzcjd86ahSTXtUtHghVQp47+3EBL4AEj3EAc1yxzNzrVr7x3dhgswwnWIaZpUtpI
50NcNdXZxEesHBw3rzQ7owpEIiGV2bhZOIKCYRVoqYsllOOBAkEA8UH6VTN7Unnt
sDrqj621T0CGTfJ5OWpuzhyRegu5/ppslGbgserlffIF1lrBeLRjSnODUIbUfUqB
0m/eho491QJBAOIjp78Mn6aLfpsD6FQkclnXhFZk14adkRTD/i3iArlPm8C389qG
UxHppGSfzk+MwR5QUtFcP5ep/3ElOX27M2kCQHn9NIk0WN0hTfBYOhagbRc/tyle
u7EuggyyIVUm7MsyZki7pE4SSixe3li+1ykjfTk+I13qbzNTI0W2zzwWXGkCQQDQ
5ZcDySmBs8KUeBuZ/sETdR7un+DonY1z3UlkIS/a90stz8AX0ZXTKj2OJoFywtdy
pUib1dd4xrUNVBGzr8ZhAkEAszuSTbQZE0QZsPzil2RfAN0gDim0PgDtoujPlb/X
eB7LNbcMH10fdlq1qgCIiEWzDKcmM0Cyv31Q50FuGNKWqQ==
-----END RSA PRIVATE KEY-----',
        'public_key' => '-----BEGIN CERTIFICATE-----
MIICeTCCAeICCQCN1TF34bUQnzANBgkqhkiG9w0BAQsFADCBgDELMAkGA1UEBhMC
Q04xDzANBgNVBAgMBkhhaU5hbjEPMA0GA1UEBwwGSGFpS291MQ8wDQYDVQQKDAZ3
b2ZhbmcxDzANBgNVBAsMBndvZmFuZzEPMA0GA1UEAwwGd29mYW5nMRwwGgYJKoZI
hvcNAQkBFg13b2ZhbmdAcXEuY29tMB4XDTE4MDMwODA1NTM1MloXDTI4MDMwNTA1
NTM1MlowgYAxCzAJBgNVBAYTAkNOMQ8wDQYDVQQIDAZIYWlOYW4xDzANBgNVBAcM
BkhhaUtvdTEPMA0GA1UECgwGd29mYW5nMQ8wDQYDVQQLDAZ3b2ZhbmcxDzANBgNV
BAMMBndvZmFuZzEcMBoGCSqGSIb3DQEJARYNd29mYW5nQHFxLmNvbTCBnzANBgkq
hkiG9w0BAQEFAAOBjQAwgYkCgYEA1R3ZGoeFz31+HKMThBZtWnHrdOxKYXN0zrdW
6Z58dDe0cgnL36OXM6RFIw59JCBMaRilC/rcQT2NwU9IAqLvLUs32dh0BR4mFU20
GjAqK2pbLaHIoPAu98H5/n4kKO5dkhDPeDV7sHkWnHBCMMRD3hFWxlhh/2u/hXmC
mLI/y10CAwEAATANBgkqhkiG9w0BAQsFAAOBgQCFtrbnCxF0itn6peXfMYMBshBt
6E6YghnjQbhYWpiHyaEzw1PHoXdE6arlL3ruB9qBMtfivJG+yAOcseh/0HEhz9cI
jWkYiRvweXhwgXz+GsBuMi6V1AFy6VZ25jS/GRPSCSJN5LY/UckDEIMcsMAIplys
IcgAqv+TvkfhJunu9A==
-----END CERTIFICATE-----',
    ];

    /**
     * 私钥密码
     * @var string
     */
    private $privkeypass = '';

    /**
     * 保存例实例在此属性中
     * @var ApiCurl
     */
    private static $_instance;

    /**
     * 私有构造函数，防止外界实例化对象
     * ApiCurl constructor.
     * @param array $options
     * @param string $privkeypass
     * @throws \Exception
     */
    private function __construct(array $options = [], string $privkeypass = '')
    {
        if (!empty($options) && is_array($options)) {
            $this->options = array_merge($this->options, $options);
        }
        if (!empty($privkeypass) && is_string($privkeypass)) {
            $this->privkeypass = $privkeypass;
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
     * @return ApiRsa
     */
    public static function getInstance($options = [])
    {
        if (is_null(self::$_instance) || isset (self::$_instance)) {
            self::$_instance = new self ($options);
        }
        return self::$_instance;
    }

    /**
     * 解密【获取前解密】私钥解密
     * @param string|array $data
     * @return mixed|string
     */
    public static function getDecrypt($data)
    {
        if (!is_string($data)) {
            $data = '';
        }

        //私钥解密
        $decode = self::decrypt($data, '', [], false);
        if ($decode) {
            $data = $decode;
        } else {
            $data = '';
        }
        return $data;
    }

    /**
     * 加密【获取前加密】公钥加密
     * @param string|array $data
     * @return mixed|string
     */
    public static function getEncrypt($data)
    {
        if (!(is_string($data) || is_array($data))) {
            $data = [];
        }

        //公钥加密
        $decode = self::encrypt(is_string($data) ? $data : self::getContent($data));
        if ($decode) {
            $data = $decode;
        } else {
            $data = '';
        }
        return $data;
    }

    /**
     * 获取私钥内容
     * @return mixed
     * @throws \Exception
     */
    private function getPrivateKey()
    {
        if (empty($this->options['private_key'])) {
            throw new \Exception('私钥为空', 501);
        }
        if (!extension_loaded('openssl')) {
            throw new \Exception('php需要openssl扩展支持', 501);
        }
        return $this->options['private_key'];
    }

    /**
     * 获取公钥内容
     * @return mixed
     * @throws \Exception
     */
    private function getPublicKey()
    {
        if (empty($this->options['public_key'])) {
            throw new \Exception('请配置公钥', 501);
        }
        if (!extension_loaded('openssl')) {
            throw new \Exception('php需要openssl扩展支持', 501);
        }
        return $this->options['public_key'];
    }

    /**
     * 私钥加密
     * @param string $data 要加密的数据
     * @return string 加密后的字符串
     */
    private function privateKeyEncode($data)
    {
        try {
            $encrypt = '';
            $encrypted = '';
            foreach (str_split($data, 117) as $chunk) {
                openssl_private_encrypt($chunk, $encrypted,self::getPrivateKey());//私钥加密
                $encrypt .= $encrypted;
            }
            return base64_encode($encrypt);//序列化后base64_encode
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * 公钥加密
     * @param string $data 要加密的数据
     * @return string 加密后的字符串
     */
    private function publicKeyEncode($data)
    {
        try {
            //公钥加密 , 需要私钥解密
            $encrypt = '';
            $encrypted = '';
            foreach (str_split($data, 117) as $chunk) {
                openssl_public_encrypt($chunk, $encrypted,self::getPublicKey());//公钥加密
                $encrypt .= $encrypted;
            }
            return base64_encode($encrypt);
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * 用公钥解密私钥加密内容
     * @param string $data 要解密的数据
     * @return string 解密后的字符串
     */
    private function decodePrivateEncode($data)
    {
        try {
            $decrypt = '';
            $decrypted = '';
            foreach (str_split(base64_decode($data), 128) as $chunk) {
                openssl_public_decrypt($chunk, $decrypted, self::getPublicKey());//私钥加密的内容通过公钥可用解密出来
                $decrypt .= $decrypted;
            }
            return $decrypt;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * 用私钥解密公钥加密内容
     * @param string $data 要解密的数据
     * @return string 解密后的字符串
     */
    private function decodePublicEncode($data)
    {
        try {
            $decrypt = '';
            $decrypted = '';
            foreach (str_split(base64_decode($data), 128) as $chunk) {
                openssl_private_decrypt($chunk, $decrypted, self::getPrivateKey());//私钥解密
                $decrypt .= $decrypted;
            }
            return $decrypt;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * 加密
     * @param string $content
     * @param string $key
     * @param array $header
     * @param bool $isPrivate
     * @return mixed|string
     */
    public static function encrypt(string $content = '', string $key = '', array $header = [], bool $isPrivate = false)
    {
        $rsa = ApiRsa::getInstance();//实例化单例类
        if ($isPrivate) {
            //私钥加密 , 需要公钥解密
            $encode = $rsa->privateKeyEncode($content);
        } else {
            //公钥加密 , 需要私钥解密
            $encode = $rsa->publicKeyEncode($content);
        }
        $ret = '';
        if (!empty($encode)) {
            $ret = $encode;
        }
        return $ret;
    }

    /**
     * 解密
     * @param string $content
     * @param string $key
     * @param array $header
     * @param bool $isPrivate
     * @return mixed|string
     */
    public static function decrypt(string $content = '', string $key = '', array $header = [], bool $isPrivate = false)
    {
        $rsa = ApiRsa::getInstance();//实例化单例类
        if ($isPrivate) {
            //私钥解密， 被解密的是 公钥加密的字符串
            $decode = $rsa->decodePrivateEncode($content);
        } else {
            //公钥解密， 被解密的是 私钥加密的字符串
            $decode = $rsa->decodePublicEncode($content);
        }
        $ret = '';
        if (!empty($decode)) {
            $ret = $decode;
        }
        return $ret;
    }
}