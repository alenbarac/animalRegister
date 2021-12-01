<?php

namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AnimalItemLog  extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['animal_item_id', 'animal_log_type_id', 'log_subject', 'log_body'];

    public function animalItem()
    {
        return $this->belongsTo(AnimalItem::class);
    }
    public function logType()
    {
        return $this->belongsTo(AnimalItemLogType::class, 'animal_item_log_type_id');
    }
}
