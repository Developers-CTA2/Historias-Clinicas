<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class dataDrugsAddictionAddPatient extends Component
{
    /**
     * Create a new component instance.
     */
    public $toxicomanias;

    public function __construct(Collection $toxicomanias)
    {
        $this->toxicomanias = $toxicomanias;
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.data-drugs-addiction-add-patient');
    }
}
