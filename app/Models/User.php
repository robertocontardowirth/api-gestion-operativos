<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $fillable = [
        'rut','password','nombre','apellidos','email','telefono',
    ];

    protected $hidden = ['password','remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relaciones
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function modules() // módulos via roles
    {
        return $this->hasManyThrough(Module::class, Role::class, 'id', 'id', null, null)
            ->usingPivot('module_role'); // ayuda IDE; no es obligatorio
    }

    public function hasModule(string $slug): bool
    {
        return $this->roles()->whereHas('modules', fn($q)=>$q->where('slug',$slug))->exists();
    }
}
