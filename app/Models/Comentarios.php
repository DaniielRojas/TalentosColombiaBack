<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Sanctum\HasApiTokens;

class Comentarios extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    
    protected $fillable = [  
     
        'id_usuario',
        'comentario',
        'calificacion',
        'commentable_type',
        'commentable_id',
        'fecha'
   
        ];
    
        public function commentable()
        {
            return $this->morphTo();
        }
    
        public function user()
        {
            return $this->belongsTo(User::class, 'id_usuario');
        }

}