<?php

namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalSize extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'group_name'];

    public function sizeAttributes()
    {
        return $this->hasMany(AnimalSizeAttribute::class);
    }

    public function animal()
    {
        return $this->hasMany(Animal::class);
    }
}
