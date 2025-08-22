<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
          ['nombre'=>'Usuarios','slug'=>'usuarios','url'=>'/usuarios','icono'=>'users'],
          ['nombre'=>'Roles','slug'=>'roles','url'=>'/roles','icono'=>'shield'],
          ['nombre'=>'Modulos','slug'=>'modulos','url'=>'/modulos','icono'=>'widgets'],
          ['nombre'=>'Calendario','slug'=>'calendario','url'=>'/calendario','icono'=>'calendar'],
          ['nombre'=>'Clínica','slug'=>'clinica','url'=>'/clinica','icono'=>'hospital'],
          ['nombre'=>'Inventario','slug'=>'inventario','url'=>'/inventario','icono'=>'boxes'],
          ['nombre'=>'Pacientes','slug'=>'pacientes','url'=>'/pacientes','icono'=>'paw'],
          ['nombre'=>'Tutores','slug'=>'tutores','url'=>'/tutores','icono'=>'user'],
          ['nombre'=>'Servicios','slug'=>'servicios','url'=>'/servicios','icono'=>'stethoscope'],
          ['nombre'=>'Productos','slug'=>'productos','url'=>'/productos','icono'=>'box'],
          ['nombre'=>'Pagos','slug'=>'pagos','url'=>'/pagos','icono'=>'credit-card'],
          ['nombre'=>'Tipos de pago','slug'=>'tipos-pago','url'=>'/tipos-pago','icono'=>'wallet'],
          ['nombre'=>'Fases de Agendamiento','slug'=>'fases-agendamiento','url'=>'/fases','icono'=>'flag'],
        ];
        foreach ($modules as $m) { Module::firstOrCreate(['slug'=>$m['slug']], $m); }
    }
}
