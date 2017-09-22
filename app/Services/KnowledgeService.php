<?php

namespace App\Services;

use App\Repositories\KnowledgeRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class KnowledgeService
{
    protected $knowledge;
    protected $customer;

    public function __construct(KnowledgeRepository $knowledge)
    {
        $this->knowledge = $knowledge;
    }

    /**
     * 通过id验证记录是否存在以及是否有操作权限
     * 通过：返回该记录
     * 否则：抛错
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function validata($id)
    {
        $knowledge = $this->knowledge->first($id);

        throw_if(empty($knowledge), Exception::class, '未找到该记录！', 404);

        throw_if(!can('control', $knowledge), Exception::class, '没有权限！', 403);

        return $knowledge;
    }

    /**
     * 获取需要的数据
     *
     * @return mixed
     */
    public function get($num, $keyword = null)
    {
        if (!empty($keyword)) {
            return $this->knowledge->getSearch($num, $keyword);
        }

        return $this->knowledge->get($num);
    }

    /**
     * 根据栏目获取需要的数据（分页）
     *
     * @param $num
     * @param $category_id
     * @return mixed
     */
    public function getByCategory($num, $category_id)
    {
        return $this->knowledge->getByCategory($num, $category_id);
    }

    /**
     * 根据栏目获取需要的数据(不分页)
     *
     * @param $num
     * @param $category_id
     * @return mixed
     */
    public function getByCategorySimple($num, $category_id, ...$select)
    {
        return $this->knowledge->getByCategorySimple($num, $category_id, ...$select);
    }

    /**
     * 查找指定id的用户
     *
     * @param $id
     * @return mixed
     */
    public function first($id)
    {
        //获取当前客户
        return $this->validata($id);
    }

    /**
     * 获取指定条数最新记录
     *
     * @param $num
     * @return mixed
     */
    public function latest($num)
    {
        return $this->knowledge->latest($num);
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
        $data['content'] = $post['content'];
        $data['title'] = $post['title'];
        $data['category_id'] = $post['category_id'];

        if (empty($id)) {
            //构造数据
            $data['user_id'] = Auth::id();

            return $this->knowledge->create($data);
        }

        //验证是否可以操作当前记录
        $this->validata($id);
        
        //执行操作
        return $this->knowledge->update($id, $data);
    }

    /**
     * 删除管理员
     *
     * @param $id
     * @return bool|null
     */
    public function destroy($id)
    {
        //验证是否可以操作当前记录
        $this->validata($id)->toArray();

        //执行删除
        return $this->knowledge->destroy($id);
    }

    /**
     * 统计记录总数
     *
     * @return mixed
     */
    public function count()
    {
        return $this->knowledge->count();
    }
}
