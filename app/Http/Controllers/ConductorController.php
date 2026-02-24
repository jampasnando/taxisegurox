<?php

namespace App\Http\Controllers\Api;

use App\Models\Conductor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConductorController extends Controller
{
    public function index(Request $request)
    {
        $query = Conductor::query();

        // 🔎 Buscar por documento
        if ($request->filled('nrodocumento')) {
            $query->where('nrodocumento', $request->nrodocumento);
        }

        // 🔎 Buscar por nombres o apellidos
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombres', 'ilike', "%{$request->search}%")
                  ->orWhere('primer_apellido', 'ilike', "%{$request->search}%")
                  ->orWhere('segundo_apellido', 'ilike', "%{$request->search}%");
            });
        }

        // 🔎 Buscar por categoría
        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        // 🔎 Buscar por tipo documento
        if ($request->filled('tipodocumento')) {
            $query->where('tipodocumento', $request->tipodocumento);
        }

        $conductores = $query->paginate(20);

        return response()->json([
            'success' => true,
            'message' => 'Listado de conductores',
            'data' => $conductores->items(),
            'pagination' => [
                'current_page' => $conductores->currentPage(),
                'last_page' => $conductores->lastPage(),
                'per_page' => $conductores->perPage(),
                'total' => $conductores->total(),
            ],
        ]);
    }

    public function show(Conductor $conductor)
    {
        return response()->json([
            'success' => true,
            'data' => $conductor,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nrodocumento'       => 'nullable|string|max:50',
            'expedido'           => 'nullable|string|max:30',
            'tipodocumento'      => 'nullable|string|max:50',
            'nombres'            => 'nullable|string|max:250',
            'primer_apellido'    => 'nullable|string|max:100',
            'segundo_apellido'   => 'nullable|string|max:100',
            'tercere_apellido'   => 'nullable|string|max:100',
            'celular'            => 'nullable|string|max:50',
            'direccion'          => 'nullable|string',
            'zona'               => 'nullable|string|max:200',
            'barrio'             => 'nullable|string|max:200',
            'tic'                => 'nullable|string|max:200',
            'categoria'          => 'nullable|string|max:20',
            'adjunto_documento'  => 'nullable|string',
            'adjunto_licencia'   => 'nullable|string',
            'adjunto_tic'        => 'nullable|string',
        ]);

        $conductor = Conductor::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Conductor creado correctamente',
            'data' => $conductor,
        ], 201);
    }

    public function update(Request $request, Conductor $conductor)
    {
        $data = $request->validate([
            'nrodocumento'       => 'sometimes|string|max:50',
            'expedido'           => 'nullable|string|max:30',
            'tipodocumento'      => 'nullable|string|max:50',
            'nombres'            => 'sometimes|string|max:250',
            'primer_apellido'    => 'nullable|string|max:100',
            'segundo_apellido'   => 'nullable|string|max:100',
            'tercere_apellido'   => 'nullable|string|max:100',
            'celular'            => 'nullable|string|max:50',
            'direccion'          => 'nullable|string',
            'zona'               => 'nullable|string|max:200',
            'barrio'             => 'nullable|string|max:200',
            'tic'                => 'nullable|string|max:200',
            'categoria'          => 'nullable|string|max:20',
            'adjunto_documento'  => 'nullable|string',
            'adjunto_licencia'   => 'nullable|string',
            'adjunto_tic'        => 'nullable|string',
        ]);

        $conductor->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Conductor actualizado correctamente',
            'data' => $conductor,
        ]);
    }

    public function destroy(Conductor $conductor)
    {
        $conductor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Conductor eliminado correctamente',
        ]);
    }
}
