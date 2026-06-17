<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $guarded = [];

    public function posts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_category_blog_post');
    }
}
