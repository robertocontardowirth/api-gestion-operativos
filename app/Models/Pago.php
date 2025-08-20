<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    use SoftDeletes;

    protected $table = 'pagos';

    protected $fillable = ['tipo_pago_id','monto','fecha_pago','observacion'];

    protected $casts = [
        'monto' => 'decimal:2',
        'fecha_pago' => 'datetime',
    ];

    public function tipoPago(){ return $this->belongsTo(TipoPago::class, 'tipo_pago_id'); }
}
