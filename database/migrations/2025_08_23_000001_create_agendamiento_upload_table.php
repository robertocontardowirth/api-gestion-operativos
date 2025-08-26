<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('agendamiento_upload', function (Blueprint $table) {
            $table->foreignId('agendamiento_id')->constrained('agendamientos')->cascadeOnDelete();
            $table->foreignId('upload_id')->constrained('uploads')->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['agendamiento_id','upload_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendamiento_upload');
    }
};
