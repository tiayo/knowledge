<?php

namespace App\Repositories;

use App\Knowledge;
use Illuminate\Support\Facades\Auth;

class KnowledgeRepository
{
    protected $knowledge;
    protected $user;
    protected $redis;
    protected $knowledge_chunk;

    public function __construct(Knowledge $knowledge)
    {
        $this->knowledge = $knowledge;
    }

    public function create($data)
    {
        return $this->knowledge->create($data);
    }

    public function update($id, $data)
    {
        return $this->knowledge
            ->where('id', $id)
            ->update($data);
    }
    
    /**
     * 获取所有显示记录
     *
     * @param $num
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get($num)
    {
        return $this->knowledge
            ->with('users')
            ->with('categories')
            ->orderBy('id', 'desc')
            ->paginate($num);
    }

    public function getByCategory($num, $category_id)
    {
        return $this->knowledge
            ->where('category_id', $category_id)
            ->with('users')
            ->with('categories')
            ->orderBy('id', 'desc')
            ->paginate($num);
    }

    public function getByCategorySimple($num, $category_id, ...$select)
    {
        return $this->knowledge
            ->select($select)
            ->where('category_id', $category_id)
            ->orderBy('id', 'desc')
            ->limit($num)
            ->get();
    }

    /**
     * 获取显示的搜索结果
     *
     * @param $num
     * @param $keyword
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSearch($num, $keyword)
    {
        return $this->knowledge
            ->search($keyword, null, true)
            ->with('users')
            ->with('categories')
            ->paginate($num);
    }

    public function first($id)
    {
        return $this->knowledge
            ->with('users')
            ->with('categories')
            ->find($id);
    }

    public function latest($num)
    {
        return $this->knowledge
            ->select('created_at', 'title', 'id')
            ->orderBy('created_at', 'desc')
            ->limit($num)
            ->get();
    }

    public function destroy($id)
    {
        return $this->knowledge
            ->where('id', $id)
            ->delete();
    }

    public function selectFirst($where, ...$select)
    {
        return $this->knowledge
            ->select($select)
            ->where($where)
            ->first();
    }

    public function count()
    {
        return $this->knowledge->count();
    }
}