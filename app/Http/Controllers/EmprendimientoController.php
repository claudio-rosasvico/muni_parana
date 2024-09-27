<?php

namespace App\Http\Controllers;

use App\Models\Emprendimiento;
use App\Models\Emprendimiento_producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmprendimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Emprendimiento $emprendimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emprendimiento $emprendimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Emprendimiento $emprendimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emprendimiento $emprendimiento)
    {
        $productos = $emprendimiento->productos;
        foreach($productos as $producto){
            $producto->delete();
        }
        return $emprendimiento->delete();
    }

    public function deleteProdDelEmprendimiento(Request $request){
        Log::info($request);
        Emprendimiento_producto::where('producto_id', $request->producto_id)
                  ->where('emprendimiento_id', $request->emprendimiento_id)
                  ->delete();

        return "Registro eliminado correctamente.";
    }
}
