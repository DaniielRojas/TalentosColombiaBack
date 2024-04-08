<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEvaluacionesRequest extends FormRequest
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
            "id_docente" => ["required", "string"],
            "id_curso" => ["required", "string"],
            "tipo" => ["required", "string","max:255"],
            "titulo" => ["required", "string","max:255"],
            "descripcion" => ["required", "string"],
            "nota_maxima" => ["required", "string"],
            "fecha_inicio" => ["required", "string"],
            "fecha_fin" => ["required", "string"],
            "estado" => ["required", "boolean"],  
        ];
    }
}
