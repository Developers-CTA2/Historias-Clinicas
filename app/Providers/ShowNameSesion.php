<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ShowNameSesion extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Mostrar el nombre de la sesion en todo el sistema
     *
     * @return void
     */
    public function boot()
    {
        // Usar un View Composer para compartir el nombre del usuario en todas las vistas
        View::composer('*', function ($view) {
            $view->with('userName', Auth::user()->name ?? null);
        });
    }
}
