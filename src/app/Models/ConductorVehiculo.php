<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConductorVehiculo extends Model
{
    protected $table = 'conductor_vehiculo';

    protected $fillable = [
        'propietario_id',
        'vehiculo_id',
        'conductor_id',
        'fechareg',
        'estado',
    ];

    protected $dates = ['fechareg'];

    public function propietario()
    {
        return $this->belongsTo(Propietario::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function conductor()
    {
        return $this->belongsTo(Conductor::class);
    }
}
