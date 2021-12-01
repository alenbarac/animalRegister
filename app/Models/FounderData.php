<?php

namespace App\Models;

use App\Models\Shelter\Shelter;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FounderData extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }
}
