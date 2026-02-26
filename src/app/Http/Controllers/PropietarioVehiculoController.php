<?php

namespace App\Http\Controllers;

use App\Models\PropietarioVehiculo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropietarioVehiculoController extends Controller
{
    public function index(Request $request)
    {
        $query = PropietarioVehiculo::with(['propietario', 'vehiculo']);

        if ($request->filled('vehiculo_id')) {
            $query->where('vehiculo_id', $request->vehiculo_id);
        }

        if ($request->filled('propietario_id')) {
            $query->where('propietario_id', $request->propietario_id);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $data = $query->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $data->items(),
            'pagination' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'total' => $data->total(),
            ]
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'propietario_id'     => 'required|exists:propietarios,id',
            'vehiculo_id'        => 'required|exists:vehiculos,id',
            'tipo'               => 'nullable|string|max:200',
            'adjunto_crpva'      => 'nullable|string',
            'adjunto_poder'      => 'nullable|string',
            'adjunto_matricula'  => 'nullable|string',
            'estado'             => 'required|string|max:100',
            'adjunto_fotofrontal' => 'nullable|string',
            'adjunto_fotoposterior' => 'nullable|string',
            'adjunto_fotolateralizq' => 'nullable|string',
            'adjunto_fotolateralder' => 'nullable|string',
        ]);

        // 🚨 Validación crítica municipal
        if ($data['estado'] === 'ACTIVO') {

            $existeActivo = \App\Models\PropietarioVehiculo::where('vehiculo_id', $data['vehiculo_id'])
                ->where('estado', 'ACTIVO')
                ->exists();

            if ($existeActivo) {
                return response()->json([
                    'success' => false,
                    'message' => 'El vehículo ya tiene un propietario ACTIVO registrado.'
                ], 422);
            }
        }

        $registro = \App\Models\PropietarioVehiculo::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Relación propietario-vehículo creada correctamente',
            'data' => $registro
        ], 201);
    }

    public function show(PropietarioVehiculo $propietarioVehiculo)
    {
        $propietarioVehiculo->load(['propietario', 'vehiculo']);

        return response()->json([
            'success' => true,
            'data' => $propietarioVehiculo
        ]);
    }

    public function update(Request $request, PropietarioVehiculo $propietarioVehiculo)
    {
        $data = $request->validate([
            'tipo'               => 'nullable|string|max:200',
            'adjunto_crpva'      => 'nullable|string',
            'adjunto_poder'      => 'nullable|string',
            'adjunto_matricula'  => 'nullable|string',
            'estado'             => 'nullable|string|max:100',
            'adjunto_fotofrontal' => 'nullable|string',
            'adjunto_fotoposterior' => 'nullable|string',
            'adjunto_fotolateralizq' => 'nullable|string',
            'adjunto_fotolateralder' => 'nullable|string',
        ]);

        if (isset($data['estado']) && $data['estado'] === 'ACTIVO') {

            $existeActivo = \App\Models\PropietarioVehiculo::where('vehiculo_id', $propietarioVehiculo->vehiculo_id)
                ->where('estado', 'ACTIVO')
                ->where('id', '!=', $propietarioVehiculo->id)
                ->exists();

            if ($existeActivo) {
                return response()->json([
                    'success' => false,
                    'message' => 'El vehículo ya tiene otro propietario ACTIVO.'
                ], 422);
            }
        }

        $propietarioVehiculo->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Relación actualizada correctamente',
            'data' => $propietarioVehiculo
        ]);
    }

    public function destroy(PropietarioVehiculo $propietarioVehiculo)
    {
        $propietarioVehiculo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Relación eliminada correctamente'
        ]);
    }
}
