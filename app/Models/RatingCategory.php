<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingCategory extends Model
{
    protected $fillable = [
        'name',
        'icon',
    ];

    public function options()
    {
        return $this->hasMany(RatingOption::class);
    }
}