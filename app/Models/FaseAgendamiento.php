<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaseAgendamiento extends Model
{
    use SoftDeletes;

    protected $table = 'fases_agendamiento';

    protected $fillable = ['nombre','color','icono'];
}
