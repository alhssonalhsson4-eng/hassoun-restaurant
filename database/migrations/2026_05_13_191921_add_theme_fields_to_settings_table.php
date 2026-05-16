<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {

            $table->string('theme_color')->nullable();

            $table->string('button_color')->nullable();

            $table->string('background_color')->nullable();

            $table->string('text_color')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {

            $table->dropColumn([
                'theme_color',
                'button_color',
                'background_color',
                'text_color',
            ]);

        });
    }
};