<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('tutores', function (Blueprint $t) {
      $t->id();
      $t->string('rut')->nullable();
      $t->string('nombres');
      $t->string('apellidos')->nullable();
      $t->string('email')->nullable();
      $t->string('telefono_1')->nullable();
      $t->string('telefono_2')->nullable();
      $t->timestamps();
      $t->softDeletes();
    });
  }
  public function down(): void { Schema::dropIfExists('tutores'); }
};
