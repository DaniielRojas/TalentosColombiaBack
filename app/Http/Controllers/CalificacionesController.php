<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCalificacionesRequest;
use App\Http\Requests\CreateCalificacionesRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calificaciones;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CalificacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $calificaciones = Calificaciones::all();
            return response()->json([
                 'calificaciones' => $calificaciones


                ]);
        }catch (Exception $e){
            return response()->json([

                'message' => 'error al obtener calificaciones'. $e->getMessage()
            ]);
        }
    }

  /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calificaciones  $calificaciones
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        try {
            $calificaciones = Calificaciones::findOrFail($id);

            return response()->json([

                'calificaciones' => $calificaciones
            ]);
        }catch(ModelNotFoundException $e){
            return response()->json([
                'message' =>'la calificacion no existe'. $e->getMessage()


            ], 400);
        }catch (Exception $e){

            return response()->json([
               'message' => 'error al obtener la calificacion'. $e->getMessage()
            ]);
        }

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCalificacionesRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $calificaciones = Calificaciones::create([
                'id_curso' => $data['id_curso'],
                'id_estudiante' => $data['id_estudiante'],
                'calificacion' => $data['calificacion']
            ]);

            return response()->json([
               'message' => 'calificacion registrada correctamente',
                'token' => $calificaciones->createToken("token")->plainTextToken,
                'calificaciones' => $calificaciones
            ], 201); // Código de estado HTTP 201 para indicar éxito en la creación
        } catch (ValidationException $e){
            $errors = $e->validator->errors()->all();

            return response()->json([
               'message' => 'Error al registrar la calificacion: ' . $e->getMessage(),
                'errors' => $errors
            ], 422); // Código de estado HTTP 422 para indicar una solicitud mal formada debido a errores de validación


        }catch (Exception $exception){
            return response()->json([
               'message' => 'Error al registrar la calificacion: ' . $exception->getMessage()
        ], 500); // Código de estado HTTP 500 para indicar un error del servidor

        }
    }

  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calificaciones  $calificaciones
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCalificacionesRequest $request, $id): JsonResponse
    {
       try{
       $calificaciones = Calificaciones::findOrFail($id);
       $data = $request->validated();

       $calificaciones->update([
        'id_curso' => $data['id_curso'],
        'id_estudiante' => $data['id_estudiante'],
        'calificacion' => $data['calificacion'] 
       ]);
    return response()->json([
       'message' => 'calificacion guardada correctamente',
        'token' => $calificaciones->createToken("token")->plainTextToken,
        'calificaciones' => $calificaciones
    ], 201); 
      }catch (ModelNotFoundException $e) {
        return response()->json([
            'message'=>$e->getMessage(), 'la calificacion no existe',


        ], 400);
      }catch(ValidationException $e){
        $errors = $e->validator->errors()->all();
        return response()->json([
            'message'=> 'Error al actualizar la nota'. $e->getMessage(),
            'errors' => $errors

        ]);


      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calificaciones  $calificaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        try {
            $calificaciones = Calificaciones::findOrFail($id);

            if(!$calificaciones){
                return response()->json([
                    'message'=> 'la calificacion no exite'


                ], 400);
            }
            $calificaciones->delete();
            return response()->json([
               'message' => 'calificacion eliminada exitosamente'

            ]);


        }catch(Exception $e){
            return response()->json([
                'message'=>$e->getMessage(),'error al eliminar nota'
            ], 500);
        }
    }
}
