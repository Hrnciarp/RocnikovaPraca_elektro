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
        Schema::create('kategoria_produktov', function (Blueprint $table) {
            $table->integer('kategoria_id')->primary();
            $table->string('nazov');
        });

        DB::table('kategoria_produktov')->insert([
            ['kategoria_id' => 1, 'nazov' => 'Procesory'],
            ['kategoria_id' => 2, 'nazov' => 'Grafické karty'],
            ['kategoria_id' => 3, 'nazov' => 'RAM'],
            ['kategoria_id' => 4, 'nazov' => 'Disk'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoria_produktov');
    }
};
