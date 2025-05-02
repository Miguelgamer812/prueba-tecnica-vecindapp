<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    public function option()
    {
        return $this->belongsTo(Opcion::class, 'option_id');
    }
    protected $fillable = [
        'option_id',
        'user_id',
        'pregunta_id',
    ];
}
