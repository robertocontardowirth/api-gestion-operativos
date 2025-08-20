<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::table('users', function (Blueprint $t) {
      $t->string('rut')->unique()->nullable();
      $t->string('nombre')->nullable();
      $t->string('apellidos')->nullable();
      $t->string('telefono')->nullable();
      $t->softDeletes();
    });
  }
  public function down(): void {
    Schema::table('users', function (Blueprint $t) {
      $t->dropColumn(['rut','nombre','apellidos','telefono','deleted_at']);
    });
  }
};
