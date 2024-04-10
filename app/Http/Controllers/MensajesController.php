<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMensajesRequest;
use App\Http\Requests\UpdateMensajesRequest;
use App\Models\Mensajes;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MensajesController extends Controller
{
    public function index (): JsonResponse
    {
        try{
            $mensajes = Mensajes::all();
            return response()->json([
                'mensajes'=> $mensajes

            ]);

        }catch(Exception $e){
            return response()->json([
                'message' => 'error al obtener mensajes'
            ]);
        }        
    }

    public function show ($id): JsonResponse
    {
        try{
            $mensajes = Mensajes::findOrFail($id);

            return response()->json([
                'mensajes'=> $mensajes
            ]);

        }catch(ModelNotFoundException $e){
            return response()->json([
                'message'=>'mensaje no encontrado', $e->getMessage()

            ]);
        }catch(Exception $e){
            return response()->json([
                'message'=>'error al ver mensaje', $e->getMessage()
            ]);
        }
    }

    public function store (CreateMensajesRequest $request): JsonResponse
    {
        try{
         $data = $request->validated();

         $mensajes = Mensajes::create([
                'id_conversacion'=> $data['id_conversacion'],
                'id_usuario'=> $data['id_usuario'],
                'contenido'=> $data['contenido'],
                'fecha'=> $data['fecha'],
                'estado'=> $data['estado'],
         ]);

         return response()->json([
            'message'=> 'mensaje guardado correctamente',
            'token'=>$mensajes->createToken("token")->plainTextToken,
             'mensajes'=>$mensajes

         ], 201);
            
        }catch(ValidationException $e){
           $errors = $e->validator->errors();
            return response()->json([
                'message'=> 'error al guardar mensajes',
                'errors'=> $errors
            ], 422);

        }catch(Exception $e){
            return response()->json([
 
                'message'=> 'error al guardar mensajes ', $e->getMessage()
            ]);
        }
    }


    public function update (UpdateMensajesRequest $request, $id) : JsonResponse
    {
        try{
            $mensajes = Mensajes::findOrFail($id);
            $data = $request->validated();
            $mensajes->update([
                'id_conversacion'=> $data['id_conversacion'],
                'id_usuario'=> $data['id_usuario'],
                'contenido'=> $data['contenido'],
                'fecha'=> $data['fecha'],
                'estado'=> $data['estado'],                
            ]);
               return response()->json([
                'message'=> 'mensaje actulizado correctamente',
                'mensaje'=> $mensajes
               ],201);
        }catch(ModelNotFoundException $e){
                return response()->json([
                    'message' => 'mensaje no encontrado', $e->getMessage()
                ]);
        }catch(ValidationException $e){
                $errors = $e->validator->errors();
                return response ()->json([
                    'message' => 'error al actualizar mensaje', $e->getMessage(),
                    'errors' => $errors
                ]);
        }
    }

    public function destroy($id): JsonResponse
    {
        try{
          
          $mensajes =Mensajes::findOrFail($id);
          $mensajes->delete();

          return response()->json([
            'message'=> 'mensaje eliminado correctamente'

          ]);

        }catch(ModelNotFoundException $e){
            return response()->json([
                'message'=> 'el mensaje no existe', $e->getMessage()


            ]);    
    
        }catch(Exception $e){
            return response()->json([

                'message'=> 'error al eliminar mensaje', $e->getMessage()

            ]);
        }
    }
}
