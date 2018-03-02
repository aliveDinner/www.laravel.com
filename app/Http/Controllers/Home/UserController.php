<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\HomeController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends BaseController
{
    public function index(){
        return response()
            ->json(['name' => 'Abigail', 'state' => 'CA','param' => $_REQUEST]);
    }

}
