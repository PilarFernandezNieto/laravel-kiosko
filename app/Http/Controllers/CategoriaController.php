<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Http\Resources\CategoriaCollection;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        // return response()->json([
        //     'categorias' => Categoria::all()
        // ]);

        return new CategoriaCollection(Categoria::all());
    }

    public function store(CategoriaRequest $request)
    {
        $data = $request->validated();
        $icono = $request->icono->store('imagenes', "public");

        $data['icono'] = asset('storage/' . $icono);

        $categoria = Categoria::create([
            'nombre' =>  $data['nombre'],
            'icono' => $data['icono']
        ]);
        return [
            'categoria' => $categoria,
            'message' => "Categoría creada correctamente"
        ];
    }

       /**
     * Display the specified resource.
     */
    public function show(Categoria  $categoria)
    {
        return $categoria;
    }
        /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        $data = $request->validated();
        // Si se envió un nueva icono, reemplazar el icono existente
        if ($request->hasFile('icono')) {
            $icono = $request->icono->store('imagenes', 'public');
            $data['icono'] = asset('storage/' . $icono);
        } else {
            // Mantener el icono existente si no se envió uno nuevo
            $data['icono'] = $categoria->icono;
        }

        // Actualizar la categoria
        $categoria->update([
            'nombre' => $data['nombre'],
            'icono' => $data['icono'],
        ]);

        return [
            'categoria' => $categoria,
            'message' => 'Categoría actualizada correctamente'
        ];
    }
}
