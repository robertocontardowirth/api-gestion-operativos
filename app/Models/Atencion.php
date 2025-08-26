<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atencion extends Model
{
    use SoftDeletes;

    protected $table = 'atenciones';

    protected $fillable = [
        'paciente_id','tutor_id','especie_id',
        'sexo','peso','edad','anestesia_id',
        'anamnesis','observaciones',
    ];

    protected $casts = [
        'peso' => 'decimal:2',
        'edad' => 'integer',
    ];

    // Relaciones útiles
    public function paciente(){ return $this->belongsTo(Paciente::class); }
    public function tutor(){ return $this->belongsTo(Tutor::class); }
    public function especie(){ return $this->belongsTo(Especie::class); }
      public function uploads(){ return $this->belongsToMany(Upload::class)->withTimestamps(); }
}
