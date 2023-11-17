<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_comment', 'is_like', 'user_id', 'blog_id', 'comment_id', 'is_blog'
    ];
}
