<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
          try{
            $users = User::with('cursoEstudiante')->get();
            return response()->json([
              'users' => $users,

            ]);
          }catch(Exception $e){
            return response()->json([
              'error' =>'error al obtener usuaruios' . $e->getMessage()
            ],500);
        }   
}
    public function show($id): JsonResponse
    {
        try {
            // Buscar el usuario por su ID
            $user = User::with("cursoEstudiante")->findOrFail($id);

            // Devolver el usuario encontrado en formato JSON
            return response()->json([
                'user' => $user
            ]);
        } catch (ModelNotFoundException $e) {
            // Manejar la excepción si el usuario no existe
            return response()->json(['message' => 'El usuario no existe'], 404);
        } catch (Exception $e) {
            // Manejar cualquier otro error y devolver una respuesta de error
            return response()->json([
                'message' => 'Error al obtener el usuario: ' . $e->getMessage()
            ], 500);
        }
    }






     
    public function store(CreateUserRequest $request): JsonResponse
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

        public function update(UpdateUserRequest $request, $id): JsonResponse
        {
            try {
                // Encuentra el usuario por su ID
                $user = User::with('cursoEstudiante')->findOrFail($id);

                $data = $request->validated();

                // Actualizar el usuario con los datos proporcionados
                $user->update([
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
                $user->refresh();
                return response()->json([
                    'message' => 'Usuario actualizado correctamente',
                    "token" => $user->createToken("token")->plainTextToken,
                    'user' => $user
                ]);
            } catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'El usuario no existe'], 404);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors()->all();
                // En caso de error, devolver una respuesta JSON con un mensaje de error
                return response()->json([
                    'message' => 'Error al actualizar el usuario: ' . $e->getMessage(),
                    'errors' => $errors
                ], 422);
            }
            
        }

 
    public function destroy($id): JsonResponse
    {
        try {
            // Encuentra el usuario por su ID
            $user = User::findOrFail($id);

            // Eliminar el usuario
            $user->delete();

            return response()->json([
               'message' => 'Usuario eliminado correctamente'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'El usuario no existe'], 404);
        } catch (Exception $e) {
            // En caso de otros errores, devuelve un mensaje genérico de error
            return response()->json([
                'message' => 'Error al eliminar el usuario: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }
    }
}
