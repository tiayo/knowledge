<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function create($data)
    {
        return $this->category->create($data);
    }

    public function update($id, $data)
    {
        return $this->category
            ->where('id', $id)
            ->update($data);
    }

    public function destroy($id)
    {
        return $this->category
            ->where('id', $id)
            ->delete();
    }

    public function find($id)
    {
        return $this->category->find($id);
    }

    public function get($num)
    {
        return $this->category
            ->join('users', 'categories.user_id', 'users.id')
            ->select('categories.*', 'users.name as user_name')
            ->paginate($num);
    }

    public function selectFirst($where, ...$select)
    {
        return $this->category
            ->select($select)
            ->where($where)
            ->first();
    }
}