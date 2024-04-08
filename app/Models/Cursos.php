<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cursos extends Model
{
    use HasFactory;

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       
    'id_docente',
    'id_categoria',
    'titulo',
    'descripcion',
    'imagen',
    'duracion',
    'estado',
    'fecha_inicio',
    'fecha_fin',
    ];


    public function comentarios()
    {
        return $this->morphMany(Comentarios::class, 'commentable');
    }


    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'id_categoria');
    }

    public function docente()
    {
        return $this->belongsTo(User::class, 'id_docente');
        
    }
    public function estudiantes()
    {
        return $this->belongsToMany(User::class, 'curso_estudiante', 'id_curso', 'id_estudiante');
    }
    public function lecciones()
    {
        return $this->hasMany(Lecciones::class, 'id_curso');
    }

}
