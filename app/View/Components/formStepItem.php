<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class formStepItem extends Component
{
    /**
     * Create a new component instance.
     */

     public $active;
     public $haveTooltip;
     public $tooltipText;

    public function __construct(bool $active = false, bool $haveTooltip = false, string $tooltipText = '')
    {
        $this->active = $active;
        $this->haveTooltip = $haveTooltip;
        $this->tooltipText = $tooltipText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-step-item');
    }
}
