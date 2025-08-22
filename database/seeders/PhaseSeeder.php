<?php

namespace Database\Seeders;

use App\Models\FaseAgendamiento;
use Illuminate\Database\Seeder;

class PhaseSeeder extends Seeder
{
    public function run(): void
    {
        $fases = [
          ['nombre'=>'Contacto','color'=>'#6b7280','icono'=>'phone'],
          ['nombre'=>'Agendado','color'=>'#2563eb','icono'=>'calendar-check'],
          ['nombre'=>'Entrada','color'=>'#10b981','icono'=>'door-open'],
          ['nombre'=>'Evaluación','color'=>'#f59e0b','icono'=>'clipboard'],
          ['nombre'=>'Pabellón','color'=>'#ef4444','icono'=>'scalpel'],
          ['nombre'=>'Pagado','color'=>'#22c55e','icono'=>'cash'],
        ];
        foreach ($fases as $f) { FaseAgendamiento::firstOrCreate(['nombre'=>$f['nombre']], $f); }
    }
}
