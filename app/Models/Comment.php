<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'parent_id',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function getChilComment()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function getParComment()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
