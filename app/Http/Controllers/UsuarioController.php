<?php
namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
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
        return view('usuario.index', [
            'modo' => 'cli',
            'model' => new User(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos de la solicitud
            $validatedData = $this->validarCampos($request);

            // Asignar fecha actual
            $validatedData['fecha'] = Carbon::now();
            if (isset($validatedData['password'])) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            }


            $validatedData['username'] = $request->validate([
                'username' => 'required|unique:usuario,username|max:20', // El campo 'username' debe ser único en la tabla 'usuario'
            ])['username'];


            // Crear el nuevo usuario
            User::create($validatedData);

            // Retornar respuesta JSON exitosa
            return response()->json([
                'msj' => 'Usuario creado correctamente',
                'error' => '0'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {

            $errorMessages = '';
            foreach ($e->errors() as $field => $messages) {
                foreach ($messages as $message) {
                    $errorMessages .= ucfirst($field) . ': ' . $message . ' ';
                }
            }
            return response()->json([
                'msj' => 'Error de validación: ' . trim($errorMessages), // Detalle del error dentro de 'msj'
                'error' => '1',
            ], 422);
        } catch (\Exception $e) {
            // Manejar cualquier otro error
            return response()->json([
                'msj' => 'Error: ' . $e->getMessage(),
                'error' => '1'
            ], 500); // Código HTTP 500 para errores internos del servidor
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            // Validar los datos recibidos
            $validatedData = $request->validate([
                'clave1' => 'required|string|min:4|max:100',
                'clave2' => 'required|string|min:4|max:100|same:clave1',
                'iduser' => 'required|integer|exists:usuario,id',
            ]);

            // Buscar el usuario por ID
            $usuario = User::findOrFail($validatedData['iduser']);

            // Encriptar la nueva clave
            $usuario->password = bcrypt($validatedData['clave1']);

            // Guardar los cambios
            $usuario->save();

            // Retornar respuesta JSON de éxito
            return response()->json([
                'msj' => 'Contraseña actualizada correctamente',
                'error' => '0',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = '';
            foreach ($e->errors() as $field => $messages) {
                foreach ($messages as $message) {
                    $errorMessages .= ucfirst($field) . ': ' . $message . ' ';
                }
            }
            return response()->json([
                'msj' => 'Error de validación: ' . trim($errorMessages), // Detalle del error dentro de 'msj'
                'error' => '1',
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'msj' => 'Error: ' . $e->getMessage(),
                'error' => '1',
            ], 500); // Código HTTP 500
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validar los datos recibidos
            $validatedData = $this->validarCampos2($request);

            // Eliminar el campo 'password' de los datos validados si existe
            // Esto evita que el campo 'password' se actualice
            unset($validatedData['password']);

            // Buscar el usuario por ID
            $usuario = User::findOrFail($id);

            // Actualizar los datos del usuario, excluyendo 'password'
            $usuario->update($validatedData);

            // Retornar respuesta JSON con éxito
            return response()->json([
                'msj' => 'Usuario actualizado correctamente',
                'error' => '0',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = '';
            foreach ($e->errors() as $field => $messages) {
                foreach ($messages as $message) {
                    $errorMessages .= ucfirst($field) . ': ' . $message . ' ';
                }
            }
            return response()->json([
                'msj' => 'Error de validación: ' . trim($errorMessages), // Detalle del error dentro de 'msj'
                'error' => '1',
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'msj' => 'Error: ' . $e->getMessage(),
                'error' => '1',
            ], 500); // Código HTTP 500
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Verificar si el ID es 1 y evitar la eliminación
            if ($id == 1) {
                return response()->json([
                    'msj' => 'No se puede eliminar el usuario con ID 1.',
                    'error' => '1'
                ], 403); // Código HTTP 403: Prohibido
            }

            // Buscar el usuario por ID y eliminarlo
            $usuario = User::findOrFail($id);
            $usuario->delete();

            // Respuesta exitosa
            return response()->json([
                'msj' => 'Usuario eliminado correctamente',
                'error' => '0'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'msj' => 'Error: ' . $e->getMessage(),
                'error' => '1'
            ], 500); // Error de servidor
        }
    }


    /**
     * Buscar usuarios por coincidencia en nombre o estado.
     */
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
            $query =  DB::table('usuario')
            ->selectRaw("
                    id,
                    COALESCE(username, '') as username,
                    COALESCE(nombre, '') as nombre,
                    perfil,
                    activo,
                    COALESCE(DATE_FORMAT(ultimo_acceso,'%d/%m/%Y %h:%i %p'), '') as ultimo_acceso,
                    COALESCE(DATE_FORMAT(ultimo_logout,'%d/%m/%Y %h:%i %p'), '') as ultimo_logout,
                    COALESCE(DATE_FORMAT(fecha,'%d/%m/%Y %h:%i %p'), '') as fecha
                ")
                ->where(function($query) use ($searchTerm) {
                    $query->where('nombre', 'LIKE', '%' . $searchTerm . '%');
                });
            if ($estado != 'TT') {
                $query->where('activo', $estado);
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

    /**
     * Validar los campos recibidos en la solicitud.
     */
    private function validarCampos(Request $request)
    {
        return $request->validate([
            'username' => 'required|string|max:20',
            'nombre' => 'required|string|max:200',
            'perfil' => 'required|string|max:50',
            'password' => 'required|string|max:100',
            'activo' => 'nullable|boolean',
            'ultimo_acceso' => 'nullable|date',
            'ultimo_logout' => 'nullable|date',
            'fecha' => 'nullable|date'
        ]);
    }
    private function validarCampos2(Request $request)
    {
        return $request->validate([
            'nombre' => 'required|string|max:200',
            'perfil' => 'required|string|max:50',
            'activo' => 'nullable|boolean',
            'ultimo_acceso' => 'nullable|date',
            'ultimo_logout' => 'nullable|date',
            'fecha' => 'nullable|date'
        ]);
    }
}
