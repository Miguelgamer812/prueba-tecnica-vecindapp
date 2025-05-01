<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
    ];

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }

    public function votes()
    {
        return $this->hasMany(Voto::class);
    }
}
