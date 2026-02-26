<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropietarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Propietario::query();

        // 🔎 Buscar por documento exacto
        if ($request->filled('documento')) {
            $query->where('nrodocumento', $request->documento);
        }

        // 🔎 Buscar por nombre o apellido
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombres', 'ilike', "%{$request->search}%")
                  ->orWhere('primer_apellido', 'ilike', "%{$request->search}%")
                  ->orWhere('segundo_apellido', 'ilike', "%{$request->search}%");
            });
        }

        // 📎 Incluir relaciones si se solicita
        if ($request->filled('include')) {
            $relations = explode(',', $request->include);
            $query->with($relations);
        }

        $propietarios = $query->paginate(20);

        return response()->json([
            'success' => true,
            'message' => 'Listado de propietarios',
            'data' => $propietarios->items(),
            'pagination' => [
                'current_page' => $propietarios->currentPage(),
                'last_page' => $propietarios->lastPage(),
                'per_page' => $propietarios->perPage(),
                'total' => $propietarios->total(),
            ],
        ]);
    }

    public function show(Propietario $propietario)
    {
        $propietario->load('propietarioVehiculos.vehiculo');

        return response()->json([
            'success' => true,
            'data' => $propietario,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nrodocumento'     => 'required|unique:propietarios',
            'expedido'         => 'nullable|string|max:10',
            'nombres'          => 'required|string|max:100',
            'primer_apellido'  => 'nullable|string|max:100',
            'segundo_apellido' => 'nullable|string|max:100',
            'tercer_apellido'  => 'nullable|string|max:100',
            'celular'          => 'nullable|string|max:20',
            'direccion'        => 'nullable|string|max:255',
            'zona'             => 'nullable|string|max:100',
            'barrio'           => 'nullable|string|max:100',
            'adjunto_documento' => 'nullable|string',
        ]);

        $propietario = Propietario::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Propietario creado correctamente',
            'data' => $propietario,
        ], 201);
    }

    public function update(Request $request, Propietario $propietario)
    {
        $data = $request->validate([
            'nrodocumento'     => 'sometimes|unique:propietarios,nrodocumento,' . $propietario->id,
            'expedido'         => 'nullable|string|max:10',
            'nombres'          => 'sometimes|string|max:100',
            'primer_apellido'  => 'nullable|string|max:100',
            'segundo_apellido' => 'nullable|string|max:100',
            'tercer_apellido'  => 'nullable|string|max:100',
            'celular'          => 'nullable|string|max:20',
            'direccion'        => 'nullable|string|max:255',
            'zona'             => 'nullable|string|max:100',
            'barrio'           => 'nullable|string|max:100',
            'adjunto_documento' => 'nullable|string',
        ]);

        $propietario->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Propietario actualizado correctamente',
            'data' => $propietario,
        ]);
    }

    public function destroy(Propietario $propietario)
    {
        $propietario->delete();

        return response()->json([
            'success' => true,
            'message' => 'Propietario eliminado correctamente',
        ]);
    }
}
