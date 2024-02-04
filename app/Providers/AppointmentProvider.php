<?php

namespace App\Providers;

use App\Interfaces\AppoitmentInterface;
use App\Repository\AppoitmentRepository;
use Illuminate\Support\ServiceProvider;

class AppointmentProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AppoitmentInterface::class,AppoitmentRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
