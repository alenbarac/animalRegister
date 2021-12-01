<?php

namespace App\Models\Animal;

use App\Models\Shelter\ShelterType;
use App\Models\Shelter\ShelterUnit;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shelter\ShelterNutrition;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnimalSystemCategory extends Model
{
    use HasFactory;

    public function shelterType()
    {
        return $this->belongsToMany(ShelterType::class);
    }

    public function shelterUnit()
    {
        return $this->belongsTo(ShelterUnit::class);
    }

    public function shelters()
    {
        return $this->belongsToMany(Shelter::class);
    }

    public function animalCategory()
    {
        return $this->hasMany(AnimalCategory::class);
    }
}
