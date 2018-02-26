<?php

use App\Lang\Lang;
use Illuminate\Support\Facades\DB;

if (!function_exists('lang')) {
    /**
     * 获取语言变量值
     * @param string $name 语言变量名
     * @param array $vars 动态变量值
     * @param string $lang 语言
     * @return mixed
     */
    function lang($name, $vars = [], $lang = '')
    {
        return Lang::get($name, $vars, $lang);
    }
}

if (!function_exists('run')) {
    /**
     * 浏览器友好的变量输出
     * @param mixed $var 变量
     * @param boolean $echo 是否输出 默认为true 如果为false 则返回输出字符串
     * @param string $label 标签 默认为空
     * @param integer $flags htmlspecialchars flags
     * @return mixed|string
     */
    function run($var, $echo = true, $label = null, $flags = ENT_SUBSTITUTE)
    {
        $label = (null === $label) ? '' : rtrim($label) . ':';
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
        if (defined('IS_CLI')) {
            $output = PHP_EOL . $label . $output . PHP_EOL;
        } else {
            if (!extension_loaded('xdebug')) {
                $output = htmlspecialchars($output, $flags);
            }
            $output = '<pre>' . $label . $output . '</pre>';
        }
        if ($echo) {
            echo($output);
            return null;
        } else {
            return $output;
        }
    }
}

if (!function_exists('json')) {
    /**
     * 获取 \Illuminate\Http\JsonResponse 对象实例
     * @param mixed $data 返回的数据
     * @param integer $status 状态码
     * @param array $headers 头部
     * @param array $options 参数
     * @return \Illuminate\Http\JsonResponse
     */
    function json($data = [], $status = 200, $headers = [], $options = [])
    {
        return response()->json($data, $status, $headers, $options);
    }
}

if (!function_exists('jsonp')) {
    /**
     * 获取\Illuminate\Http\JsonResponse对象实例
     * @param mixed $data 返回的数据
     * @param integer $status 状态码
     * @param array $headers 头部
     * @param array $options 参数
     * @return \Illuminate\Http\JsonResponse
     */
    function jsonp($data = [], $status = 200, $headers = [], $options = [])
    {
        return response()->jsonp($data, $status, $headers, $options);
    }
}

if (!function_exists('ajax')) {
    /**
     * 获取\Illuminate\Http\JsonResponse对象实例
     * @param mixed $data 返回的数据
     * @param string $type 返回类型
     * @param integer $status 状态码
     * @param array $headers 头部
     * @param array $options 参数
     * @return \Illuminate\Http\JsonResponse
     */
    function ajax($data = [], $type = 'JSON', $status = 200, $headers = [], $options = [])
    {
        if (!empty($headers) && is_array($headers)) {
            foreach ($headers as $key => $header) {
                header($key,$header);
            }
        }
        switch (strtoupper($type)) {
            case 'JSON' :
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                exit(json_encode($data));
            case 'XML'  :
                // 返回xml格式数据
                header('Content-Type:text/xml; charset=utf-8');
                exit(xml_encode($data));
            case 'JSONP':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                $handler = isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
                exit($handler . '(' . json_encode($data) . ');');
            case 'EVAL' :
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                exit($data);
            default: {
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                exit(json_encode($data));
            }
        }
    }
}

if (!function_exists('halt')) {
    /**
     * 调试变量并且中断输出
     * @param mixed $var 调试变量或者信息
     */
    function halt($var)
    {
        run($var);
        exit();
    }
}

if (!function_exists('DBHelper')) {
    /**
     * @param string $method
     * @param null $options
     * @return mixed|\Illuminate\Database\Connection|\Illuminate\Database\Query\Builder
     */
    function DBHelper($method = null,$options = null){
        if (!$method){
            return DB::$method();
        }else{
            return DB::$method($options);
        }
    }
}
