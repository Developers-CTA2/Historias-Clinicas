<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class formGroup extends Component
{
    /**
     * Create a new component instance.
     */

    public $class;
    public $id;

    public function __construct(
        string $class = '',
        string $id = ''
    ) {
        $this->class = $class;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-group');
    }
}
