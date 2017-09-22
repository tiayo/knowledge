<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Auth;
use Exception;

class CategoryService
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * 获取需要的数据
     *
     * @return mixed
     */
    public function get($num = 10000)
    {
        return $this->category->get($num);
    }

    /**
     * 查找指定id的记录
     *
     * @param $id
     * @return mixed
     */
    public function first($id)
    {
        return $this->category->find($id);
    }

    /**
     * 更新或编辑
     *
     * @param $post
     * @param null $id
     * @return mixed
     */
    public function updateOrCreate($post, $id = null)
    {
        //构造创建数组
        $data['name'] = $post['name'];

        //执行创建
        if (empty($id)) {
            $data['user_id'] = Auth::id();
            return $this->category->create($data);
        }

        //执行更新
        throw_if(!can('control', $this->first($id)), Exception::class, '不是您创建的栏目', 403);

        return $this->category->update($id, $data);
    }

    /**
     * 删除记录
     *
     * @param $id
     * @return bool|null
     */
    public function destroy($id)
    {
        throw_if(!can('control', $this->first($id)), Exception::class, '不是您创建的栏目', 403);

        return $this->category->destroy($id);
    }

    /**
     * 返回所有业务员
     * 限制上限10000条，可以修改
     *
     * @return mixed
     */
    public function getAllSalesman()
    {
        return $this->salesman->get(10000);
    }
}