<?php

namespace App\Components\crypt;

error_reporting(0); // 关闭错误报告

use App\Components\crypt\CryptInterface;

/**
 * RSA加密解密 单例类
 * Class RsaCrypt
 * @package App\Components\crypt
 */
class RsaCrypt implements CryptInterface
{
    // 公钥和私钥的一些配置
    private $options = [
        'private_key' => '-----BEGIN RSA PRIVATE KEY-----
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
-----END RSA PRIVATE KEY-----',
        'public_key' => '-----BEGIN CERTIFICATE-----
MIIFuDCCA6ACCQD7WSvyK6tMMTANBgkqhkiG9w0BAQsFADCBnTELMAkGA1UEBhMC
Q04xDzANBgNVBAgMBkhhaW5hbjEPMA0GA1UEBwwGSGFpbmFuMRQwEgYDVQQKDAth
bGl2ZURpbm5lcjEUMBIGA1UECwwLYWxpdmVEaW5uZXIxGjAYBgNVBAMMESouYWxp
dmVkaW5uZXIuY29tMSQwIgYJKoZIhvcNAQkBFhVhZG1pbkBhbGl2ZWRpbm5lci5j
b20wHhcNMTcwOTI5MDE0MDAzWhcNMjcwOTI3MDE0MDAzWjCBnTELMAkGA1UEBhMC
Q04xDzANBgNVBAgMBkhhaW5hbjEPMA0GA1UEBwwGSGFpbmFuMRQwEgYDVQQKDAth
bGl2ZURpbm5lcjEUMBIGA1UECwwLYWxpdmVEaW5uZXIxGjAYBgNVBAMMESouYWxp
dmVkaW5uZXIuY29tMSQwIgYJKoZIhvcNAQkBFhVhZG1pbkBhbGl2ZWRpbm5lci5j
b20wggIiMA0GCSqGSIb3DQEBAQUAA4ICDwAwggIKAoICAQDQ8zbze+h5Rx3k2dBR
Bxc3VySxx+MzifptpbWQYcRunDf85TkDoXgYrODy8apsT5f+BxYJ4nbhdKhp79jz
ot6B0DK8QLIiM6ZY5cW04OgpcBcxWUwaLJ90JuTbIFnWYWcIkwnQEtoldgvVG0mR
0lM49WJexWMy7PFbJPK6R8qSr9riBWsWlUKwfJ/b/Z9zTXvHH8DOWX5lIBP7LWV/
5XMTJPLRDbdYVQNKrybqzkkT5q138+QD9TDK2FkJIadvnnj414BY+SwYpRpnf3wT
vP+LbevRrmfsmiY25IdnLP6l/GL3Xl5bGdVs3VRXrIJ3YWoqfmxM/dFjQ9hkUqoF
OczXgX8Vw+7wq3gKeht+bJihjYdEdoi32DwaPsXS+XcEzovxq6oDW5P2iryTqMWW
rm0kwuZfDRZMYtc+zad7xIaxuXOKrWNMK9LPstaRM60kMxijATh2k7I+n4AKoA55
Er7FAAVokw0hTl4DJtjZK1n6fDaBQ1Lec573PPD1WvST4rO73/h4zkUnCRdyx5hf
2cz5AAuihPdwECB0o6TvMl0FfbTx5I+5xf3CUvrMH2QUMbtkGIQ+Ko4PxlWouuCr
1O1uzWTHAdjgHhlql6PqBZg9nNf6iraU8tg+0wvg968k9tqaWBkqA4E7BFtPLDF6
2KcXYafWYEoyV9GZYjC6cJp90QIDAQABMA0GCSqGSIb3DQEBCwUAA4ICAQC2ijbl
bYrnCVaEuw6SxB8yPU3K1Z1Uk+LNhCuRXLZ03muCyZGp2f6gor/hmOLatyko0T05
BpKAyAuW6Ik8QSpkakhfwqYc4hoYpGTSZYiWMFnfaeudDTQcKQzwtnMXP4FhRP8/
ldmfhL9Ykdpx8p3YGac5bEQgRtsG0Y/ogZ4zBGmBP5P2Vr5Hd95ShbdIUD6VpgKi
uUlJ2K5LGjhwWRe/7x913sZHKFzWGvU5P5tgKJqBsmhLpFF/corgmgjECoKH7oky
LEs87WiWlr6mELohTuv53HnLs/0R4eyaitTr4YT292ezKhwfez+HBj0KepqYSGjG
GCzLMgkxoLbmd4peq3knCHZoFaLNejPNhxTr9UqrLXDro9rBto10iy1FPWlu+4fL
6rPtoTfmcYoPXZv8e92ttXVN/DtIdmY0pOFixjvCM6wwRswFssFsr2LN5rciNWgg
WCconeC4ZD/+DnQZE2jTfIVZ/jHa2aauYCUeFYt4hEH6PzJhMIhpGDdiWzIjgZNb
D/ckp/sS1zjxNVEj7/wr4u+qDmpPPDS0lDmXPiujlMiF7k55oWSbKWNmS29/ncga
KLltTFl+XICLS37rifjOb0yEsydUSj4qhjNGLj0U6Kx5940EXJ22dKypbAnKuR5g
wX86RGhNS0iwG7KKliT0kLsCj4yeAveknbZLvg==
-----END CERTIFICATE-----',
    ];

