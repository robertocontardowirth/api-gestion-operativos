<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('module_role', function (Blueprint $t) {
      $t->foreignId('module_id')->constrained('modules')->cascadeOnDelete();
      $t->foreignId('role_id')->constrained()->cascadeOnDelete();
      $t->timestamps();
      $t->primary(['module_id','role_id']);
    });
  }
  public function down(): void {
    Schema::dropIfExists('module_role');
  }
};
