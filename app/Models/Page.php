<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'meta_data',
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'meta_data' => 'json',  // Changed from 'array' to 'json'
        'is_published' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}