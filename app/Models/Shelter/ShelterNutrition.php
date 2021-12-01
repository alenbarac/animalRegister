<?php

namespace App\Models\Shelter;

use App\Models\Animal\AnimalSystemCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShelterNutrition extends Model
{
    use HasFactory;

    protected $fillable = ['nutrition_unit', 'nutrition_desc', 'shelter_id', 'animal_system_category_id'];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class)->with('animalSystemCategory');
    }

    public function animalSystemCategory()
    {
        return $this->belongsTo(AnimalSystemCategory::class);
    }
}
