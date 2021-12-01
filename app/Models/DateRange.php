<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateRange extends Model
{
    use HasFactory;

    public function animalItem()
    {
        return $this->belongsTo(AnimalItem::class);
    }
}