    //额外密匙
    private $pass_key = 'zl6cUkhltbDXyyqf';

    //保存例实例在此属性中
    private static $_instance;

    /**
     * 私有构造函数，防止外界实例化对象
     * RsaCrypt constructor.
     * @param array $options
     * @param string $pass_key
     * @throws \Exception
     */
    private function __construct(array $options = [], string $pass_key = '')
    {
        if (!empty($options) && is_array($options)) {
            $this->options = $options;
        }
        if (!empty($pass_key) && is_string($pass_key)) {
            $this->pass_key = $pass_key;
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
     * @return \App\Components\crypt\RsaCrypt
     */
    public static function getInstance($options = [])
    {
        if (is_null(self::$_instance) || isset (self::$_instance)) {
            self::$_instance = new self ($options);
        }
        return self::$_instance;
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
     * 额外密匙
     * @return mixed
     * @throws \Exception
     */
    private function getPassKey()
    {
        if (empty($this->pass_key)) {
            $this->pass_key = '';
        }
        return $this->pass_key;
    }

    /**
     * 私钥加密
     * @param string $data 要加密的数据
     * @return string 加密后的字符串
     */
    private function privateKeyEncode($data)
    {
        $encrypted = '';
        $private_key = openssl_pkey_get_private(self::getPrivateKey());
        try {
            openssl_private_encrypt($data, $encrypted, $private_key); //私钥加密
            return base64_encode($encrypted); //序列化后base64_encode
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
        $encrypted = '';
        $public_key = openssl_pkey_get_public(self::getPublicKey());
        try {
            openssl_public_encrypt($data, $encrypted, $public_key); //私钥加密
            return base64_encode($encrypted);
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
        $decrypted = '';
        $public_key = openssl_pkey_get_public(self::getPublicKey());
        try {
            openssl_public_decrypt(base64_decode($data), $decrypted, $public_key); //私钥加密的内容通过公钥可用解密出来
            return $decrypted;
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
        $decrypted = '';
        $private_key = openssl_pkey_get_private(self::getPrivateKey());
        try {
            openssl_private_decrypt(base64_decode($data), $decrypted, $private_key); //私钥解密
            return $decrypted;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * 加密
     * @param string $content
     * @param string $key
     * @param bool $isPrivate
     * @return mixed|string
     */
    public static function encrypt(String $content = '', String $key = '', bool $isPrivate = false)
    {
        $rsa = RsaCrypt::getInstance();//实例化单例类
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
     * @param bool $isPrivate
     * @return mixed|string
     */
    public static function decrypt(String $content = '', String $key = '', bool $isPrivate = true)
    {
        $rsa = RsaCrypt::getInstance();//实例化单例类
        if ($isPrivate) {
            //私钥加密， 被解密的是 公钥加密的字符串
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