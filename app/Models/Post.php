<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const PENDING = 1;
    const APPROVED = 2;
    const REJECT = 3;

    protected $fillable = [
        'title',
        'user_id',
        'slug',
        'images',
        'content',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
