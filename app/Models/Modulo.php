<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modulo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'modulo_user')
            ->withTimestamps()
            ->withTrashed();
    }
}