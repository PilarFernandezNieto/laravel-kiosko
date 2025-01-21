<?php

/** TODO:  php artisan make:model Producto --resource --api --migration CREA EL MODELO, LA MIGRACION Y EL CONTROLADOR CON LOS METODOS DE LA API */

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Http\Resources\ProductoCollection;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return "desde index";
        return new ProductoCollection(Producto::where('disponible', 1)->orderBy('id', 'desc')->get());

    }
    public function indexAdmin()
    {

        //return "desde indexAdmin";
        return new ProductoCollection(Producto::orderBy('id', 'desc')->paginate(9));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
        $data = $request->validated();
        $imagen = $request->imagen->store('imagenes', "public");

        $data['imagen'] = asset('storage/' . $imagen);

        $producto = Producto::create([
            'nombre' =>  $data['nombre'],
            'imagen' => $data['imagen'],
            'disponible' => $data['disponible'],
            'precio' => $data['precio'],
            'categoria_id' => $data['categoria_id']
        ]);

        return [
          'producto' =>$producto,
          'message' => "Producto creado correctamente"
        ];
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
        $producto->disponible = 0;
        $producto->save();
        return [
            'producto' => $producto
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
