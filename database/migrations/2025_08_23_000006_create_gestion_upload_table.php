<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gestion_upload', function (Blueprint $table) {
            $table->foreignId('gestion_id')->constrained('gestiones')->cascadeOnDelete();
            $table->foreignId('upload_id')->constrained('uploads')->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['gestion_id','upload_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gestion_upload');
    }
};
