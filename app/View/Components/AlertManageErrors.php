<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertManageErrors extends Component
{
    /**
     * Create a new component instance.
     */

    public $contClass;
    public $ListClass;


    public function __construct($contClass = '', $ListClass = 'errorList')
    {
        $this->contClass = $contClass;
        $this->ListClass = $ListClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert-manage-errors');
    }
}
