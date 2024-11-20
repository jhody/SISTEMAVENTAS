<?php

namespace App\Http\Controllers;


use App\Models\Venta;
use App\Models\VentaDetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\UnidadMedida;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\MedioPago;
use Illuminate\Support\Facades\Auth;


class VentaController extends Controller
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
        $unidades = UnidadMedida::all();
        $model = new Venta();
        $mediospago = MedioPago::all();
        return view('venta.index', [
            'modo' => 'prod',
            'model' => $model,
            'unidades' => $unidades,
            'mediospago' => $mediospago,
        ]);
    }
    public function verJsonGraficoIngresosXMeses()
    {
        try {
            date_default_timezone_set('America/Lima');
            $data = [];

            // Configurar nombres de mes en español
            DB::statement("SET lc_time_names = 'es_ES'");
            DB::statement("SET sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

            // Consulta de datos
            $results = DB::table('venta')
                    ->selectRaw("UPPER(DATE_FORMAT(fecha, '%M')) AS mes, IFNULL(SUM(total), 0) AS total")
                    ->whereYear('fecha', date("Y"))
                    ->where('estado', '!=', '9')
                    ->groupBy(DB::raw("DATE_FORMAT(fecha, '%M')"))
                    ->orderByRaw("MONTH(fecha)")
                    ->get();
            return response()->json($results);
        } catch (\Exception $e) {
            return response()->json([
                'error' => '1',
                'msj' => 'Ocurrió un error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function cargarDatosCabeceraSistema()
    {
        try {
            date_default_timezone_set('America/Lima');
            $data = [];


            // Total de ventas del día
            $data["total_ventas_dia"] = DB::table('venta')
                ->whereDate('fecha', now()->toDateString())
                ->where('estado', '!=', '9')
                ->sum('total');

            // Cantidad de productos
            $data["cantidad_productos"] = DB::table('producto')
                ->where('estado', '!=', '9')
                ->count();

            // Cantidad de pedidos del día
            $data["cantidad_pedidos_dia"] = DB::table('compra')
                ->whereDate('fecha', now()->toDateString())
                ->where('estado', '!=', '9')
                ->count();

            // Cantidad de clientes
            $data["cantidad_clientes"] = DB::table('cliente')
                ->count();

            // Cantidad de clientes anulados
            $data["cantidad_clientes_anulados"] = 0;

            // Cantidad de clientes activos
            $data["cantidad_clientes_activos"] = DB::table('cliente as u')
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('venta as su')
                        ->whereRaw('su.idcliente = u.id');
                })
                ->count();

            // Cantidad de clientes inactivos
            $data["cantidad_clientes_inactivos"] = $data["cantidad_clientes"]
                - $data["cantidad_clientes_anulados"]
                - $data["cantidad_clientes_activos"];

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => '1',
                'msj' => 'Ocurrió un error: ' . $e->getMessage(),
            ], 500);
        }
    }


	public function cargarYearsDeOrdenes()
	{
		try {
			$data = [];

			// Consulta para obtener los años distintos de la tabla 'venta'
			$rows = DB::table('venta')
				->selectRaw('DISTINCT YEAR(fecha) as year')
				->where('estado', '<>', '9')
				->get();

			// Construir el arreglo de resultados
			foreach ($rows as $i => $row) {
				$data[$i] = [
					"id" => $row->year,
					"parentid" => "",
					"text" => $row->year,
					"value" => $row->year,
				];
			}

			// Retornar como JSON
			return response()->json($data);
		} catch (\Exception $e) {
			return response()->json([
				'error' => '1',
				'msj' => 'Ocurrió un error: ' . $e->getMessage(),
			], 500);
		}
	}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction(); // Iniciar una transacción para asegurar consistencia

        try {
            // Validar los datos
            $fechaini=explode('/',trim($request['fecha']));
            if(sizeof($fechaini)==3){
                $year_gen=$fechaini[2];
                $mes_gen=$fechaini[1];
                $fechaini=$fechaini[2].'-'.$fechaini[1].'-'.$fechaini[0];
            }
            $request['fecha']=$fechaini;
            $validatedData = $this->validarCampos($request);


            // Asignar fecha de registro actual
            $validatedData['fechareg'] = Carbon::now();


            $venta=Venta::create($validatedData);

            $lstp = json_decode($request->input('detalle'), true);
            // Crear la venta
            foreach ($lstp as $rowp1) {
                $ventaDetalle = new VentaDetalle([
                    'idproducto' => $rowp1['idproducto'],
                    'cantidad' => $rowp1['cantidad'],
                    'precio' => $rowp1['precio'],
                    'idventa' => $venta->id, // Asignar el ID de la venta
                ]);

                // Asociar el detalle a la venta
                $ventaDetalle->idventa = $venta->id;

                // Guardar el detalle
                if (!$ventaDetalle->save()) {
                    DB::rollBack(); // Revertir la transacción en caso de error
                    return response()->json([
                        'msj' => 'Ocurrió un error al guardar detalle',
                        'error' => 0,
                    ], 500);
                }
            }

            DB::commit(); // Confirmar la transacción si todo es exitoso

            // Retornar respuesta JSON
            return response()->json([
                'msj' => 'Venta emitida correctamente',
                'error' => '0',
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Revertir la transacción en caso de excepción
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
        DB::beginTransaction();
        try {
            $fechaini=explode('/',trim($request['fecha']));
            if(sizeof($fechaini)==3){
                $year_gen=$fechaini[2];
                $mes_gen=$fechaini[1];
                $fechaini=$fechaini[2].'-'.$fechaini[1].'-'.$fechaini[0];
            }
            $request['fecha']=$fechaini;
            // Validar los datos
            $validatedData = $this->validarCampos($request);

            // Buscar la remisión y actualizar
            $venta = Venta::findOrFail($id);
            $venta->update($validatedData);


            // Eliminar los detalles existentes
            VentaDetalle::where('idventa', $venta->id)->delete();

            $lstp = json_decode($request->input('detalle'), true);
            foreach ($lstp as $rowp1) {
                VentaDetalle::create([
                    'idventa' => $venta->id,
                    'idproducto' => $rowp1['idproducto'],
                    'producto' => $rowp1['producto'] ?? null,
                    'cantidad' => $rowp1['cantidad'],
                    'precio' => $rowp1['precio'],
                ]);
            }


            DB::commit();
            return response()->json([
                'msj' => 'Venta actualizada correctamente',
                'error' => '0',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
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
            $venta = Venta::findOrFail($id);
            $venta->delete();

            return response()->json([
                'msj' => 'Venta eliminada correctamente',
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
     * Buscar ventas en base a criterios.
     */
    public function buscar(Request $request)
    {
        $data = [
            "lista" => []
        ];

        try {
            $searchTerm = $request->input('cadena');
            $estado = $request->input('estado');
            $query = DB::table('venta')
                ->selectRaw("
                    venta.id,
                    cliente.ruc cliente_ruc,
                    cliente.domicilio cliente_direccion,
                    cliente.razonsocial cliente,
                    cliente.correo cliente_correo,
                    cliente.contacto cliente_celular,
                    venta.tipodoc,
                    venta.serie,
                    venta.numero,
                    venta.idcliente,
                    DATE_FORMAT(venta.fecha,'%d/%m/%Y') as fecha,
                    venta.idmediopago,
                    venta.observaciones,
                    venta.total,
                    venta.estado,
                    venta.fechareg,
                    medio_pago.nombre mediopago
                ")
                ->join('medio_pago', 'venta.idmediopago', '=', 'medio_pago.id')
                ->join('cliente', 'venta.idcliente', '=', 'cliente.id')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('venta.serie', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('cliente.razonsocial', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('cliente.ruc', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('venta.numero', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('venta.observaciones', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('medio_pago.nombre', 'LIKE', '%' . $searchTerm . '%');
                });

            if ($estado && $estado !== 'TT') {
                $query->where('venta.estado', $estado);
            }

            $ventas = $query->orderByDesc('venta.id')->get();

            // Agregar detalles de cada venta
            $data["lista"] = $ventas->map(function ($venta) {
                $ventaDetalles = DB::table('venta_detalle')
                    ->selectRaw('venta_detalle.idproducto,
                        producto.nombre producto, venta_detalle.cantidad,
                        venta_detalle.precio,
                        unidad_medida.nombre unidadmedida
                    ')
                    ->join('producto', 'venta_detalle.idproducto', '=', 'producto.id')
                    ->join('unidad_medida', 'producto.idunidad_medida', '=', 'unidad_medida.id')
                    ->where('venta_detalle.idventa', $venta->id)
                    ->get();

                $venta->detalles = $ventaDetalles;
                return $venta;
            });

        } catch (\Exception $e) {
            $data['error'] = "1";
            $data['msj'] = "Ocurrió un error al listar";
            $data['info'] = $e->getMessage();
        }

        return response()->json($data);
    }

    public function validarCampos(Request $request)
    {
        return $request->validate([
            'tipodoc' => 'required|integer',
            'serie' => 'required|string|max:5',
            'numero' => 'required|string|max:20',
            'idcliente' => 'required|integer|exists:cliente,id',
            'fecha' => 'required|date',
            'idmediopago' => 'required|integer|exists:medio_pago,id',
            'observaciones' => 'nullable|string',
            'total' => 'required|numeric',
            'estado' => 'nullable|integer',
            'fechareg' => 'nullable|date',
        ]);
    }
}
