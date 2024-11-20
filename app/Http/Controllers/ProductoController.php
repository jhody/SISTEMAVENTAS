<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\UnidadMedida;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Mostrar la lista de productos.
     */
    public function index()
    {
        if (Auth::user()->perfil != 'administrador') {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }
        $unidades = UnidadMedida::all();
        $categorias = Categoria::all();
        $model = new Producto();
        return view('producto.index', [
            'modo' => 'prod',
            'model' => $model,
            'unidades' => $unidades,
            'categorias' => $categorias,
        ]);
    }

    /**
     * Crear un producto.
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos
            $validatedData = $this->validarCampos($request);

            // Asignar fecha de registro actual
            $validatedData['fechareg'] = Carbon::now();

            $request->validate([
                'codigo' => 'required|unique:producto,codigo|max:20', // Ajusta el nombre de la columna 'codigo_producto' según sea necesario
            ]);
            // Crear el producto
            Producto::create($validatedData);

            // Retornar respuesta JSON
            return response()->json([
                'msj' => 'Producto creado correctamente',
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
     * Actualizar un producto existente.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validar los datos
            $validatedData = $request->validate([
                'codigo' => 'nullable|string|max:500',
                'nombre' => 'required|string|max:500',
                'id_categoria' => 'required|integer|min:1',
                'stock' => 'required|numeric|min:0',
                'idunidad_medida' => 'required|integer|min:1',
                'precio_compra' => 'required|numeric|min:0',
                'precio_venta' => 'required|numeric|min:0',
                'estado' => 'nullable|boolean',
                'fechareg' => 'nullable|date',
            ]);

            // Buscar el producto y actualizar
            $producto = Producto::findOrFail($id);
            $producto->update($validatedData);

            return response()->json([
                'msj' => 'Producto actualizado correctamente',
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
     * Eliminar un producto.
     */
    public function destroy($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            $producto->delete();

            return response()->json([
                'msj' => 'Producto eliminado correctamente',
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
     * Buscar productos en base a criterios.
     */
    public function buscar(Request $request)
    {
        $data = [
            "lista" => []
        ];

        try {
            $searchTerm = $request->input('cadena');
            $estado = $request->input('estado');

            $query = DB::table('producto')
                ->selectRaw("
                    producto.id,
                    producto.codigo,
                    COALESCE(producto.nombre, '') as nombre,
                    producto.id_categoria,
                    COALESCE(producto.stock, 0) as stock,
                    COALESCE(producto.precio_compra, 0) as precio_compra,
                    COALESCE(producto.precio_venta, 0) as precio_venta,
                    COALESCE(producto.idunidad_medida, 0) as idunidad_medida,
                    COALESCE(producto.fechareg, '') as fechareg,
                    COALESCE(producto.estado, '') as estado,
                    COALESCE(unidad_medida.nombre, '') as unidad_medida,
                    COALESCE(categoria.categoria, '') as categoria
                ")
                ->join('unidad_medida', 'producto.idunidad_medida', '=', 'unidad_medida.id')
                ->join('categoria', 'producto.id_categoria', '=', 'categoria.id')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('producto.nombre', 'LIKE', '%' . $searchTerm . '%');
                });

            if ($estado != 'TT') {
                $query->where('producto.estado', $estado);
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
            'codigo' => 'nullable|string|max:500',
            'nombre' => 'required|string|max:500',
            'id_categoria' => 'required|integer|min:1',
            'stock' => 'required|numeric|min:0',
            'idunidad_medida' => 'required|integer|min:1',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'estado' => 'nullable|boolean',
            'fechareg' => 'nullable|date',
        ]);
    }
}
