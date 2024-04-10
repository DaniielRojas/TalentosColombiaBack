<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TiposDeConversacion extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
     
    protected $table = 'tipos_de_conversacion';
    protected $fillable = [

        'nombre'
    ];
}
