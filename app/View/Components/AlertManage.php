<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertManage extends Component
{
    /**
     * Create a new component instance.
     */
    public $containerClass;
    public $textClass;

    public function __construct($containerClass = 'Diseases', $textClass = 'Disease-Text')
    {
        $this->containerClass = $containerClass;
        $this->textClass = $textClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert-manage');
    }
}
