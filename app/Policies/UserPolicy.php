<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

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
        foreach (explode(',', env('ADMIN_NAME')) as $name) {
            if ($name == $user['name']) {
                return true;
            }
        }

        return false;
    }

    public function control($user, $class)
    {
        //管理员跳过验证
        if ($this->admin($user, $class)) {
            return true;
        }

        return $user['id'] == $class['id'];
    }
}
