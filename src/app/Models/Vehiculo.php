<?php

namespace App\Models;

use App\Models\OperadorVehiculo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculo extends Model
{
    use SoftDeletes;

    protected $table = 'vehiculos';

    protected $fillable = [
        'placa',
        'modelo',
        'color',
        'nroplazas',
        'combustible',
        'motor',
        'chasis',
        'estado',
    ];

    protected $casts = [
        'estado' => 'integer',
    ];

    // Relaciones

    public function propietarioVehiculos()
    {
        return $this->hasMany(PropietarioVehiculo::class);
    }
    public function conductorVehiculos()
    {
        return $this->hasMany(ConductorVehiculo::class);
    }
    public function operadorVehiculos()
    {
        return $this->hasMany(OperadorVehiculo::class);
    }
    protected function placa(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }
}
