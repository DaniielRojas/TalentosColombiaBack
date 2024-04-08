<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateComentariosRequest extends FormRequest
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
            "id_usuario" => ["required"],
            "comentario" => ["required", "string"],
            "calificacion" => ["required", "numeric", "min:1", "max:5"],
            "commentable_type" => ["required"],
            "commentable_id" => ["required"],
            "fecha" => ["required", "string"],

        ];
    }
}
