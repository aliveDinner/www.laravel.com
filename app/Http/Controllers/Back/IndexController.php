<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\BackController as BaseController;

class IndexController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return view('index');
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function loan()
    {
        return view('back.loan');
    }

    public function crypt()
    {
        $str = [];
        for ($i = 0; $i < 10; $i++) {
            $str[] = '123456';
        }
        $encode = $this->encrypt($str);
        dump($encode);
        $encode = $this->decrypt($encode);
        dump($encode);
    }
}
