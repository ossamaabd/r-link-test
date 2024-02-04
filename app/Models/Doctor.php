<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Authenticatable
{
    use HasFactory ,SoftDeletes, HasApiTokens;


    protected $table = 'doctors';

    protected $guarded = [];



    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'specialty_doctors');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
