<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    protected $request;

    public function __construct(CategoryService $category, Request $request)
    {
        $this->category = $category;
        $this->request = $request;
    }

    /**
     * 记录列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listView()
    {
        $num = config('site.list_num');

        $categorys = $this->category->get($num);

        return view('category.list', [
            'categorys' => $categorys,
        ]);
    }

    /**
     * 添加管理员视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addView()
    {
        return view('category.add_or_update', [
            'old_input' => $this->request->session()->get('_old_input'),
            'url' => Route('category_add'),
            'sign' => 'add',
        ]);
    }

    /**
     * 修改管理员视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateView($id)
    {
        $old_input = session('_old_input') ?? $this->category->first($id);

        return view('category.add_or_update', [
            'old_input' => $old_input,
            'url' => Route('category_update', ['id' => $id]),
            'sign' => 'update',
        ]);
    }

    /**
     * 添加/更新提交
     *
     * @param null $id
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function post($id = null)
    {
        //初步验证
        $this->validate($this->request, [
            'name' => 'required',
        ]);

        if ($this->category->updateOrCreate($this->request->all(), $id)) {
            return redirect()->route('category_list');
        }

        return response('添加/更新失败！');
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
            $this->category->destroy($id);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), $exception->getCode());
        }

        return redirect()->route('category_list');
    }
}