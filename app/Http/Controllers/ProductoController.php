<?php

/** TODO:  php artisan make:model Producto --resource --api --migration CREA EL MODELO, LA MIGRACION Y EL CONTROLADOR CON LOS METODOS DE LA API */

namespace App\Http\Controllers;

use Log;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductoRequest;
use App\Http\Resources\ProductoCollection;

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
        return new ProductoCollection(Producto::orderBy('categoria_id', 'desc')->paginate(9));
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
            'producto' => $producto,
            'message' => "Producto creado correctamente"
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return $producto;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, Producto $producto)
    {
        $data = $request->validated();
        // Si se envió una nueva imagen, reemplazar la imagen existente
        if ($request->hasFile('imagen')) {
            $imagen = $request->imagen->store('imagenes', 'public');
            $data['imagen'] = asset('storage/' . $imagen);
        } else {
            // Mantener la imagen existente si no se envió una nueva
            $data['imagen'] = $producto->imagen;
        }

        // Actualizar el producto
        $producto->update([
            'nombre' => $data['nombre'],
            'imagen' => $data['imagen'],
            'disponible' => $data['disponible'] ?? $producto->disponible,
            'precio' => $data['precio'],
            'categoria_id' => $data['categoria_id'],
        ]);

        return [
            'producto' => $producto
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return [
            'producto' => $producto,
            'message' => "Producto eliminado correctamente"
        ];
    }
}
