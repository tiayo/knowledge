<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\KnowledgeService;
use Illuminate\Http\Request;

class KnowledgeController extends Controller
{
    protected $knowledge;
    protected $request;
    protected $category;

    public function __construct(KnowledgeService $knowledge, Request $request, CategoryService $category)
    {
        $this->knowledge = $knowledge;
        $this->request = $request;
        $this->category = $category;
    }

    public function view($id)
    {
        $categories = $this->category->get();

        $knowledge = $this->knowledge->first($id,true);

        //获取最新知识
        $knowledge_latests = $this->knowledge->latest(3);

        //获取本栏目文章
        $knowledge_currents = $this->knowledge->getByCategorySimple(5, $knowledge['category_id'], 'id', 'title');

        return view('knowledge.view', [
            'knowledge' => $knowledge,
            'categories' => $categories,
            'knowledge_latests' => $knowledge_latests,
            'knowledge_currents' => $knowledge_currents
        ]);
    }

    /**
     * 记录列表
     *
     * @param $page [页码]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listView($keyword = null)
    {
        $categorys = $this->category->get();

        $num = config('site.list_num');

        $lists = $this->knowledge->get($num, $keyword);

        return view('knowledge.list', [
            'lists' => $lists,
            'categorys' => $categorys,
        ]);
    }

    /**
     * 根据栏目获取文章
     *
     * @param $category_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categoryView($category_id)
    {
        $categorys = $this->category->get();

        $num = config('site.list_num');

        $lists = $this->knowledge->getByCategory($num, $category_id);

        return view('knowledge.list', [
            'lists' => $lists,
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
        $categorys = $this->category->get();

        return view('knowledge.add_or_update', [
            'old_input' => [],
            'url' => Route('knowledge_add'),
            'sign' => 'add',
            'categorys' => $categorys,
        ]);
    }

    /**
     * 修改管理员视图
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateView($id)
    {
        $categorys = $this->category->get();

        try {
            $old_input =  session('_old_input') ?? $this->knowledge->first($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }

        return view('knowledge.add_or_update', [
            'old_input' => $old_input,
            'url' => Route('knowledge_update', ['id' => $id]),
            'sign' => 'update',
            'categorys' => $categorys,
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
        $this->validate($this->request, [
            'category_id' => 'required|integer',
            'title' => 'required|max:200',
            'content' => 'required',
        ]);

        //执行操作
        $this->knowledge->updateOrCreate($this->request->all(), $id);

        return redirect()->route('knowledge_list');
    }

    /**
     * 删除记录
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        try {
            $this->knowledge->destroy($id);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }

        return redirect()->route('knowledge_list');
    }
}