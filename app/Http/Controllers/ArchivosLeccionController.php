<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArchivosLeccionRequest;
use App\Http\Requests\UpdateArchivosLeccionRequest;
use App\Models\ArchivosLeccion;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ArchivosLeccionController extends Controller
{
    public function index(): JsonResponse
    {
          try{
            $archivos = ArchivosLeccion::all();
            return response()->json([
              'archivos' => $archivos,

            ]);
          }catch(Exception $e){
            return response()->json([
              'error' =>'error al obtener archivos' . $e->getMessage()
            ],500);
        }   
    }

    public function show($id): JsonResponse
    {
        try {

            $archivos = ArchivosLeccion::findOrFail($id);
            return response()->json([

                'archivos'=> $archivos

            ], 200);    
        }catch(ModelNotFoundException $e){
            return response ()->json([
                'message'=>$e->getMessage(), 'el archivo no existe'

            ],404);
        }catch(Exception $e){
             return response ()->json([
                'message'=>$e->getMessage(), 'error al encontrar el archivo'
                ],500);
                
    }
 }

public function store (CreateArchivosLeccionRequest $request): JsonResponse
{
  try {
    $data = $request->validated();
    $archivos = ArchivosLeccion::create([
      'id_leccion' => $data['id_leccion'],
      'tipo' => $data['tipo'],
      'ubicacion' => $data['ubicacion'],
    ]);
  return response ()->json([
    'message' => 'Archivos guardados correctamente',
    'token' => $archivos->createToken("token")->plainTextToken,
    'archivos'=> $archivos,
  ]); 
  }catch (ValidationException $e) {
    $errors = $e->validator->errors()->all();
    
    return response()->json([
     'message' => 'Error al registrar el archivo: ' . $e->getMessage(),
      'errors' => $errors
    ], 422); // Código de estado HTTP 422 para indicar una solicitud mal formada debido a errores de validación
  }catch (Exception $e) {
      return response()->json([
        'error' =>$e->getMessage(), 'error al obtener archivo'
      ]);
  }


}

public function update (UpdateArchivosLeccionRequest $request, $id): JsonResponse{

    try {
      $archivos = ArchivosLeccion::findOrFail($id);
      $data = $request->validated();
      $archivos->update([
        'id_leccion' => $data['id_leccion'],
        'tipo' => $data['tipo'],
        'ubicacion' => $data['ubicacion'],
      ]);
      return response()->json([
        'mesaage'=> 'Archivo actualizado correctamente',
        'token'=> $archivos->createToken('token')->plainTextToken,
        'archivos'=> $archivos,
      ]);


    }catch(ModelNotFoundException $e){
      return response()->json([
       'message' => $e->getMessage(), 'el archivo no existe'
      ],404);
    }catch(ValidationException $e){
      $errors = $e->validator->errors()->all();
      return response()->json([
       'message' => 'Error al actualizar el archivo: ' . $e->getMessage(),
        'errors' => $errors
      ], 422); // Código de estado HTTP 422 para indicar una solicitud mal formada debido a errores de validación
    }
  
}

  public function destroy ($id): JsonResponse
  {

     try {
      $archivos = ArchivosLeccion::findOrFail($id);

      $archivos->delete();

      return response()->json([
        'message'=> 'Archivo eliminado correctamente'
      ]);
     }catch (ModelNotFoundException $e){
      return response()->json([
        'message'=> $e->getMessage(), 'El Archivo no existe'
      ], 404);
     }catch(Exception $e){
      return response()->json([
        'message'=> $e->getMessage(), 'Error al eliminar el archivo'
      ], 500);
     }

  }





}
