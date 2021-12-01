<?php

namespace App\Models\Shelter;

use Illuminate\Database\Eloquent\Model;
use App\Models\Animal\AnimalSystemCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShelterType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function shelters()
    {
        return $this->belongsToMany(Shelter::class);
    }

    public function animalSystemCategory()
    {
        return $this->belongsToMany(AnimalSystemCategory::class);
    }
}
