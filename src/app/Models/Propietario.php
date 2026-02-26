<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Propietario extends Model
{
    use SoftDeletes;

    protected $table = 'propietarios';

    protected $fillable = [
        'nrodocumento',
        'expedido',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'tercer_apellido',
        'celular',
        'direccion',
        'zona',
        'barrio',
    ];

    public function propietarioVehiculos()
    {
        return $this->hasMany(PropietarioVehiculo::class);
    }
}
