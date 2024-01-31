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
        Schema::create('produkty', function (Blueprint $table) {
            $table->bigIncrements('produkt_id');
            $table->integer('kategoria_id');
            $table->longText('nazov');
            $table->decimal('cena', 5, 2);
            $table->integer('star_rating');
            $table->string('cesta_obrazok');

            $table->timestamps();

            $table->foreign('kategoria_id')->references('kategoria_id')->on('kategoria_produktov');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produkty');
    }
};
