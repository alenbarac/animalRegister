<?php

namespace App\Models\Shelter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ShelterEquipment extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['equipment_title', 'equipment_desc', 'shelter_id', 'shelter_equipment_type_id'];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }

    public function equipmentType()
    {
        return $this->belongsTo(ShelterEquipmentType::class, 'shelter_equipment_type_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(800)
            ->height(600)
            ->sharpen(10);
    }
}
