<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $request;
    protected $login;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, LoginService $login)
    {
        $this->middleware('guest')->except('logout');
        $this->request = $request;
        $this->login = $login;
    }

    public function username()
    {
        return 'name';
    }

    public function login()
    {
        //验证
        $this->validate($this->request, [
            $this->username() => 'required',
            'password' => 'required|string',
            'code' => 'required|string|size:5',
        ]);

        //错误获取
        $errors = [$this->username() => trans('auth.failed')];

        //获取用户输入
        $username = $this->request->get($this->username());

        $password = $this->request->get('password');

        $code = $this->request->get('code');

        $session_code = $this->request->session()->pull('login_captcha');

        //验证码判断及验证帐号密码
        if ($code != $session_code) {
            $errors = ['code' => '验证码错误！'];
        } else if ($this->login->login($this->username(), $username, $password)) {
            return redirect()->back();
        }

        return redirect()->route('login')
            ->withInput($this->request->only($this->username()))
            ->withErrors($errors);
    }
}
