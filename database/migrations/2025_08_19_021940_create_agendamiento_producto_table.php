<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('agendamiento_producto', function (Blueprint $t) {
      $t->foreignId('agendamiento_id')->constrained('agendamientos')->cascadeOnDelete();
      $t->foreignId('producto_id')->constrained('productos')->cascadeOnDelete();
      $t->integer('cantidad')->default(1);
      $t->decimal('precio',12,2)->nullable();
      $t->timestamps();
      $t->primary(['agendamiento_id','producto_id']);
    });
  }
  public function down(): void { Schema::dropIfExists('agendamiento_producto'); }
};
