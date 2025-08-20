<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('servicios', function (Blueprint $t) {
      $t->id();
      $t->string('nombre');
      $t->decimal('precio', 12, 2)->default(0);
      $t->timestamps();
      $t->softDeletes();
    });
  }
  public function down(): void { Schema::dropIfExists('servicios'); }
};
