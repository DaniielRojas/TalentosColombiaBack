<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConversacionesRequest;
use App\Http\Requests\UpdateConversacionesRequest;
use App\Models\Conversaciones;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ConversacionesController extends Controller
{
    public function index(): JsonResponse
    {
        try{
            $conversaciones =  Conversaciones::all();
            return response()->json([
                'conversaciones'=> $conversaciones
            ]);
        }catch(Exception $e){
         return response()->json([
            'error'=> $e->getMessage(), 'error al traer conversaciones'

         ]);
        }
    }

    public function show($id): JsonResponse
    {
        try{
            $conversaciones = Conversaciones::findOrFail($id);
            return response()->json([
                'conversaciones'=> $conversaciones

            ]);
        }catch(ModelNotFoundException $e){
            return response()->json([
                'error'=> $e->getMessage(), 'la conversacion no ha sido encontrada'
            ], 404);
        }catch(Exception $e){
            return response()->json([
                'error'=> $e->getMessage(), 'error al obtener la conversacion'

            ]);

        }


    }

    public function store(CreateConversacionesRequest $request): JsonResponse
    {
        try{
         $data = $request->validated(); 
         $conversaciones = Conversaciones::create([
            'id_tipo_conversacion' => $data['id_tipo_conversacion'],
            'fecha' => $data['fecha'],
            'estado' => $data['estado'],
         ]);
       return response()->json([
        'message' => 'conversacion guardada correctamente',
        'token' => $conversaciones->createToken("token")->plainTextToken,
        'conversaciones'=> $conversaciones
       ]);

        }catch(ValidationException $e){
            $errors = $e->validator->errors()->all();
            return response()->json([
                'error'=> $e->getMessage(),'error al guardar conversacion',
                'errors'=> $errors
            ], 500);
        }catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(), 'error al guardar conversacion'
            ], 501);
        }        
    }

    public function update(UpdateConversacionesRequest $request, $id): JsonResponse
    {
        try{
            $conversaciones = Conversaciones::findOrFail($id);
            $data = $request->validated();
            $conversaciones->update([
            'id_tipo_conversacion' => $data['id_tipo_conversacion'],
            'fecha' => $data['fecha'],
            'estado' => $data['estado'],
            ]);
            return response()->json([
                'message'=>'conversacion actualizada correctamente',
                'conversaciones'=>$conversaciones
            ], 201);


        }catch(ModelNotFoundException $e)
        {
            return response()->json([
                'message'=> $e->getMessage(),'conversacion no encontrada'

            ], 404);
        }catch(ValidationException $e){
            $errors = $e->validator->errors()->all();
            return response()->json([
                'message'=> $e->getMessage(), 'Error al guardar conversacion',
                'errors' => $errors

            ]);
        }
    }
    public function destroy($id): JsonResponse
    {
        try{
            $conversaciones = Conversaciones::findOrFail($id);
            $conversaciones->delete();
            return response()->json([
                'message'=> 'conversacion eliminada correctamente'
            ]);

        }catch(ModelNotFoundException $e){
            return response()->json([
                'message'=> $e->getMessage(),'conversacion no encontrada'

            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => 'error al eliminar la conversacion'
            ]);

        }

    }


}
