<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * 是否可以控制当前记录
     *
     * @param $user
     * @param $category
     * @return bool
     */
    public function control($user, $category)
    {
        return $category['user_id'] == $user['id'];
    }
}
