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
}
