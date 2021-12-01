<?php

namespace App\Models\Animal;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AnimalItemLogType extends Model
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['type_name'];

    public function animalItemLogs()
    {
        return $this->hasMany(AnimalItemLog::class);
    }
}
