<?php

namespace App\Models;

use App\Models\Animal\AnimalItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DateFullCare extends Model
{
    use HasFactory;

    protected $fillable = ['animal_item_id', 'start_date', 'end_date', 'days'];

    public function animalItem()
    {
        return $this->belongsTo(AnimalItem::class);
    }
}
