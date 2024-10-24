<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class buttonCustom extends Component
{
    /**
     * Create a new component instance.
     */

    
    public $text;
    public $icon;
    public $tooltipText;
    public $onlyIcon;


    public function __construct(
        string $text = '',
        string $icon = '',
        string $tooltipText = '',
        bool $onlyIcon = false
    ) {
        $this->text = $text;
        $this->icon = $icon;
        $this->tooltipText = $tooltipText;
        $this->onlyIcon = $onlyIcon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-custom');
    }
}
