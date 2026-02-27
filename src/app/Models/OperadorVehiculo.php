<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperadorVehiculo extends Model
{
    protected $table = 'operador_vehiculo';

    protected $fillable = [
        'operador_id',
        'vehiculo_id',
        'tipo',
        'estado',
    ];

    // Relaciones

    public function operador()
    {
        return $this->belongsTo(Operador::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
