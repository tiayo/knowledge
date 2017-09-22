<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function find($id)
    {
        $this->user->find($id);
    }

    /**
     * 更新操作
     * 只能更新自己
     *
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        return $this->user
            ->where('id', Auth::id())
            ->update($data);
    }
}