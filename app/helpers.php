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
    function can($option, $class = null, $guard = '')
    {
        $class = $class ?? Auth::user();

        return Auth::guard($guard)->user()->can($option, $class);
    }
}