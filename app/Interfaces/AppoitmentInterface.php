<?php

namespace App\Interfaces;

interface AppoitmentInterface
{
    public function dispalyAppointmentsByUser();
    public function displayAppointmentsByAdmin($request);
    public function searchAppointmentsByAdmin($request);
    public function createAppointmentByUser($request);
    public function acceptOrRejectedAppointmentByDoctor($request);
    public function cancelAppointmentByUser($request);


}
