<?php

namespace App\Services\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginService extends Controller
{
    protected $admin;

    public function __construct()
    {

    }

    public function login($name, $username, $password)
    {
        $credentials = [
            $name => $username,
            'password' => $password,
        ];

        if(!Auth::attempt($credentials)){
            return false;
        }

        return true;
    }

    public function logout()
    {
        return Auth::guard()->logout();
    }
}