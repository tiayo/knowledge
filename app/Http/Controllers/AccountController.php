<?php

namespace App\Http\Controllers;

use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    protected $account;
    protected $request;

    public function __construct(AccountService $account, Request $request)
    {
        $this->account = $account;
        $this->request = $request;
    }

    /**
     * 修改页面视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        $old_input = $this->request->session()->get('_old_input') ?? Auth::user();

        return view('account.account', [
            'old_input' => $old_input,
        ]);
    }

    public function post()
    {
        $this->validate($this->request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'min:6',
        ]);

        //成功跳转并带成功标志
        if ($this->account->post($this->request->all())) {
            return redirect()->route('account')->with('result', 'succeed');
        }

        //失败跳转并带失败标志
        return redirect()->route('account')->with('result', 'failed')->withInput();
    }
}