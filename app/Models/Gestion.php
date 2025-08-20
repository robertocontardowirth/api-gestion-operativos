<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gestion extends Model
{
    use SoftDeletes;

    protected $table = 'gestiones';

    protected $fillable = [
        'paciente_id','fecha','autor','proximo_llamado','observacion'
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'proximo_llamado' => 'datetime',
    ];

    public function paciente(){ return $this->belongsTo(Paciente::class); }
}
