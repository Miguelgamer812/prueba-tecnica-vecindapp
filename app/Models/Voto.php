<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    public function option()
    {
        return $this->belongsTo(Opcion::class);
    }
}
