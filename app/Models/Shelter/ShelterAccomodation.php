<?php

namespace App\Models\Shelter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ShelterAccomodation extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['shelter_id', 'shelter_accomodation_type_id', 'name', 'dimensions', 'description'];



    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }

    public function accommodationType()
    {
        return $this->belongsTo(ShelterAccomodationType::class, 'shelter_accomodation_type_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(800)
            ->height(600)
            ->sharpen(10);
    }
}
