<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'is_active',
    ];

    public function images()
    {
        return $this->hasMany(PageImage::class);
    }
}