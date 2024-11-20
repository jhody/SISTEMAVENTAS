<?php

namespace App\Http\Controllers;


use App\Models\Compra;
use App\Models\CompraDetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\UnidadMedida;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\MedioPago;
use Illuminate\Support\Facades\Auth;


class CompraController extends Controller
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
        $model = new Compra();
        $mediospago = MedioPago::all();
        return view('Compra.index', [
            'modo' => 'prod',
            'model' => $model,
            'unidades' => $unidades,
            'mediospago' => $mediospago,
        ]);
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


            $Compra=Compra::create($validatedData);

            $lstp = json_decode($request->input('detalle'), true);
            // Crear la Compra
            foreach ($lstp as $rowp1) {
                $CompraDetalle = new CompraDetalle([
                    'idproducto' => $rowp1['idproducto'],
                    'cantidad' => $rowp1['cantidad'],
                    'precio' => $rowp1['precio'],
                    'idcompra' => $Compra->id, // Asignar el ID de la Compra
                ]);

                // Asociar el detalle a la Compra
                $CompraDetalle->idcompra = $Compra->id;

                // Guardar el detalle
                if (!$CompraDetalle->save()) {
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
                'msj' => 'Compra emitida correctamente',
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
            $Compra = Compra::findOrFail($id);
            $Compra->update($validatedData);


            // Eliminar los detalles existentes
            CompraDetalle::where('idcompra', $Compra->id)->delete();

            $lstp = json_decode($request->input('detalle'), true);
            foreach ($lstp as $rowp1) {
                CompraDetalle::create([
                    'idcompra' => $Compra->id,
                    'idproducto' => $rowp1['idproducto'],
                    'producto' => $rowp1['producto'] ?? null,
                    'cantidad' => $rowp1['cantidad'],
                    'precio' => $rowp1['precio'],
                ]);
            }


            DB::commit();
            return response()->json([
                'msj' => 'Compra actualizada correctamente',
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
            $Compra = Compra::findOrFail($id);
            $Compra->delete();

            return response()->json([
                'msj' => 'Compra eliminada correctamente',
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
     * Buscar Compras en base a criterios.
     */
    public function buscar(Request $request)
    {
        $data = [
            "lista" => []
        ];

        try {
            $searchTerm = $request->input('cadena');
            $estado = $request->input('estado');
            $query = DB::table('Compra')
                ->selectRaw("
                    compra.id,
                    cliente.ruc cliente_ruc,
                    cliente.domicilio cliente_direccion,
                    cliente.razonsocial cliente,
                    cliente.correo cliente_correo,
                    cliente.contacto cliente_celular,
                    compra.tipodoc,
                    compra.serie,
                    compra.numero,
                    compra.idcliente,
                    DATE_FORMAT(compra.fecha,'%d/%m/%Y') as fecha,
                    compra.idmediopago,
                    compra.observaciones,
                    compra.total,
                    compra.estado,
                    compra.fechareg,
                    medio_pago.nombre mediopago
                ")
                ->join('medio_pago', 'compra.idmediopago', '=', 'medio_pago.id')
                ->join('cliente', 'compra.idcliente', '=', 'cliente.id')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('compra.serie', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('cliente.razonsocial', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('cliente.ruc', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('compra.numero', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('compra.observaciones', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('medio_pago.nombre', 'LIKE', '%' . $searchTerm . '%');
                });

            if ($estado && $estado !== 'TT') {
                $query->where('compra.estado', $estado);
            }

            $Compras = $query->orderByDesc('Compra.id')->get();

            // Agregar detalles de cada Compra
            $data["lista"] = $Compras->map(function ($Compra) {
                $CompraDetalles = DB::table('compra_detalle')
                    ->selectRaw('compra_detalle.idproducto,
                        producto.nombre producto, compra_detalle.cantidad,
                        compra_detalle.precio,
                        unidad_medida.nombre unidadmedida
                    ')
                    ->join('producto', 'compra_detalle.idproducto', '=', 'producto.id')
                    ->join('unidad_medida', 'producto.idunidad_medida', '=', 'unidad_medida.id')
                    ->where('compra_detalle.idcompra', $Compra->id)
                    ->get();

                $Compra->detalles = $CompraDetalles;
                return $Compra;
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
