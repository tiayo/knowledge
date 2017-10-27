<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('can')) {
    /**
     * 权限验证
     * 全局辅助函数
     *
     * @param $option
     * @param null $class
     * @param string $guard
     * @return mixed
     */
    function can($option, $class = null, $guard = 'web')
    {
        $user = Auth::guard($guard)->user();

        if (empty($user)) return false;

        $class = $class ?? $user;

        return $user->can($option, $class);
    }
}