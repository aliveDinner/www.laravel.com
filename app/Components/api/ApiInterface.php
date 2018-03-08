<?php

namespace App\Components\api;

/**
 * Interface ApiInterface
 * @package App\Components\api
 */
interface ApiInterface
{
    /**
     * 加密
     * @param string $content
     * @param string $key
     * @param array $header
     * @return mixed|string
     */
    public static function encrypt(string $content = '', string $key = '', array $header = []);

    /**
     * 解密
     * @param string $content
     * @param string $key
     * @param array $header
     * @return mixed|string
     */
    public static function decrypt(string $content = '', string $key = '', array $header = []);
}