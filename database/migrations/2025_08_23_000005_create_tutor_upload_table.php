<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tutor_upload', function (Blueprint $table) {
            $table->foreignId('tutor_id')->constrained('tutores')->cascadeOnDelete();
            $table->foreignId('upload_id')->constrained('uploads')->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['tutor_id','upload_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutor_upload');
    }
};
