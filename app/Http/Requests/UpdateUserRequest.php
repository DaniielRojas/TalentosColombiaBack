<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordRules;
use Illuminate\Validation\Rule;


class UpdateUserRequest extends FormRequest
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

        // Obtén el ID del usuario de la ruta de la URL
        $user_id = $this->route("usuario");

        return [
            "nombre" => "required|string|max:255",
            "apellido" => "required|string|max:255",
            "numero_documento" => "required|string|max:20", // Asegura que el número de documento sea único en la tabla "users"
            "usuario" => "required|string|max:255", // Asegura que el nombre de usuario sea único en la tabla "users"
            "email" => "required|string|email|max:255", // Asegura que el correo sea único en la tabla "users" y tenga formato de correo electrónico
            "password" =>  [
                "required",
                "confirmed",
                PasswordRules::min(8)->letters()->symbols()->numbers()
            ],
            "imagen" => "nullable|string", // Asegura que la imagen sea un archivo de imagen válido y tenga un tamaño máximo de 2MB
            "id_rol" => "required", // Asegura que el "rol_id" exista en la tabla "roles"
            "id_tipo_documento" => "required", // Asegura que el "documento_id" exista en la tabla "documentos"
            "fecha_nacimiento" => "required|string|max:255",
            "direccion" => "required|string|max:255"
        ];
    }
}
