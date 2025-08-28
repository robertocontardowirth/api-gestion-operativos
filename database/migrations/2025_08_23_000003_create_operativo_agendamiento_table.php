<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('operativo_agendamiento', function (Blueprint $t) {
      $t->foreignId('operativo_id')->constrained('operativos')->cascadeOnDelete();
      $t->foreignId('agendamiento_id')->constrained('agendamientos')->cascadeOnDelete();
      $t->timestamps();
      $t->primary(['operativo_id','agendamiento_id']);
    });
  }
  public function down(): void { Schema::dropIfExists('operativo_agendamiento'); }
};
