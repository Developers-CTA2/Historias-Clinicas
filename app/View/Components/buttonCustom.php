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

    public $type;
    public $class;
    public $text;
    public $id;
    public $icon;
    public $tooltipText;
    public $disabled;
    public $padding;
    public $onlyIcon;


    public function __construct(
        string $type = 'button',
        string $class = 'btn-primary',
        string $text = '',
        string $id = '',
        string $icon = '',
        string $tooltipText = '',
        bool $disabled = false,
        string $padding = 'px-3 py-2',
        bool $onlyIcon = false
    )
    {
        $this->type = $type;
        $this->class = $class;
        $this->text = $text;
        $this->id = $id;
        $this->icon = $icon;
        $this->tooltipText = $tooltipText;
        $this->disabled = $disabled;
        $this->onlyIcon = $onlyIcon;
        $this->padding = $padding;
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-custom');
    }
}
