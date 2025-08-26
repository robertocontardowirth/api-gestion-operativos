<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use SoftDeletes;

    protected $table = 'pacientes';

    protected $fillable = ['nombre'];

    // Opcionales
    public function atenciones(){ return $this->hasMany(Atencion::class); }
    public function gestiones(){ return $this->hasMany(Gestion::class); }
      public function uploads(){ return $this->belongsToMany(Upload::class)->withTimestamps(); }
}
