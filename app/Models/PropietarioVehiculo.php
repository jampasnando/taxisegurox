<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropietarioVehiculo extends Model
{
    protected $table = 'propietario_vehiculo';

    protected $fillable = [
        'propietario_id',
        'vehiculo_id',
        'tipo',
        'adjunto_crpva',
        'adjunto_poder',
        'adjunto_matricula',
        'estado',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function propietario()
    {
        return $this->belongsTo(Propietario::class);
    }
}
