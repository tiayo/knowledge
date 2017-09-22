<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class KnowledgePolicy
{
    use HandlesAuthorization;

    /**
     * 是否可以控制当前记录
     *
     * @param $user
     * @param $knowledge
     * @return bool
     */
    public function control($user, $knowledge)
    {
        return $knowledge['user_id'] == $user['id'];
    }
}
