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
        Schema::create('penerima_zakat', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('perumahan');
            $table->string('blok');
            $table->string('rt');
            $table->string('category'); // fakir, miskin, amil, dll
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima_zakats');
    }
};
