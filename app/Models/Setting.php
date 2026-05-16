<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [

        'restaurant_name_ar',
        'restaurant_name_en',

        'slogan_ar',
        'slogan_en',

        'order_whatsapp',
        'rating_whatsapp',

        'address',
        'map_url',

        'hero_image',

        'theme_color',
        'button_color',
        'background_color',
        'text_color',

        'ai_context',

        'printer_ip',
        'printer_port',

    ];
}