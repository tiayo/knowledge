<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $user;
    protected $request;

    public function __construct(UserService $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    public function listView()
    {
        $users = can('admin') ? $this->user->get() : [Auth::user()];

        return view('user.list', [
            'lists' => $users,
        ]);
    }

    /**
     * 新增
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addView()
    {
        $old_input = $this->request->session()->get('_old_input');

        return view('user.add_or_update', [
            'old_input' => $old_input,
            'post' => route('user_add'),
            'sign' => 'add',
        ]);
    }

    /**
     * 修改
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateView($id)
    {
        $old_input = $this->request->session()->get('_old_input') ?? $this->user->first($id);

        return view('user.add_or_update', [
            'old_input' => $old_input,
            'post' => route('user_update', ['user_id' => $id]),
            'sign' => 'update',
        ]);
    }

    /**
     * 提交
     *
     * @param null $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function post($id = null)
    {
        $this->validate($this->request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'min:6',
        ]);

        //添加时操作
        if (empty($id)) {
            $this->validate($this->request, [
                'email' => 'unique:users',
                'name' => 'unique:users',
            ]);
        }

        try {
            $this->user->post($this->request->all(), $id);
        }catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('user_list');
    }

    /**
     * 删除记录
     *
     * @param $id
     * @return bool|null
     */
    public function destroy($id)
    {
        try {
            $this->user->destroy($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        return redirect()->route('category_list');
    }
}