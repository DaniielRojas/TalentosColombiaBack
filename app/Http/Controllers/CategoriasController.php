<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCategoriaRequest;
use App\Http\Requests\CreateCategoriasRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorias;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $categorias = Categorias::with("cursos")->get();
          
            return response()->json([
                 'categorias' => $categorias


            ]);

        } catch (Exception $e) {

            return response()->json([
               'message' => 'Error al obtener las categorias: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse 
    {

        try {
            $categorias =Categorias::findOrFail($id);

            return response()->json([

                'categorias' => $categorias
            ]); 



        }catch (ModelNotFoundException $e) {
          return response()->json([

            'message' => $e->getMessage(),'el comentario no existe'   
          ],400);

        }catch (Exception $e)  {  
            return response()->json([
            
                'message' => 'Error al obtener el comentario', $e->getMessage()

          
            ]);


        }
           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoriasRequest $request): JsonResponse
    {
        try{
          $data = $request->validated();
          
          $categorias = Categorias:: create([
            'nombre' => $data['nombre']


          ]);

          return response()->json([
           'message' => 'Categoria registrada correctamente',
            'token' => $categorias->createToken("token")->plainTextToken,
            'categorias' => $categorias
          ], 201); // Código de estado HTTP 201 para indicar éxito en la creación


        }catch (ValidationException $e){
            $errors = $e->validator->errors()->all();

            return response()->json([
               'message' => 'Error al registrar la categoria: ' . $e->getMessage(),
                'errors' => $errors
            ], 422); // Código de estado HTTP 422 para indicar una solicitud mal formada debido a errores de validación


        }catch (Exception $exception){
            return response()->json([
               'message' => 'Error al registrar la categoria: ' . $exception->getMessage()
        ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }

    
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriaRequest $request, $id): JsonResponse
    {
        try{ 

            $categorias = Categorias::findOrFail($id);

            $data = $request->validated();
             
            $categorias->update([
                'nombre' => $data['nombre']

            ]);

            return response()->json([
               'message' => 'Categoria actualizada correctamente',
                'token' => $categorias->createToken("token")->plainTextToken,
                'categorias' => $categorias
            ], 201); // Código de estado HTTP 201 para indicar éxito en la creación
        }catch(ModelNotFoundException $e){

            return response()->json([
               'message' => $e->getMessage(),'el comentario no existe'
            ],400);

        }catch (ValidationException $e){
            $errors = $e->validator->errors()->all();
            return response()->json([
                'message'=> 'Error al actualizar categoria' . $e->getMessage(),
                'errors'=>$errors

            ], 422);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
      try {
        $categorias = Categorias::findOrFail($id);

        if (!$categorias)
        {
            return response()->json([
               'message' => 'La Categoria no existe'        
            ], 400);

        }   
        $categorias->delete();
        return response ()->json([
            'message'=> 'categoria eliminada correctamente '
        ]);
      }catch(Exception $e){
        return response ()->json([
            'message'=> 'Error al eliminar categoria'. $e->getMessage(),

        ], 500);
      }
    }
}
