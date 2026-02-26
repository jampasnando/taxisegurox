<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehiculoController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehiculo::query();

        // 🔎 Búsqueda principal
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('placa', 'ilike', "%{$request->search}%");
                //   ->orWhere('nromovil', 'ilike', "%{$request->search}%");
            });
        }

        // 📎 Cargar relaciones si se pide
        if ($request->filled('include')) {
            $relations = explode(',', $request->include);
            $query->with($relations);
        }

        $vehiculos = $query->paginate(20);

        return response()->json([
            'success' => true,
            'message' => 'Listado de vehículos',
            'data' => $vehiculos->items(),
            'pagination' => [
                'current_page' => $vehiculos->currentPage(),
                'last_page' => $vehiculos->lastPage(),
                'per_page' => $vehiculos->perPage(),
                'total' => $vehiculos->total(),
            ],
        ]);
    }

    public function show(Vehiculo $vehiculo)
    {
        $vehiculo->load('propietarioVehiculos.propietario');

        return response()->json([
            'success' => true,
            'data' => $vehiculo,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'placa' => 'required|unique:vehiculos',
            'marca' => 'required',
            'modelo' => 'required',
        ]);

        $vehiculo = Vehiculo::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Vehículo creado correctamente',
            'data' => $vehiculo,
        ], 201);
    }

    public function update(Request $request, Vehiculo $vehiculo)
    {
        $vehiculo->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Vehículo actualizado',
            'data' => $vehiculo,
        ]);
    }

    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Vehículo eliminado correctamente',
        ]);
    }
}
