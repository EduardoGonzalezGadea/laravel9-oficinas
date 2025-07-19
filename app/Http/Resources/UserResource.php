<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'nombre_completo' => $this->nombre_completo,
            'email' => $this->email,
            'activo' => $this->activo,
            'roles' => $this->getRoleNames(),
            'modulos' => $this->modulos->map(function ($modulo) {
                return [
                    'codigo' => $modulo->codigo,
                    'nombre' => $modulo->nombre
                ];
            }),
            'fecha_creacion' => $this->created_at->format('d/m/Y H:i:s'),
            'fecha_actualizacion' => $this->updated_at->format('d/m/Y H:i:s')
        ];
    }
}