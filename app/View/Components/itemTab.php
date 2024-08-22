<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class itemTab extends Component
{
    /**
     * Create a new component instance.
     */

     public $id;
     public $active;
     public $name;
     public $classCustom;

    public function __construct(
        string $id ,
        bool $active ,
        string $name ,
        string $classCustom = '' ,
    )
    {
        $this->id = $id;
        $this->active = $active;
        $this->name = $name;
        $this->classCustom = $classCustom;
        // dd($this->id, $this->active, $this->name, $this->classCustom);
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.item-tab');
    }
}
