<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
          ['nombre'=>'Admin','slug'=>'admin'],
          ['nombre'=>'Gestor','slug'=>'gestor'],
          ['nombre'=>'Doctor','slug'=>'doctor'],
          ['nombre'=>'Evaluador','slug'=>'evaluador'],
          ['nombre'=>'Recepción','slug'=>'recepcion'],
        ];
        foreach ($roles as $r) { Role::firstOrCreate(['slug'=>$r['slug']], $r); }

        // Admin con todos los módulos
        $admin = Role::where('slug','admin')->first();
        $admin->modules()->sync(Module::pluck('id'));
    }
}
