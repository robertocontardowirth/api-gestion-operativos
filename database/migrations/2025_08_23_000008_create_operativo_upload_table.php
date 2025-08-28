<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('operativo_upload', function (Blueprint $table) {
            $table->foreignId('operativo_id')->constrained('operativos')->cascadeOnDelete();
            $table->foreignId('upload_id')->constrained('uploads')->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['operativo_id','upload_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operativo_upload');
    }
};
