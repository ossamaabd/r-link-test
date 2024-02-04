<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $table = 'specialties';

    protected $guarded = [];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'specialty_doctors');
    }

}
