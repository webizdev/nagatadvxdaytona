<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('web_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page'); // welcome, about, contact, dealers
            $table->string('section'); // hero, features, story, etc
            $table->string('slug')->unique(); // e.g. home.hero.title
            $table->string('title'); // Label for admin
            $table->longText('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_contents');
    }
};
