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
        Schema::table('products', function (Blueprint $table) {
            $table->text('features')->nullable()->after('description');
        });

        Schema::table('product_motorcycle', function (Blueprint $table) {
            $table->string('diameter')->nullable()->after('motorcycle_id');
            $table->string('color')->nullable()->after('diameter');
            $table->string('part_number')->nullable()->after('color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('features');
        });

        Schema::table('product_motorcycle', function (Blueprint $table) {
            $table->dropColumn(['diameter', 'color', 'part_number']);
        });
    }
};
