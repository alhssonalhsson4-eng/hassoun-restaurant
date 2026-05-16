<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rating_options', function (Blueprint $table) {
            $table->id();

            $table->foreignId('rating_category_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('name');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rating_options');
    }
};