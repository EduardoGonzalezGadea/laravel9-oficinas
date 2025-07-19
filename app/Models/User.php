<?php

namespace App\Models;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use SoftDeletes, HasRoles;

    protected $fillable = [
        'username',
        'nombre_completo',
        'email',
        'password',
        'activo'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'activo' => 'boolean'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function modulos()
    {
        return $this->belongsToMany(Modulo::class, 'modulo_user')
            ->withTimestamps()
            ->withTrashed();
    }

    public function tieneAccesoModulo($moduloCodigo)
    {
        // Administrador tiene acceso a todo
        if ($this->hasRole('administrador')) {
            return true;
        }

        // Verificar si el usuario tiene asignado el módulo
        return $this->modulos()
            ->where('codigo', $moduloCodigo)
            ->exists();
    }
}
