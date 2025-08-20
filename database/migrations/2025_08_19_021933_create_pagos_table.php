<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('pagos', function (Blueprint $t) {
      $t->id();
      $t->foreignId('tipo_pago_id')->constrained('tipos_pago');
      $t->decimal('monto', 12, 2);
      $t->dateTime('fecha_pago')->nullable();
      $t->string('observacion')->nullable();
      $t->timestamps();
      $t->softDeletes();
    });
  }
  public function down(): void { Schema::dropIfExists('pagos'); }
};
