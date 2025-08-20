<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPago extends Model
{
    use SoftDeletes;

    protected $table = 'tipos_pago';

    protected $fillable = ['nombre'];

    // Opcional
    public function pagos(){ return $this->hasMany(Pago::class, 'tipo_pago_id'); }
}
