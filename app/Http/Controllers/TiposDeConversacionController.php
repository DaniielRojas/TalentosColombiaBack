<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTiposConversacionRequest;
use App\Http\Requests\UpdateTiposConversacionRequest;
use App\Models\TiposDeConversacion;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TiposDeConversacionController extends Controller
{
   public function index (): JsonResponse
   {
    try {
        $tiposConversacion = TiposDeConversacion::all();
        return response()->json([
            'tipos conversacion'=> $tiposConversacion
        ]);

    }catch(Exception $e)
    {
        return response()->json([
            'message'=> $e->getMessage(),'error al traer tipos de conversacion'

        ]);
    }
  }



  public function show ($id): JsonResponse

    {
       try{
        $tiposConversacion = TiposDeConversacion::findOrFail($id);
        return response()->json([
            'tipos conversacion'=> $tiposConversacion

        ]);
       }catch(ModelNotFoundException $e){
        return response()->json([
            'message'=> $e->getMessage(),'el tipo de conversacion no existe'
        ]);
       }catch(Exception $e)
       {
            return response()->json([
                'message'=> $e->getMessage(),'error al traer el tipo de conversacion'
            ]);

       }


    } 

    public function store(CreateTiposConversacionRequest $request): JsonResponse
    {
        try{
        $data = $request->validated();
        $tipoConversacion = TiposDeConversacion::create([
            'nombre'=> $data['nombre'],
        ]);    
        return response()->json([
            'message' => 'tipo de conversacion guardado correctamente',
            'token' => $tipoConversacion->createToken("token")->plainTextToken,
            'tipos de conversacion'=> $tipoConversacion
   
        ], 201);
        }catch(ValidationException  $e){
            $errors = $e->validator->errors()->all();
            return response()->json([
                'message'=> $e->getMessage(),'error al registrar tipo conversacion',
            
                
            ]);
        }catch(Exception $e){
            return response()->json([
                'message'=> $e->getMessage(),'error al registrar tipo conversacion'
            ]);
        }  
    }

    public function update(UpdateTiposConversacionRequest $request, $id): JsonResponse
    {
        
        try{
            $data = $request->validated();
            $tipoConversacion = TiposDeConversacion::findOrFail($id);
            $tipoConversacion->update([
                'nombre'=> $data['nombre'],
            ]);
            return response()->json([
                'message' => 'tipo de conversacion actualizado correctamente',
                'tipos de conversacion'=> $tipoConversacion
            ]);
        }catch(ModelNotFoundException $e){
            return response()->json([
                'message'=> $e->getMessage(),'el tipo de conversacion no existe'
            ]);
        }catch (ValidationException $e){
            $errors = $e->validator->errors()->all();
            return response()->json([
                'message'=> $e->getMessage(), 'error al guardar tipo de conversacion',
                'errors' => $errors
            ]);
        }

    }
    public function destroy($id): JsonResponse
    {
        try{
            $tipoConversacion = TiposDeConversacion::findOrFail($id);
            $tipoConversacion->delete();
            return response()->json([
               'message' => 'tipo de conversacion eliminado correctamente'
            ]);
        }catch(ModelNotFoundException $e){
            return response()->json([
               'message'=> $e->getMessage(),'el tipo de conversacion no existe'
            ]);
        }catch (ValidationException $e){
            $errors = $e->validator->errors()->all();
            return response()->json([
               'message'=> $e->getMessage(), 'error al eliminar tipo de conversacion',
                'errors' => $errors
            ]);
        }
    }

}