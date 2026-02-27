<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operador extends Model
{
    protected $table = 'operadores';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    // Relaciones

    public function conductorVehiculos()
    {
        return $this->hasMany(ConductorVehiculo::class);
    }
}
