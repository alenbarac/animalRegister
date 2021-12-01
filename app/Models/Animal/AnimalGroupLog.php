<?php

namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalGroupLog extends Model
{
    use HasFactory;

    public function animalGroup()
    {
        return $this->belongsTo(AnimalGroup::class);
    }
}
