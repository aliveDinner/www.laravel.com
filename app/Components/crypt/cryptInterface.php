<?php

namespace App\Components\crypt;

/**
 * Interface cryptInterface
 * @package App\Components\crypt
 */
interface CryptInterface
{
    /**
     * 加密
     * @param string $content
     * @param string $key
     * @param bool $isPrivate
     * @return mixed|string
     */
    public static function encrypt(String $content = '', String $key = '', bool $isPrivate = false);

    /**
     * 解密
     * @param string $content
     * @param string $key
     * @param bool $isPrivate
     * @return mixed|string
     */
    public static function decrypt(String $content = '', String $key = '', bool $isPrivate = false);
}