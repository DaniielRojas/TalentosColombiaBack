<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Mensajes extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $fillable = [
        'id_conversacion',
        'id_usuario',
        'contenido',
        'fecha',
        'estado',
    ];

}
