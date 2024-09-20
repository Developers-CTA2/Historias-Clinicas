<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class formGroupDetailsConsultation extends Component
{
    
    public $label;
    public $icon;
    public $text;

    public function __construct(
        string $label = '',
        string $icon = '',
        string $text = ''
    )
    {
        $this->label = $label;
        $this->icon = $icon;
        $this->text = $text;
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-group-details-consultation');
    }
}
