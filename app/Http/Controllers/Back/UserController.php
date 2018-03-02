<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\BackController as BaseController;
use App\Models\User;

class UserController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = [];
        $id = rand(2, 1100);
        $num = rand(15, 25);
        $users = DBHelper('table', 'users')->where('id', '>=', $id)->limit($num)->get();
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'position' => $user->position
            ];
        }
        return $this->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $data = [
            'name' => $this->getHelper()->getZhCode(rand(3, 4)),
            'email' => $this->getHelper()->getCode(rand(4, 8)) . '@' . $this->getHelper()->getCode(rand(4, 8)) . '.com',
            'phone' => '1' . rand(100, 999) . rand(1000, 9999) . rand(100, 999),
            'position' => $this->getHelper()->getZhCode(rand(4, 8))
        ];
        $model = User::create($data);
        if (isset($model->id)) {
            $data['id'] = $model->id;
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
        $id = rand(2, 10);
        $user = DBHelper('table', 'users')->find($id);
        if ($user) {
            $data = [
                'id' => rand(1, 99999),
                'name' => $this->getHelper()->getZhCode(rand(3, 4)),
                'email' => $this->getHelper()->getCode(rand(4, 8)) . '@' . $this->getHelper()->getCode(rand(4, 8)) . '.com',
                'phone' => '1' . rand(100, 999) . rand(1000, 9999) . rand(100, 999),
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
        $code = $success > 62 ? '801' : '200';
        $message = $success > 62 ? '删除失败' : '删除成功';
        $data = ['message' => $message, 'code' => $code];
        return $this->json($data);
    }

}
