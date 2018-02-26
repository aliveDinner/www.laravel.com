<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait CommonController
{

    protected $_instance;

    /**
     * @return \App\Components\Helper
     */
    public function getHelper()
    {
        $className = 'App\Components\Helper';
        return isset($this->_instance[$className]) ? $this->_instance[$className] : $this->_instance[$className] = \App\Components\Helper::getInstance();
    }

    /**
     * Return a new JSON response from the application.
     *
     * @param  string|array $data
     * @param  string $type
     * @param  int $status
     * @param  array $headers
     * @param  int $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function json($data = [], $type = 'json', $status = 200, array $headers = [], $options = 0)
    {
        $result = [];
        $code = '10000';

        if (isset($data['code'])) {
            $code = (string)(($data['code'] === null || $data['code'] === '' || $data['code'] === true) ? $code : $data['code']);
        }

        $message = ($code !== '10000') ? '失败' : '成功';
        if (isset($data['message'])) {
            $message = (string)(($data['message'] === null || $data['message'] === true) ? $message : $data['message']);
        }

        if (!isset($data['result'])) {
            $ret = [
                'code' => $code,
                'message' => $message,
                'result' => ($code === '10000' ? $data : []),
            ];
        } else {
            $result = ($data['result'] === null || $data['result'] === true) ? $result : $data['result'];
            $ret = [
                'code' => $code,
                'message' => $message,
                'result' => $result,
            ];
        }

        switch (strtoupper($type)) {
            case 'JSON' : // 返回JSON数据格式到客户端 包含状态信息
            {
                return response()
                    ->json($ret, $status, $headers, $options);
            }
                break;
            case 'XML'  : // 返回xml格式数据
            {
                header('Content-Type:text/xml; charset=utf-8');
                exit(xml_encode($ret));
            }
                break;
            case 'JSONP': // 返回JSON数据格式到客户端 包含状态信息
            {
                $callback = '';
                if (isset($data['callback'])) {
                    $callback = ($data['callback'] === null || $data['callback'] === true) ? $data['callback'] : '';
                }
                return response()->jsonp($callback, $ret, $status, $headers, $options);
            }
                break;
            case 'EVAL' : // 返回可执行的js脚本
            {
                header('Content-Type:text/html; charset=utf-8');
                exit($ret);
            }
                break;
            default: {
                // 返回JSON数据格式到客户端 包含状态信息
                return response()
                    ->json($ret, $status, $headers, $options);
            }
                break;
        }
    }

    /**
     * @param string $method
     * @param null $options
     * @return mixed|\Illuminate\Database\Connection|\Illuminate\Database\Query\Builder
     */
    public static function DB($method = null, $options = null)
    {
        if (!$method) {
            return DB::$method();
        } else {
            return DB::$method($options);
        }
    }
}
