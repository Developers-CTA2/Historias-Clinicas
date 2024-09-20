<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class dataPersonalAddPatient extends Component
{
    /**
     * Create a new component instance.
     */

     public $hemotipos;
     public $escolaridades;
     public $estados;


    public function __construct(
        Collection $hemotipos,
        Collection $escolaridades,
        Collection $estados
    )
    {
        // dd($hemotipos);

        $this->hemotipos = $hemotipos;
        $this->escolaridades = $escolaridades;
        $this->estados = $estados;
    }
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.data-personal-add-patient');
    }
}
