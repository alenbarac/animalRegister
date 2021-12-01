<?php

namespace App\Models\Animal;

use App\Models\Animal\Animal;
use App\Models\Shelter\Shelter;
use Spatie\MediaLibrary\HasMedia;
use App\Models\Animal\AnimalItem;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnimalGroup extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function shelters()
    {
        return $this->belongsToMany(Shelter::class)->where('active_group', 1);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function animalItems()
    {
        return $this->hasMany(AnimalItem::class)->where('in_shelter', 1);
    }

    public function animalGroupLogs()
    {
        return $this->hasMany(AnimalGroupLog::class);
    }
}
