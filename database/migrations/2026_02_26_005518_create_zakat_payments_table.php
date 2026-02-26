<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('zakat_payments', function (Blueprint $table) {
            $table->id();

            // Relasi user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Relasi muzakki (optional)
            $table->foreignId('muzakki_id')->nullable()->constrained()->onDelete('set null');

            // Relasi zakat type
            $table->foreignId('zakat_type_id')->constrained()->onDelete('cascade');

            // Relasi rice type (optional)
            $table->foreignId('rice_type_id')->nullable()->constrained()->onDelete('set null');

            // Nama muzakki manual
            $table->string('nama_muzakki');

            // Foreign key ke perumahans dan rts
            $table->foreignId('perumahan_id')->nullable()->constrained('perumahans')->onDelete('set null');
            $table->foreignId('rt_id')->nullable()->constrained('rts')->onDelete('set null');

            $table->string('blok')->nullable();
            $table->string('phone')->nullable();

            $table->unsignedInteger('jumlah_jiwa')->default(0);
            $table->enum('metode_pembayaran', ['tunai', 'beras']);
            $table->unsignedBigInteger('bayar')->default(0);
            $table->unsignedBigInteger('infaq')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zakat_payments');
    }
};
