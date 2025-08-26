<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use SoftDeletes;

    protected $fillable = ['filename','url','mime_type','size'];

    public function agendamientos(){ return $this->belongsToMany(Agendamiento::class)->withTimestamps(); }
    public function atenciones(){ return $this->belongsToMany(Atencion::class)->withTimestamps(); }
    public function pagos(){ return $this->belongsToMany(Pago::class)->withTimestamps(); }
    public function pacientes(){ return $this->belongsToMany(Paciente::class)->withTimestamps(); }
    public function tutores(){ return $this->belongsToMany(Tutor::class)->withTimestamps(); }
    public function gestiones(){ return $this->belongsToMany(Gestion::class)->withTimestamps(); }
}
