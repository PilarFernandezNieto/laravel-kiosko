<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion
        ];
    }
}
/** ESTE ARCHIVO TE PERMITE MOSTRAR LOS DATOS QUE NECESITAS: CLAVE-VALOR
 *  DA CONTROL TOTAL SOBRE LOS DATOS QUE QUIERES ENVIAR EN LA RESPUSTA
*/
