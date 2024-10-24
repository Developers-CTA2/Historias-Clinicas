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
    public $text;
    public $icon;
    public $tooltipText;


    public function __construct(
        string $route = '/home',
        string $text = '',
        string $icon = '',
        string $tooltipText = ''
    )
    {
        $this->route = $route;
        $this->text = $text;
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
