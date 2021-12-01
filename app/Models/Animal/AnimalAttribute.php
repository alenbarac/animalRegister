<?php

namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalAttribute extends Model
{
    use HasFactory;

    public function animals()
    {
        return $this->belongsTo(Animal::class);
    }
}
