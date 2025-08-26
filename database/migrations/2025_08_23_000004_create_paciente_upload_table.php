<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('paciente_upload', function (Blueprint $table) {
            $table->foreignId('paciente_id')->constrained('pacientes')->cascadeOnDelete();
            $table->foreignId('upload_id')->constrained('uploads')->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['paciente_id','upload_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paciente_upload');
    }
};
