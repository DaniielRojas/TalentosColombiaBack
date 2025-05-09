<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Categorias extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'categorias';
    protected $fillable = [
        'nombre',
    ];

    public function cursos()
    {
        return $this->hasMany(Cursos::class, 'id_categoria');
    }
}