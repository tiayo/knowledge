<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;

class UserService
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * 提交处理
     *
     * @param $account
     * @return mixed
     */
    public function post($account, $id)
    {
        $data['name'] = $account['name'];
        $data['email'] = $account['email'];

        if (isset($account['password'])) {
            $data['password'] = bcrypt($account['password']);
        } else {
            empty($id) ? $data['password'] = bcrypt('abcd.123') : true;
        }

        return empty($id) ? $this->user->create($data) : $this->user->update($data, $id);
    }

    public function get()
    {
        return $this->user->get();
    }

    /**
     * 通过id验证记录是否存在以及是否有操作权限
     * 通过：返回该记录
     * 否则：抛错
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function validata($id)
    {
        $first = $this->user->find($id);

        throw_if(empty($first), Exception::class, '未找到该记录！', 404);

        throw_if(!can('control', $first), Exception::class, '没有权限！', 403);

        return $first;
    }

    /**
     * 查找指定id的用户
     *
     * @param $id
     * @return mixed
     */
    public function first($id)
    {
        return $this->validata($id);
    }

    /**
     * 删除
     *
     * @param $id
     * @return bool|null
     */
    public function destroy($id)
    {
        //执行删除
        return $this->user->destroy($id);
    }
}