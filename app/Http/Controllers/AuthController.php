<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function store(CreateUserRequest $request):JsonResponse
    {
        try {

            $data = $request->validated();
            
            // Crear un nuevo usuario con los datos proporcionados
            $user = User::create([
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'numero_documento' => $data['numero_documento'],
                'usuario' => $data['usuario'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
                'direccion' => $data['direccion'],
                'id_tipo_documento' => $data['id_tipo_documento'],
                'id_rol' => $data['id_rol'],
                'imagen' => $data['imagen'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),


            ]);

            return response()->json([
                'message' => 'Usuario registrado correctamente',
                'token' => $user->createToken("token")->plainTextToken,
                'user' => $user
            ], 201); // Código de estado HTTP 201 para indicar éxito en la creación
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();

            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al registrar el usuario: ' . $e->getMessage(),
                'errors' => $errors
            ], 422); // Código de estado HTTP 422 para indicar una solicitud mal formada debido a errores de validación
        } catch (Exception $e) {
            // En caso de otros errores, devuelve un mensaje genérico de error
            return response()->json([
                'message' => 'Error al registrar el usuario: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }

    }


    public function login(LoginRequest $request)
    {
        /* Validar el login */
        $data = $request->validated();

    

        if (!Auth::attempt($data)) {
            return response([
                "errors" => ["El email o el password son incorrectos"]
            ], 422);
        }

        // Autenticar al usuario y cargar sus inscripciones
        $user = Auth::user()->load('cursoEstudiante');
        

        //Retornar un token
        return [
            "token" => $user->createToken("Token")->plainTextToken,
            "user" => $user
        ];
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return [
            "user" => null
        ];
    }
}
