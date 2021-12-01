<?php

namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use \Bkwld\Cloner\Cloneable;


class AnimalMark extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['animal_mark_type_id', 'animal_item_id', 'animal_mark_note'];
    protected $cloneable_relations = ['animalMarkType'];

    public function animalMarkType()
    {
        return $this->belongsTo(AnimalMarkType::class, 'animal_mark_type_id');
    }
    public function animalItem()
    {
        return $this->belongsTo(AnimalItem::class, 'animal_item_id');
    }
}
