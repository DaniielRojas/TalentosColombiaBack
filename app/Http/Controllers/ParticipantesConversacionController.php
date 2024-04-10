<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePartcipantesConversacionesRequest;
use App\Http\Requests\UpdatePartcipantesConversacionesRequest;
use App\Models\Conversaciones;
use App\Models\ParticipantesConversacion;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ParticipantesConversacionController extends Controller
{
    public function index(): JsonResponse
    {
        try{
            $participantesConversacion = ParticipantesConversacion::all();
            return response()->json([
                'participantes'=>$participantesConversacion
            ]);
        }catch(Exception $e){
             return response()->json([
                'message' => 'error al obtener participantes', $e->getMessage()

        ]);
        }
        
    }

    public function show ($id): JsonResponse
    {
        try{
        $participantesConversacion = ParticipantesConversacion::findOrFail($id);

            return response()->json([
                'particpantes'=>$participantesConversacion

            ]);           

        }catch(ModelNotFoundException $e){
            return response()->json([
                'message'=> 'partcipante no encontrado', $e->getMessage()

            ], 404);
        }
    }

    public function store (CreatePartcipantesConversacionesRequest $request): JsonResponse
    {
        try{
            $data = $request->validated();
            $participantesConversacion = ParticipantesConversacion::create([
                    'id_conversacion'=> $data['id_conversacion'],
                    'id_usuario'=> $data['id_usuario'],
            ]);
            return response()->json([
                'message'=>'partcipante guardado correctamente',
                'token' => $participantesConversacion->createToken('token')->plainTextToken,
                'participantes' => $participantesConversacion,

            ], 201);
        }catch(ValidationException $e){
            $errors = $e->validator->errors()->all();
            return response()->json([
                'message'=> 'error al guardar participante', $e->getMessage()

            ], 501);
        }catch(Exception $e)
        {
            return response()->json([
                'message'=> 'error al guardar participante', $e->getMessage()
            ]);
        }
    }

    public function update(UpdatePartcipantesConversacionesRequest $request, $id): JsonResponse
    {
        try{
         
            $data = $request->validated();

            $participantesConversacion = ParticipantesConversacion::findOrFail($id);

            $participantesConversacion-> update([
                'id_conversacion'=> $data['id_conversacion'],
                'id_usuario'=> $data['id_usuario'],

            ]);
            return response()->json([
                'message' => 'participante actualizado correctamente'
            ]);
        }catch(ModelNotFoundException $e){
            return response()->json([
                'message'=> 'participante no encontrado', $e->getMessage()
            ]);
        }catch(ValidationException $e){
            $errors = $e->validator->errors()->all();
            return response()->json([
                'message'=> 'error al actalizar participante', $e->getMessage()
            ]);
        }
    }


    public function destroy($id): JsonResponse
    {
        try
        {
            $ParticipantesConversacion = ParticipantesConversacion::findOrFail($id);
            $ParticipantesConversacion->delete();
            return response()->json([
                'message'=> 'participante eliminado correctamente'

            ]);
        }catch(ModelNotFoundException $e){
            return response()->json([
                'message'=> 'participante no encontrado', $e->getMessage()
            ]);
        }catch(Exception $e){
            return response()->json([
                'message'=> 'error al eliminar usuario', $e->getMessage()
            ]);
        }
    }
}