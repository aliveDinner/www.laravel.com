<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\BackController as BaseController;

class UserController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = [];
        $id = rand(2, 39204);
        $num = rand(15, 25);
        $users = DBHelper('table', 'users')->where('id', '>=', $id)->limit($num)->orderByDesc('id')->get();
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->id,
                'name' => $user->trueName,
                'email' => $user->adminUserName . '@qq.com',
                'contact_number' => preg_match('/\d{11}/', $user->adminUserName) ? $user->adminUserName : '无',
                'position' => $this->getHelper()->getZhCode(rand(4, 8))
            ];
        }
        return $this->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $id = rand(2, 39204);
        $user = DBHelper('table', 'users')->find($id);
        if ($user) {
            $data = [
                'id' => $user->id,
                'name' => $user->trueName,
                'email' => $user->adminUserName . '@qq.com',
                'contact_number' => preg_match('/\d{11}/', $user->adminUserName) ? $user->adminUserName : '无',
                'position' => $this->getHelper()->getZhCode(rand(4, 8))
            ];
        } else {
            $data = ['code' => '10001', 'message' => '添加失败'];
        }
        return $this->json($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $id = rand(2, 39204);
        $user = DBHelper('table', 'users')->find($id);
        if ($user) {
            $data = [
                'id' => $user->id,
                'name' => $user->trueName,
                'email' => $user->adminUserName . '@qq.com',
                'contact_number' => preg_match('/\d{11}/', $user->adminUserName) ? $user->adminUserName : '无',
                'position' => $this->getHelper()->getZhCode(rand(4, 8))
            ];
        } else {
            $data = ['code' => '10001', 'message' => '更新失败'];
        }
        return $this->json($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $success = rand(1, 100);
        $code = $success > 62 ? '10001' : '10000';
        $message = $success > 62 ? '删除失败' : '删除成功';
        $data = ['message' => $message, 'code' => $code];
        return $this->json($data);
    }

}
