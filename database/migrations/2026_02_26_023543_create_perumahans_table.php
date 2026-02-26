<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('perumahans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nama perumahan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perumahans');
    }
};
