<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutor extends Model
{
    use SoftDeletes;

    protected $table = 'tutores';

    protected $fillable = [
        'rut','nombres','apellidos','email','telefono_1','telefono_2'
    ];

    // Opcional
    public function atenciones(){ return $this->hasMany(Atencion::class); }
}
