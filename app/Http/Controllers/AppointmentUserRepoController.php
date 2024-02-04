<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointments\CreateAppointmentByUserRequest;
use App\Http\Requests\Appointments\CreateAppointmentRequest;
use App\Interfaces\AppoitmentInterface;
use Illuminate\Http\Request;

class AppointmentUserRepoController extends Controller
{
    private $repo;
    public function  __construct(AppoitmentInterface $popupRepository)
    {
        $this->repo = $popupRepository;
    }

    public function dispalyAppointmentsByUser(){
        return $this->repo->dispalyAppointmentsByUser();
    }
    public function displayAppointmentsByAdmin(Request $request){
        return $this->repo->displayAppointmentsByAdmin($request);
    }
    public function searchAppointmentsByAdmin(Request $request){
        return $this->repo->searchAppointmentsByAdmin($request);
    }
    public function createAppointmentByUser(CreateAppointmentByUserRequest $request){
        return $this->repo->createAppointmentByUser($request);
    }
    public function acceptOrRejectedAppointmentByDoctor(Request $request){
        return $this->repo->acceptOrRejectedAppointmentByDoctor($request);
    }
    public function cancelAppointmentByUser(Request $request){
        return $this->repo->cancelAppointmentByUser($request);
    }
}
