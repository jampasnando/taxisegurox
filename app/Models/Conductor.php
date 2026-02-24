<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    protected $table = 'conductores';
    protected $fillable = [
        'nrodocumento',
        'expedido',
        'tipodocumento',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'tercer_apellido',
        'celular',
        'direccion',
        'zona',
        'barrio',
        'tic',
        'categoria',
        'adjunto_documento',
        'adjunto_licencia',
        'adjunto_tic',

    ];
    public function vehiculos()
    {
        return $this->belongsToMany(Vehiculo::class,'conductor_vehiculo')->withPivot(['estado', 'fechareg'])->withTimestamps();
    }
}
