<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class itemContentTabPane extends Component
{
    /**
     * Create a new component instance.
     */

     public $active;
    public $id;

    public function __construct(string $id = '', bool $active = false)
    {
        $this->id = $id;
        $this->active = $active;
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.item-content-tab-pane');
    }
}
