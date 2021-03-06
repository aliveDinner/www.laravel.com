<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Components\api\ApiFactory;

trait CommonHelper
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
     * @param string $alias
     * @return \App\Components\api\ApiService|null
     */
    private function getApi($alias = 'api')
    {
        if (!isset($this->_instance[$alias])) {
            $this->_instance[$alias] = ApiFactory::get();
        }
        return $this->_instance[$alias];
    }

    /**
     * @param string|array $data
     * @return string
     */
    public function encrypt($data)
    {
        $api = $this->getApi();
        return $api::getEncrypt(is_string($data) ? $data : $this->getResponseContent($data));
    }

    /**
     * @param string $encode
     * @return mixed|string
     */
    public function decrypt($encode)
    {
        $api = $this->getApi();
        return $api::getDecrypt($encode);
    }

    /**
     * 获取返回数据
     *
     * @param  string|array $data
     * @param  string $type
     * @return string
     */
    public function getResponseContent($data = [], $type = 'json')
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

        $allow_origin = (array)config('api.allow_origin');
        $http = config('api.http');

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
        $origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';

        $allow_origin = config('route.allow_origin');
        $http = config('route.http');

        foreach ($allow_origin as $key => $url){
            $allow_origin[$key] = $http.'://'.$url;
        }

        if(in_array($origin, $allow_origin)){
            header('Access-Control-Allow-Origin:'.$origin);
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
