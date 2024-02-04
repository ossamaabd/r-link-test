<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialtyDoctor extends Model
{
    use HasFactory;
    protected $table = 'specialty_doctors';

    protected $guarded = [];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
    public function specialties()
    {
        return $this->hasMany(Specialty::class);
    }
}
