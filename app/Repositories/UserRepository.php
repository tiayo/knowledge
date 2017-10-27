<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function update($data, $id)
    {
        return $this->user
            ->where('id', $id)
            ->update($data);
    }

    public function create($data)
    {
        return $this->user
            ->create($data);
    }

    public function get()
    {
        return $this->user
            ->where('id', '>', 0)
            ->orderBy('id', 'desc')
            ->paginate(env('PAGE_NUM'));
    }

    public function destroy($id)
    {
        return $this->user
            ->delete($id);
    }
}