<?php

namespace App\Components\api;

error_reporting(0); // 关闭错误报告

use App\Components\api\ApiInterface;

/**
 * Class ApiService
 * @package App\Components\api
 */
abstract class ApiService implements ApiInterface
{

    /**
     * 静态方法，单例统一访问入口
     * @return ApiService|null
     */
    public abstract static function getInstance();

    /**
     * 加密【获取前加密】
     * @param string|array $data
     * @return mixed|string
     */
    public abstract static function getEncrypt($data);

    /**
     * 解密【获取前解密】
     * @param string|array $data
     * @return mixed|string
     */
    public abstract static function getDecrypt($data);

    /**
     * 加密【发送前加密】
     * @param string $content
     * @param string $key
     * @param array $header
     * @return mixed|string
     */
    public static function encrypt(string $content = '', string $key = '', array $header = [])
    {
        return $content;
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
        return $content;
    }

    /**
     * 跨域
     * @param string $origin
     * @param string $http
     * @param array $allow_origin
     * @return mixed|string
     */
    public static function allow(string $origin = '', string $http = '', array $allow_origin = [])
    {
        //跨域
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : $origin;

        foreach ($allow_origin as $key => $url) {
            $allow_origin[$key] = $http . '://' . $url;
        }

        if (in_array($origin, $allow_origin)) {
            header('Access-Control-Allow-Origin:' . $origin);
        }
    }

    /**
     * 设置头格式
     * @param array $header
     */
    public static function setHeader(array $header = [])
    {
        foreach ($header as $key => $value) {
            if (is_string($value)) {
                if (is_numeric($key)) {
                    if (strpos($value, ':')) {
                        header($value);
                    }
                } else {
                    header($key . ':' . $value);
                }
            }
        }
    }

    /**
     * 获取返回数据
     *
     * @param  string|array $data
     * @param  string $type
     * @return string
     */
    public static function getContent($data = [], $type = 'json')
    {
        $result = [];
        $code = '200';

        if (isset($data['code'])) {
            $code = (string)(($data['code'] === null || $data['code'] === '' || $data['code'] === true) ? $code : $data['code']);
        }

        $message = ($code !== '200') ? '失败' : '成功';
        if (isset($data['message'])) {
            $message = (string)(($data['message'] === null || $data['message'] === true) ? $message : $data['message']);
        }

        if (!isset($data['result'])) {
            $ret = [
                'code' => $code,
                'message' => $message,
                'result' => ($code === '200' ? $data : []),
            ];
        } else {
            $result = ($data['result'] === null || $data['result'] === true) ? $result : $data['result'];
            $ret = [
                'code' => $code,
                'message' => $message,
                'result' => $result,
            ];
        }

        if ($code !== '200') {
            $errors = [];
            if (isset($data['errors'])) {
                $errors = ($data['errors'] === null || $data['errors'] === true) ? $errors : $data['errors'];
            }
            $ret['errors'] = $code !== '200' ? $errors : [];
        }

        //跨域
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

        $allow_origin = config('route.allow_origin');
        $http = config('route.http');

        foreach ($allow_origin as $key => $url) {
            $allow_origin[$key] = $http . '://' . $url;
        }

        if (in_array($origin, $allow_origin)) {
            header('Access-Control-Allow-Origin:' . $origin);
        }

        switch (strtoupper($type)) {
            case 'JSON' : // 返回JSON数据格式到客户端 包含状态信息
            {
                return json_encode($ret);
            }
                break;
            case 'XML'  : // 返回xml格式数据
            {
                return xml_encode($ret);
            }
                break;
            case 'JSONP': // 返回JSON数据格式到客户端 包含状态信息
            {
                $callback = '';
                if (isset($data['callback'])) {
                    $callback = ($data['callback'] === null || $data['callback'] === true) ? $data['callback'] : '';
                }
                return $callback . '(' . json_encode($ret) . ');';
            }
                break;
            case 'EVAL' : // 返回可执行的js脚本
            {
                return is_string($data) ? $data : '';
            }
                break;
            default: {
                // 返回JSON数据格式到客户端 包含状态信息
                return json_encode($ret);
            }
                break;
        }
    }
}