<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class dataAppAddPatient extends Component
{
    /**
     * Create a new component instance.
     */
    public $enfermedades;
    public $alergias;

    public function __construct(Collection $enfermedades, Collection  $alergias)
    {

                  
        $this->enfermedades = $enfermedades;
        $this->alergias = $alergias;

        // dd($this->enfermedades);
        // dd($this->alergias);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.data-app-add-patient');
    }
}
