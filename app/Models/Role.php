<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model {
  use SoftDeletes;
  protected $fillable = ['nombre','slug'];
  public function users(){ return $this->belongsToMany(User::class)->withTimestamps(); }
  public function modules(){ return $this->belongsToMany(Module::class)->withTimestamps(); }
}
