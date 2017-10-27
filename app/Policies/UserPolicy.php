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
        return $user['id'] == $class['id'];
    }
}
