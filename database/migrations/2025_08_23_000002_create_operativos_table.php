<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('operativos', function (Blueprint $t) {
      $t->id();
      $t->string('titulo');
      $t->string('descripcion');
      $t->dateTime('fecha_inicio');
      $t->dateTime('fecha_termino');
      $t->timestamps();
      $t->softDeletes();
    });
  }
  public function down(): void { Schema::dropIfExists('operativos'); }
};
