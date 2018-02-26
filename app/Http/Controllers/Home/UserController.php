<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\HomeController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends BaseController
{
    public function index(){
        return response()
            ->json(['name' => 'Abigail', 'state' => 'CA','param' => $_REQUEST])
            ->header('Access-Control-Allow-Origin', 'https://www.boom.com,https://api.boom.com,https://cms.boom.com,https://m.boom.com,https://worker.boom.com');
    }

}
