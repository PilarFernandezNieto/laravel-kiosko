<?php

/** TODO:  php artisan make:model Producto --resource --api --migration CREA EL MODELO, LA MIGRACION Y EL CONTROLADOR CON LOS METODOS DE LA API */
namespace App\Http\Controllers;

use App\Http\Resources\ProductoCollection;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** para la paginación */
        // return new ProductoCollection(Producto::where('disponible', 1)->orderBy('id', 'desc')->paginate(10));
        return new ProductoCollection(Producto::where('disponible', 1)->orderBy('id', 'desc')->get());
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
    public function show(Producto $producto)
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
    public function destroy(Producto $producto)
    {
        //
    }
}
