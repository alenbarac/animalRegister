<?php

namespace App\Models\Shelter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShelterStaffType extends Model
{
    use HasFactory;

    public function shelterStaff()
    {
        return $this->belongsTo(ShelterStaff::class);
    }
}
