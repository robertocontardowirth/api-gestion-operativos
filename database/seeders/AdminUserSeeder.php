<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email'=>'admin@example.com'],
            [
              'rut'=>'1-9','nombre'=>'Admin','apellidos'=>'Principal',
              'telefono'=>'+56900000000','password'=>'password',
              'email_verified_at'=>now(), // verificado
            ]
        );
        $user->roles()->sync(Role::where('slug','admin')->pluck('id'));
    }
}
