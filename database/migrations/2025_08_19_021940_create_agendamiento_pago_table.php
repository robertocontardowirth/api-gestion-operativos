<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('agendamiento_pago', function (Blueprint $t) {
      $t->foreignId('agendamiento_id')->constrained('agendamientos')->cascadeOnDelete();
      $t->foreignId('pago_id')->constrained('pagos')->cascadeOnDelete();
      $t->timestamps();
      $t->primary(['agendamiento_id','pago_id']);
    });
  }
  public function down(): void { Schema::dropIfExists('agendamiento_pago'); }
};
