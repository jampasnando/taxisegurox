<?php

namespace App\Http\Controllers\Api;

use App\Models\ConductorVehiculo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConductorVehiculoController extends Controller
{
    /**
     * Listado con filtros
     */
    public function index(Request $request)
    {
        $query = ConductorVehiculo::with([
            'conductor',
            'vehiculo',
            'propietario'
        ]);

        // 🔎 Filtros
        if ($request->filled('vehiculo_id')) {
            $query->where('vehiculo_id', $request->vehiculo_id);
        }

        if ($request->filled('conductor_id')) {
            $query->where('conductor_id', $request->conductor_id);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('fecha')) {
            $query->whereDate('fechareg', $request->fecha);
        }

        $data = $query->paginate(20);

        return response()->json([
            'success' => true,
            'message' => 'Listado de asignaciones conductor-vehículo',
            'data' => $data->items(),
            'pagination' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
            ]
        ]);
    }

    /**
     * Crear asignación
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'propietario_id' => 'required|exists:propietarios,id',
            'vehiculo_id'    => 'required|exists:vehiculos,id',
            'conductor_id'   => 'required|exists:conductors,id',
            'fechareg'       => 'required|date',
            'estado'         => 'required|string|max:100',
        ]);

        // 🚨 Evitar duplicado ACTIVO del mismo conductor en el mismo vehículo
        if ($data['estado'] === 'ACTIVO') {

            $duplicado = ConductorVehiculo::where('vehiculo_id', $data['vehiculo_id'])
                ->where('conductor_id', $data['conductor_id'])
                ->where('estado', 'ACTIVO')
                ->exists();

            if ($duplicado) {
                return response()->json([
                    'success' => false,
                    'message' => 'El conductor ya está ACTIVO en este vehículo.'
                ], 422);
            }
        }

        $registro = ConductorVehiculo::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Asignación registrada correctamente',
            'data' => $registro
        ], 201);
    }

    /**
     * Mostrar una asignación
     */
    public function show(ConductorVehiculo $conductorVehiculo)
    {
        $conductorVehiculo->load([
            'conductor',
            'vehiculo',
            'propietario'
        ]);

        return response()->json([
            'success' => true,
            'data' => $conductorVehiculo
        ]);
    }

    /**
     * Actualizar asignación
     */
    public function update(Request $request, ConductorVehiculo $conductorVehiculo)
    {
        $data = $request->validate([
            'fechareg' => 'nullable|date',
            'estado'   => 'nullable|string|max:100',
        ]);

        if (isset($data['estado']) && $data['estado'] === 'ACTIVO') {

            $duplicado = ConductorVehiculo::where('vehiculo_id', $conductorVehiculo->vehiculo_id)
                ->where('conductor_id', $conductorVehiculo->conductor_id)
                ->where('estado', 'ACTIVO')
                ->where('id', '!=', $conductorVehiculo->id)
                ->exists();

            if ($duplicado) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ya existe un registro ACTIVO para este conductor en este vehículo.'
                ], 422);
            }
        }

        $conductorVehiculo->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Asignación actualizada correctamente',
            'data' => $conductorVehiculo
        ]);
    }

    /**
     * Eliminación lógica
     */
    public function destroy(ConductorVehiculo $conductorVehiculo)
    {
        $conductorVehiculo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Asignación eliminada correctamente'
        ]);
    }
    public function conductoresActivos($vehiculoId)
    {
        $registros = ConductorVehiculo::with(['conductor', 'vehiculo'])
            ->where('vehiculo_id', $vehiculoId)
            ->where('estado', 'ACTIVO')
            ->get();

        if ($registros->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No hay conductores activos para este vehículo',
                'data' => []
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Conductores activos del vehículo',
            'data' => $registros
        ]);
    }
}
