<?php

namespace App\Http\Controllers;

use App\Models\Capacitacion;
use App\Models\Emprendedor;
use App\Models\Emprendedor_capacitacion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CapacitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $capacitaciones = capacitacion::all();
        return view('capacitaciones.index', ['capacitaciones' => $capacitaciones]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('capacitaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $capacitacion = Capacitacion::create([
            'nombre' => $request->nombre,
            'ubicacion' => $request->ubicacion,
            'docente' => $request->docente,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'observaciones' => $request->observaciones
        ]);

        return redirect('/capacitacion');
    }

    /**
     * Display the specified resource.
     */
    public function show( $idCapacitacion)
    {
        $capacitacion = Capacitacion::find($idCapacitacion);

        return view('capacitaciones.show', ['capacitacion' => $capacitacion, 'emprendedores' => Emprendedor::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($idCapacitacion)
    {
        $capacitacion = Capacitacion::find($idCapacitacion);

        return view('capacitaciones.edit', ['capacitacion' => $capacitacion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idCapacitacion)
    {
        $capacitacion = Capacitacion::find($idCapacitacion);
        $capacitacion->nombre = $request->nombre;
        $capacitacion->ubicacion = $request->ubicacion;
        $capacitacion->docente = $request->docente;
        $capacitacion->fecha = $request->fecha;
        $capacitacion->hora = $request->hora;
        $capacitacion->observaciones = $request->observaciones;
        $capacitacion->save();

        return redirect('/capacitacion');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idCapacitacion)
    {
        $capacitacion = Capacitacion::find($idCapacitacion);
        $capacitacion->delete();

        return redirect('/capacitacion');
    }

    public function obtenerEmprendedores($idCapacitacion){

        $emprendedores = Emprendedor::whereHas('capacitaciones', function (Builder $query) use ($idCapacitacion) {
            $query->where('capacitacion_id', $idCapacitacion);
        })->with('emprendimiento')->get();

        return response()->json(['emprendedores' => $emprendedores]);
    }

    public function sumaEmprendedor(Request $request){

        $existeEmprendedor = Emprendedor_capacitacion::where('emprendedor_id', $request->idEmprendedor)
        ->where('capacitacion_id', $request->idCapacitacion)
        ->exists();

        if($existeEmprendedor){
            return false;
        } else {
            Emprendedor_capacitacion::create(['emprendedor_id' => $request->idEmprendedor, 'capacitacion_id' => $request->idCapacitacion]);
    
            return $this->obtenerEmprendedores($request->idCapacitacion);
        }

    }

    public function deleteEmprendedorCapacitacion(Request $request){

        Emprendedor_capacitacion::where('emprendedor_id', $request->idEmprendedor)
        ->where('capacitacion_id', $request->idCapacitacion)
        ->delete();

        return $this->obtenerEmprendedores($request->idCapacitacion);
    }
}
