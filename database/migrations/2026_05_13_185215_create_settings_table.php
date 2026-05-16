<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('restaurant_name_ar')->nullable();
            $table->string('restaurant_name_en')->nullable();

            $table->text('slogan_ar')->nullable();
            $table->text('slogan_en')->nullable();

            $table->string('order_whatsapp')->nullable();
            $table->string('rating_whatsapp')->nullable();

            $table->text('address')->nullable();
            $table->text('map_url')->nullable();

            $table->string('hero_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};