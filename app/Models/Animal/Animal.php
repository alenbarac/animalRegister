<?php

namespace App\Models\Animal;

use App\Models\Shelter\Shelter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animal extends Model
{
    use HasFactory;

    protected $casts = ['id' => 'integer', 'animal_system_category_id' => 'integer', 'animal_size_id' => 'integer'];
    protected $fillable = ['animal_category_id', 'animal_size_id', 'name', 'latin_name'];

    public function animalCategory()
    {
        return $this->belongsTo(AnimalCategory::class)->with('animalSystemCategory');
    }

    public function animalAttributes()
    {
        return $this->hasMany(AnimalAttribute::class);
    }

    public function animalCodes()
    {
        return $this->belongsToMany(AnimalCode::class);
    }

    public function animalItems()
    {
        return $this->hasMany(AnimalItem::class);
    }

    public function shelters()
    {
        return $this->belongsToMany(Shelter::class)
            ->withPivot('quantity', 'shelter_code', 'id')
            ->withTimestamps();
    }

    public function animalType()
    {
        return $this->belongsToMany(AnimalType::class);
    }

    public function animalSize()
    {
        return $this->belongsTo(AnimalSize::class)->with('sizeAttributes');
    }
}
