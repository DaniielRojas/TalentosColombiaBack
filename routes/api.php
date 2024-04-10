<?php

use App\Http\Controllers\ArchivosLeccionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\ConversacionesController;
use App\Http\Controllers\CursoEstudianteController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\EvaluacionesController;
use App\Http\Controllers\LeccionesController;
use App\Http\Controllers\MatriculasController;
use App\Http\Controllers\MensajesController;
use App\Http\Controllers\NotasEstudiantesController;
use App\Http\Controllers\ParticipantesConversacionController;
use App\Http\Controllers\TiposDeConversacionController;
use App\Http\Controllers\UserController;
use App\Models\Conversaciones;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource("/usuarios", UserController::class);
    Route::apiResource("/evaluaciones", EvaluacionesController::class);
    Route::apiResource("/cursos", CursosController::class);
    Route::apiResource("/notas-estudiantes", NotasEstudiantesController::class);
    Route::apiResource("/matriculas", MatriculasController::class);
    Route::apiResource("/curso-estudiante", CursoEstudianteController::class);
    Route::apiResource("/lecciones", LeccionesController::class);
    Route::apiResource("/registro", AuthController::class);
    Route::apiResource("/categorias", CategoriasController::class );
    Route::apiResource("/comentarios", ComentariosController::class);
    Route::apiResource("/archivos-leccion", ArchivosLeccionController::class);
    Route::apiResource("/tipos-conversacion", TiposDeConversacionController::class);
    Route::apiResource("/conversaciones", ConversacionesController::class);
    Route::apiResource("/mensajes", MensajesController::class);
    Route::apiResource("/participantes-conversacion", ParticipantesConversacionController::class);
   
});
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/registro', [AuthController::class, 'store']);

