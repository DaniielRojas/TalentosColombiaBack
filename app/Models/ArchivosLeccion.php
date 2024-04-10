<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ArchivosLeccion extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'archivos_leccion';
    protected $fillable = [
        'id_leccion',
        'tipo',
        'ubicacion',
    ];
}
