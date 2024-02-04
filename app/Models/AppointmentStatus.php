<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentStatus extends Model
{
    use HasFactory;

    protected $table = 'appointment_statuses';

    protected $guarded = [];

    public function appointments()
    {
        return $this->hasMany(Appointment::class ,'status_id');
    }

}
