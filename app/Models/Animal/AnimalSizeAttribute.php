<?php

namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalSizeAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'base_price', 'group_price'];

    public function animalSize()
    {
        return $this->belongsTo(AnimalSize::class);
    }

    public function animalItem()
    {
        return $this->hasOne(AnimalItem::class);
    }
}