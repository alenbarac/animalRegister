<?php

namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalCategory extends Model
{
    use HasFactory;

    protected $fillable = ['animal_system_category_id', 'animal_order_id', 'latin_name'];

    public function animalSystemCategory()
    {
        return $this->belongsTo(AnimalSystemCategory::class);
    }

    public function animalOrder()
    {
        return $this->belongsTo(AnimalOrder::class);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
