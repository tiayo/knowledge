<?php

namespace App\Services;

use App\Repositories\UserRepository;

class AccountService
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
    public function post($account)
    {
        $data['name'] = $account['name'];
        $data['email'] = $account['email'];

        if (isset($account['password'])) {
            $data['password'] = bcrypt($account['password']);
        }

        return $this->user->update($data);
    }
}