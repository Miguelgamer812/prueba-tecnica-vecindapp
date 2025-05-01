<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'text', // agrega esto
    ];

    public function options()
    {
        return $this->hasMany(Opcion::class); // si usas el modelo en español
    }
}
