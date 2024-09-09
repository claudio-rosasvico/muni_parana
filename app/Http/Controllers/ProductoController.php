<?php

namespace App\Http\Controllers;

use App\Models\Emprendedor;
use App\Models\Emprendimiento_producto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();

        return view('parametros.productos', ['productos' => $productos]);
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
        $producto_validated = $request->validate([
            'nombre' => 'required',
            'observaciones' => '',
        ]);    
        
        $producto = Producto::create($producto_validated);
        
        return redirect('/parametros/productos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idProducto)
    {
        $producto = Producto::find($idProducto);
        Emprendimiento_producto::where('producto_id', $idProducto)->delete();
        $producto->delete();

        $productos = Producto::all();
        $productosEmprendimientos = Emprendimiento_producto::all();
        return response()->json(['productos' => $productos, 'productosEmprendimientos' => $productosEmprendimientos]);
    }

    public function emprendimientoByProducto($idProducto){

        $producto = Producto::find($idProducto);
        $emprendimientos = $producto->emprendimientos;

        return view('parametros.emprendimientos_productos', ['producto' => $producto, 'emprendimientos' => $emprendimientos]);
    }

    public function showByEmprendedor($idEmprendedor){

        $emprendedor = Emprendedor::find($idEmprendedor);

        $productosEmprendedor = $emprendedor->productos;

        return response()->json($productosEmprendedor);
    }
}
