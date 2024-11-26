<?php

namespace App\Http\Controllers;

use App\Exports\EmprendedoresExport;
use App\Imports\EmprendedoresImport;
use App\Models\Emprendimiento;
use App\Models\Emprendedor;
use App\Models\Emprendedor_producto;
use App\Models\Emprendimiento_producto;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class EmprendedorController extends Controller
{
    public $emprendimientoController;

    public function __construct(EmprendimientoController $emprendimientoController)
    {
        $this->emprendimientoController = $emprendimientoController;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emprendedores = Emprendedor::where('activo', 1)->orderBy('venc_carnet', 'asc')->get();

        return view('emprendedor.index', ['emprendedores' => $emprendedores]);
    }
    
    public function indexInactivos()
    {
        $emprendedores = Emprendedor::where('activo', 0)->orderBy('venc_carnet', 'asc')->get();

        return view('emprendedor.noActivos', ['emprendedores' => $emprendedores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        return view('emprendedor.create', ['productos' => $productos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $emprendedor = Emprendedor::create([
            'user_id' => auth()->user()->id,
            'nro_expediente' => $request->nro_expediente,
            'anio_expediente' => $request->anio_expediente,
            'apellido' => $request->apellido,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'venc_carnet' => $request->venc_carnet,
            'activo' => $request->activo,
        ]);

        $emprendimiento = Emprendimiento::create([
            'emprendedor_id' => $emprendedor->id,
            'nombre' => $request->nombre_emprendimiento,
            'habilitacion' => $request->habilitacion,
        ]);

        $arrayProductos = json_decode($request->arrayProductos, true);
        foreach ($arrayProductos as $producto) {
            Emprendimiento_producto::create([
                'emprendimiento_id' => $emprendimiento->id,
                'producto_id' => $producto
            ]);
        }
        return redirect('/emprendedor')
            ->with('typeToast', 'success')
            ->with('titleToast', 'Excelente')
            ->with('messageToast', 'Emprendedor creado correctamente');
    }
    public function storeEmprendedor(Request $request)
    {

        $emprendedor = Emprendedor::create([
            'user_id' => (isset(auth()->user()->id)? auth()->user()->id: -1),
            'nro_expediente' => 'S/Expediente',
            'anio_expediente' => 1900,
            'apellido' => $request->apellido,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'venc_carnet' => $request->venc_carnet,
            'activo' => $request->activo,
        ]);

        $emprendimiento = Emprendimiento::create([
            'emprendedor_id' => $emprendedor->id,
            'nombre' => $request->nombre_emprendimiento,
            'habilitacion' => $request->habilitacion,
        ]);

        return redirect('/saludo');
    }


    /**
     * Display the specified resource.
     */
    public function show($idEmprendedor)
    {
        $emprendedor = Emprendedor::find($idEmprendedor);

        return view('emprendedor.show', ['emprendedor' => $emprendedor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($idEmprendedor)
    {
        $emprendedor = Emprendedor::find($idEmprendedor);
        $productos = Producto::all();
        $productosEmprendimiento = [];
        foreach ($emprendedor->emprendimiento->first()->productos as $producto) {
            array_push($productosEmprendimiento, $producto->producto_id);
        }

        return view('emprendedor.edit', [
            'emprendedor' => $emprendedor,
            'productos' => $productos,
            'productosEmprendimiento' => $productosEmprendimiento
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idEmprendedor)
    {
        $emprendedor = Emprendedor::find($idEmprendedor);
        $emprendedor->user_id = auth()->user()->id;
        $emprendedor->nro_expediente = (isset($request->nro_expediente)? $request->nro_expediente: 'S/Expediente');
        $emprendedor->anio_expediente = $request->anio_expediente;
        $emprendedor->apellido = $request->apellido;
        $emprendedor->nombre = $request->nombre;
        $emprendedor->telefono = $request->telefono;
        $emprendedor->email = $request->email;
        $emprendedor->venc_carnet = $request->venc_carnet;
        $emprendedor->activo = $request->activo == 'on'? 1 : 0;
        $emprendedor->save();

        $emprendimiento = $emprendedor->emprendimiento->first();
        $emprendimiento->nombre = $request->nombre_emprendimiento;
        $emprendimiento->habilitacion = $request->habilitacion;
        $emprendimiento->save();

        $arrayProductos = json_decode($request->arrayProductos, true);
        Log::info($request->arrayProductos);
        foreach ($arrayProductos as $producto) {
            Emprendimiento_producto::firstOrCreate([
                'emprendimiento_id' => $emprendimiento->id,
                'producto_id' => $producto
            ]);
        }

        $emprendedores = Emprendedor::orderBy('venc_carnet', 'asc')->get();
        /* return $request->activo; */
        
        if($emprendedor->activo){
            return redirect('/emprendedor')
                ->with('typeToast', 'success')
                ->with('titleToast', 'Excelente')
                ->with('messageToast', 'Emprendedor actualizado correctamente');
        } else {
            return redirect('/emprendedor/inactivo')
                ->with('typeToast', 'success')
                ->with('titleToast', 'Excelente')
                ->with('messageToast', 'Emprendedor actualizado correctamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idEmprendedor)
    {
        Log::info('Paso por emprendedorController');
        $emprendedor = Emprendedor::find($idEmprendedor);
        $emprendimientos = $emprendedor->emprendimiento;
        foreach ($emprendimientos as $emprendimiento) {
            $this->emprendimientoController->destroy($emprendimiento);
        }
        $emprendedor->delete();

        $emprendedores = Emprendedor::orderBy('venc_carnet', 'asc')->get();
        $emprendimientos = Emprendimiento::all();

        return response()->json(['emprendedores' => $emprendedores, 'emprendimientos' => $emprendimientos]);
    }

    public function validacionCampo(Request $request)
    {

        $existe = Emprendedor::where($request->campo, $request->valor)->exists();

        return response()->json($existe);
    }

    public function exportarImportar()
    {

        return view('emprendedor.exportarImportar');
    }

    public function exportEmprendedor()
    {

        return Excel::download(new EmprendedoresExport, 'emprendedores.xlsx');
    }

    public function importEmprendedores(Request $request)
    {
        $file = $request->file('emprendedores_importar');

        Excel::import(new EmprendedoresImport, $file);

        return redirect('/emprendedor')
            ->with('typeToast', 'success')
            ->with('titleToast', 'Excelente')
            ->with('messageToast', 'Emprendedores cargados correctamente');
    }
}
