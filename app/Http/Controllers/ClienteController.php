<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = new Cliente();
        return view('cliente.index', [
            'modo' => 'cli',
            'model' => $model,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos
            $validatedData = $this->validarCampos($request);

            // Asignar fecha de registro actual
            $validatedData['fechareg'] = Carbon::now();

            // Crear el cliente
            Cliente::create($validatedData);

            // Retornar respuesta JSON
            return response()->json([
                'msj' => 'Cliente creado correctamente',
                'error' => '0',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'msj' => 'Error: ' . $e->getMessage(),
                'error' => '1',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validar los datos
            $validatedData = $request->validate([
                'razonsocial' => 'required|string|max:500',
                'ruc' => [
                    'required',
                    'string',
                    'size:11',
                    Rule::unique('cliente', 'ruc')->ignore($id),
                ],
                'domicilio' => 'nullable|string|max:500',
                'persona' => 'nullable|string|max:500',
                'contacto' => 'nullable|string|max:500',
                'correo' => 'nullable|email|max:500',
                'estado' => 'nullable|boolean',
                'fechareg' => 'nullable|date',
            ]);

            // Buscar el cliente y actualizar
            $cliente = Cliente::findOrFail($id);
            $cliente->update($validatedData);

            return response()->json([
                'msj' => 'Cliente actualizado correctamente',
                'error' => '0',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'msj' => 'Error: ' . $e->getMessage(),
                'error' => '1',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();

            return response()->json([
                'msj' => 'Cliente eliminado correctamente',
                'error' => '0',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'msj' => 'Error: ' . $e->getMessage(),
                'error' => '1',
            ], 500);
        }
    }

    /**
     * Buscar clientes en base a criterios.
     */
    public function buscar(Request $request)
    {
        $data = [
            "lista" => []
        ];

        try {
            $searchTerm = $request->input('cadena');
            $estado = $request->input('estado');

            $query = DB::table('cliente')
                ->selectRaw("
                    id,
                    COALESCE(razonsocial, '') as razonsocial,
                    COALESCE(ruc, '') as ruc,
                    COALESCE(domicilio, '') as domicilio,
                    COALESCE(persona, '') as persona,
                    COALESCE(contacto, '') as contacto,
                    COALESCE(correo, '') as correo,
                    COALESCE(fechareg, '') as fechareg,
                    COALESCE(estado, '') as estado
                ")
                ->where(function ($query) use ($searchTerm) {
                    $query->where('razonsocial', 'LIKE', '%' . $searchTerm . '%')
                          ->orWhere('ruc', 'LIKE', '%' . $searchTerm . '%')
                          ->orWhere('persona', 'LIKE', '%' . $searchTerm . '%')
                          ->orWhere('contacto', 'LIKE', '%' . $searchTerm . '%')
                          ->orWhere('correo', 'LIKE', '%' . $searchTerm . '%');
                });

            if ($estado && $estado !== 'TT') {
                $query->where('estado', $estado);
            }

            $data["lista"] = $query->orderByDesc('id')->get()->toArray();

        } catch (\Exception $e) {
            $data['error'] = "1";
            $data['msj'] = "Ocurrió un error al listar";
            $data['info'] = $e->getMessage();
        }

        return response()->json($data);
    }

    /**
     * Validar los campos de entrada.
     */
    public function validarCampos(Request $request)
    {
        return $request->validate([
            'razonsocial' => 'required|string|max:500',
            'ruc' => 'required|string|size:11|unique:cliente,ruc',
            'domicilio' => 'nullable|string|max:500',
            'persona' => 'nullable|string|max:500',
            'contacto' => 'nullable|string|max:500',
            'correo' => 'nullable|email|max:500',
            'estado' => 'nullable|boolean',
            'fechareg' => 'nullable|date',
        ]);
    }
}
