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
        Schema::create('infaqs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('pemasukan_manual')->default(0);
            $table->integer('pemasukan_dari_zakat')->default(0);
            $table->integer('total_pemasukan')->default(0);
            $table->string('imam');
            $table->string('kultum');
            $table->string('bilal');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infaqs');
    }
};
