<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('atenciones', function (Blueprint $t) {
      $t->id();
      $t->foreignId('paciente_id')->nullable()->constrained('pacientes');
      $t->foreignId('tutor_id')->nullable()->constrained('tutores');
      $t->foreignId('especie_id')->nullable()->constrained('especies');
      $t->string('sexo')->nullable();
      $t->decimal('peso',8,2)->nullable();
      $t->integer('edad')->nullable();
      $t->unsignedBigInteger('anestesia_id')->nullable(); // sin FK explícita
      $t->text('anamnesis')->nullable();
      $t->text('observaciones')->nullable();
      $t->timestamps();
      $t->softDeletes();
    });
  }
  public function down(): void { Schema::dropIfExists('atenciones'); }
};
