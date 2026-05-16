<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingOption extends Model
{
    protected $fillable = [
        'rating_category_id',
        'name',
    ];

    public function category()
    {
        return $this->belongsTo(RatingCategory::class, 'rating_category_id');
    }
}