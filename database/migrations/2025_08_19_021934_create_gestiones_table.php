<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('gestiones', function (Blueprint $t) {
      $t->id();
      $t->foreignId('paciente_id')->nullable()->constrained('pacientes');
      $t->dateTime('fecha')->nullable();
      $t->string('autor')->nullable();
      $t->dateTime('proximo_llamado')->nullable();
      $t->text('observacion')->nullable();
      $t->timestamps();
      $t->softDeletes();
    });
  }
  public function down(): void { Schema::dropIfExists('gestiones'); }
};
