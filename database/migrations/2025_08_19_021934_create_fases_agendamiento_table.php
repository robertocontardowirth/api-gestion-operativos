<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('fases_agendamiento', function (Blueprint $t) {
      $t->id();
      $t->string('nombre')->unique();
      $t->string('color')->nullable();
      $t->string('icono')->nullable();
      $t->timestamps();
      $t->softDeletes();
    });
  }
  public function down(): void { Schema::dropIfExists('fases_agendamiento'); }
};
