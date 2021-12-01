<?php

namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalOrder extends Model
{
    use HasFactory;

    protected $fillable = ['order_name', 'animal_system_category_id'];

    public function animalSystemCategory()
    {
        return $this->belongsTo(AnimalSystemCategory::class);
    }

    public function animalCategory()
    {
        return $this->hasMany(AnimalCategory::class);
    }

    public function animalSizes()
    {
        return $this->hasMany(AnimalSize::class);
    }
}