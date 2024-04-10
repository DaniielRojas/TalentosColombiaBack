<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordRules;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nombre" => ["required", "string"],
            "apellido" => ["required", "string"],
            "numero_documento" => ["required", "string"],
            "usuario" => ["required", "string", "unique:users,usuario"],
            "fecha_nacimiento" => ["required", "string"],
            "direccion" => ["required", "string"],
            "imagen" => ["required", "string"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => [
                "required",
                "confirmed",
                PasswordRules::min(8)->letters()->symbols()->numbers()
            ],
            "id_rol" =>  ["required"], // Asegura que el "rol_id" exista en la tabla "roles"
            "id_tipo_documento" =>  ["required"], // Asegura que el 'documento_id' exista en la tabla 'documentos'

        ];
    }
}