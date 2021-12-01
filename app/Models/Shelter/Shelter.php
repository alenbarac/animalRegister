<?php

namespace App\Models\Shelter;

use App\Models\User;
use App\Models\FounderData;
use App\Models\Animal\Animal;
use App\Models\Animal\AnimalItem;
use App\Models\Animal\AnimalGroup;
use Illuminate\Database\Eloquent\Model;
use App\Models\Animal\AnimalSystemCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shelter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function shelterTypes()
    {
        return $this->belongsToMany(ShelterType::class);
    }

    public function animalSystemCategory()
    {
        return $this->belongsToMany(AnimalSystemCategory::class);
    }

    public function users()
    {
        return $this->hasMany(User::class)->with('roles');
    }

    public function animalGroups()
    {
        return $this->belongsToMany(AnimalGroup::class)->where('active_group', 1)->with('animal');
    }

    public function shelterStaff()
    {
        return $this->hasMany(ShelterStaff::class);
    }

    public function accomodations()
    {
        return $this->hasMany(ShelterAccomodation::class);
    }

    public function nutritionItems()
    {
        return $this->hasMany(ShelterNutrition::class);
    }

    public function getRegisterDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('m/d/Y');
    }

    public function founder()
    {
        return $this->hasMany(FounderData::class);
    }
}
