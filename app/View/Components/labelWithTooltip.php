<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class labelWithTooltip extends Component
{
    /**
     * Create a new component instance.
     */

    public $labelFor;
    public $titleLabel;
    public $required;
    public $message;
    public $haveTooltip;
    // labelFor','titleLabel','required','message' => '','haveTooltip' => false

    public function __construct(
        string $labelFor ,
        string $titleLabel ,
        bool $required ,
        string $message = '' ,
        bool $haveTooltip = false,
    )
    {
        $this->labelFor = $labelFor;
        $this->titleLabel = $titleLabel;
        $this->required = $required;
        $this->message = $message;
        $this->haveTooltip = $haveTooltip;
    }
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.label-with-tooltip');
    }
}
