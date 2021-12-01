<?php

namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalMarkType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc'];

    public function animalMarks()
    {
        return $this->hasMany(AnimalMark::class);
    }
}
