<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * 判断是否管理员
     *
     * @param $user
     * @param $category
     * @return bool
     */
    public function admin($user, $class)
    {
        return $user['name'] == env('ADMIN_NAME');
    }

    public function control($user, $class)
    {
        return $user['id'] == $class['id'];
    }
}
