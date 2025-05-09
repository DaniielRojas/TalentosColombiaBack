<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateteLeccionesRequest extends FormRequest
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
            "id_docente" => ["nullable", "exists:users,id"],
            "id_curso" => ["nullable", "exists:cursos,id"],
            "titulo" => ["required", "string"],
            "descripcion" => ["required", "string"],
            "contenido" => ["required", "string"],
            "estado" => ["required", "boolean"],
            "imagen" => ["required", "string"],
            "fecha_inicio" => ["required", "string"],
            "fecha_fin" => ["required", "string"],
        ];
    }
}
