<?php

namespace App\Http\Controllers;
use App\Models\MedioPago;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class MedioPagoController extends Controller
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
        if (Auth::user()->perfil != 'administrador') {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }
        $model = new MedioPago();
        return view('mediopago.index', [
            'modo' => 'cli',
            'model' => $model,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //dd($request->all());
            // Validar los datos
            $validatedData = $this->validarCampos($request);

            // Asignar fecha actual
            $validatedData['fechareg'] = Carbon::now();

            // Crear la MedioPago
            MedioPago::create($validatedData);

            // Retornar respuesta JSON
            return response()->json([
                'msj' => 'todo ok',
                'error' => '0'
            ]);
        } catch (\Exception $e) {
            // Manejar errores y devolver respuesta JSON con error
            return response()->json([
                'msj' => 'Error: ' . $e->getMessage(),
                'error' => '1'
            ], 500); // Código HTTP para errores de servidor
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            //\Log::info('Datos recibidos:', $request->all());
            //dd($request->all());
            // Validar los datos
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:500',
                'fechareg' => 'nullable|date', // Permite null o una fecha válida
                'estado' => 'nullable|boolean', // Permite null o un valor booleano
            ]);

            // Buscar la MedioPago en la base de datos, lanzará una excepción si no existe
            $MedioPago = MedioPago::findOrFail($id);

            // Si 'fechareg' no está presente, asignar la fecha actual
            if (!isset($validatedData['fechareg'])) {
                $validatedData['fechareg'] = now(); // Asignar la fecha y hora actuales
            }

            // Actualizar los datos de la MedioPago
            $MedioPago->update($validatedData);

            // Retornar respuesta JSON con éxito
            return response()->json([
                'msj' => 'todo ok',
                'error' => '0',
            ]);
        } catch (\Exception $e) {
            // En caso de error, devolver una respuesta JSON con el mensaje de error
            return response()->json([
                'msj' => 'Error: ' . $e->getMessage(),
                'error' => '1',
            ], 500); // Error de servidor (500)
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Buscar la MedioPago en la base de datos
            $MedioPago = MedioPago::findOrFail($id);

            // Eliminar la MedioPago
            $MedioPago->delete();

            // Retornar respuesta JSON en caso de éxito
            return response()->json([
                'msj' => 'Medio de pago eliminado correctamente',
                'error' => '0'
            ]);
        } catch (\Exception $e) {
            // Manejar cualquier error y retornar respuesta JSON con el error
            return response()->json([
                'msj' => 'Error: ' . $e->getMessage(),
                'error' => '1'
            ], 500); // Código de error 500
        }
    }

    public function buscar()
    {
        $data = [
            "lista" => []
        ];

        try {
            // Configurar el lenguaje para los nombres de tiempo (opcional)
            DB::statement("SET lc_time_names = 'es_ES'");

            $searchTerm= $_POST["cadena"];
            $estado = $_POST["estado"];

            // Consulta a la base de datos
            $query =  DB::table('medio_pago')
            ->selectRaw("
                    id,
                    COALESCE(nombre, '') as nombre,
                    COALESCE(fechareg, '') as fechareg,
                    COALESCE(estado, '') as estado
                ")
                ->where(function($query) use ($searchTerm) {
                    $query->where('nombre', 'LIKE', '%' . $searchTerm . '%');
                });

            if ($estado && $estado !== 'TT') {
                $query->where('estado', $estado);
            }
            $rows = $query
                    ->orderByDesc('id')
                    ->get();
            // Convertir el resultado a un arreglo
            $data["lista"] = $rows->toArray();

        } catch (\Exception $e) {
            $data['error'] = "1";
            $data['msj'] = "Ocurrió un error al listar";
            $data['info'] = $e->getMessage();
        }

        return response()->json($data);
    }


    public function validarCampos(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:500',
            'fechareg' => 'nullable|date',
            'estado' => 'nullable|boolean',
        ]);

        return $validatedData;
    }
}
