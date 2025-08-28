<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operativo extends Model {
  use SoftDeletes;
  protected $fillable = [
    'titulo','descripcion','fecha_inicio','fecha_termino'
  ];

  public function agendamientos(){
    return $this->belongsToMany(Agendamiento::class, 'operativo_agendamiento')->withTimestamps();
  }
}
