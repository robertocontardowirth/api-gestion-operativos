<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('agendamientos', function (Blueprint $t) {
      $t->id();
      $t->foreignId('origen_id')->nullable()->constrained('origenes');
      $t->foreignId('fase_id')->nullable()->constrained('fases_agendamiento');
      $t->foreignId('paciente_id')->nullable()->constrained('pacientes');
      $t->foreignId('tutor_id')->nullable()->constrained('tutores');
      $t->foreignId('atencion_id')->nullable()->constrained('atenciones');

      $t->string('contacto')->nullable();
      $t->dateTime('aprobacion')->nullable();
      $t->dateTime('cita')->nullable();
      $t->dateTime('llegada')->nullable();
      $t->dateTime('evaluacion')->nullable();
      $t->dateTime('pabellon')->nullable();
      $t->dateTime('pago')->nullable();
      $t->dateTime('salida')->nullable();

      $t->foreignId('especie_id')->nullable()->constrained('especies');
      $t->string('sexo')->nullable();
      $t->decimal('peso',8,2)->nullable();
      $t->integer('edad')->nullable();
      $t->unsignedBigInteger('anestesia_id')->nullable();

      $t->boolean('abono')->default(false);
      $t->boolean('consentimiento')->default(false);
      $t->decimal('total', 12, 2)->default(0);
      $t->text('observaciones')->nullable();

      $t->timestamps();
      $t->softDeletes();
    });
  }
  public function down(): void { Schema::dropIfExists('agendamientos'); }
};
