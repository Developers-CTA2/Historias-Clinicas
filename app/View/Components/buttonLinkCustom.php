<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class buttonLinkCustom extends Component
{
    /**
     * Create a new component instance.
     */
    public $route;
    public $class;
    public $text;
    public $id;
    public $icon;
    public $tooltipText;


    public function __construct(
        string $route = '/home',
        string $class = 'btn-primary',
        string $text = '',
        string $id = '',
        string $icon = '',
        string $tooltipText = ''
    )
    {
        $this->route = $route;
        $this->class = $class;
        $this->text = $text;
        $this->id = $id;
        $this->icon = $icon;
        $this->tooltipText = $tooltipText;
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-link-custom');
    }
}
