<?php

namespace App\Models\Shelter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShelterEquipmentType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'type_mark', 'type_description'];

    public function shelterEquipment()
    {
        return $this->hasMany(ShelterEquipment::class);
    }
}
