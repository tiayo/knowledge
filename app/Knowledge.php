<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Knowledge extends Model
{
    use SearchableTrait;

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'knowledge.title' => 10,
            'knowledge.content' => 10,
        ],
        'joins' => [
            'categories' => ['categories.id','knowledge.category_id'],
            'users' => ['users.id','knowledge.user_id'],
        ],
    ];

    protected $fillable = [
        'category_id', 'user_id', 'title', 'content',
    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function categories()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
