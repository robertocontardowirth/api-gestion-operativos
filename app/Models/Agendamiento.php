<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agendamiento extends Model {
  use SoftDeletes;
  protected $fillable = [
    'origen_id','fase_id','paciente_id','tutor_id','atencion_id',
    'contacto','aprobacion','cita','llegada','evaluacion','pabellon','pago','salida',
    'especie_id','sexo','peso','edad','anestesia_id','abono','consentimiento','total','observaciones'
  ];

  public function origen(){ return $this->belongsTo(Origen::class, 'origen_id'); }
  public function fase(){ return $this->belongsTo(FaseAgendamiento::class, 'fase_id'); }
  public function paciente(){ return $this->belongsTo(Paciente::class); }
  public function tutor(){ return $this->belongsTo(Tutor::class); }
  public function atencion(){ return $this->belongsTo(Atencion::class); }
  public function especie(){ return $this->belongsTo(Especie::class); }

  public function productos(){ return $this->belongsToMany(Producto::class)->withPivot(['cantidad','precio'])->withTimestamps(); }
  public function servicios(){ return $this->belongsToMany(Servicio::class)->withPivot(['cantidad','precio'])->withTimestamps(); }
  public function pagos(){ return $this->belongsToMany(Pago::class)->withTimestamps(); }
  public function uploads(){ return $this->belongsToMany(Upload::class)->withTimestamps(); }
}
