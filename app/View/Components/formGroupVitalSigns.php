<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class formGroupVitalSigns extends Component
{
    
    public $label;
    public $text;
    public $class;

    public function __construct(
        string $label = '',
        string $text = '',
        string $class = ''
    )
    {
        $this->label = $label;
        $this->text = $text;
        $this->class = $class;
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-group-vital-signs');
    }
}
