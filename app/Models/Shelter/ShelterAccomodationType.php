<?php

namespace App\Models\Shelter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShelterAccomodationType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'type_mark', 'type_description'];

    public function shelterAccomodation()
    {
        return $this->hasMany(ShelterAccomodation::class);
    }
}
