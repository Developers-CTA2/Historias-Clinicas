<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class dataDiseasesAddPatient extends Component
{
    /**
     * Create a new component instance.
     */

     public $enfermedades;

    public function __construct(
        Collection $enfermedades
    )
    {
        $this->enfermedades = $enfermedades;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.data-diseases-add-patient');
    }
}
