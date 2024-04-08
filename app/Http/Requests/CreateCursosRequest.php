<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCursosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "titulo" => ["required", "string"],
            "fecha_inicio" => ["required", "string"],
            "fecha_fin" => ["required", "string"],
            "estado" => ["required", "boolean"],
            "imagen" => ["required", "string"],
            "descripcion" => ["required", "string"],
            "duracion" => ["required", "numeric"],
            "id_docente" => ["nullable", "exists:users,id"],
            "id_categoria" => ["nullable", "exists:categorias,id"],
        ];
    }
}
