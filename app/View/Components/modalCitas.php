<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modalCitas extends Component
{
    
    public $modalId = '';
    public $modalTitle = '';
    public $routeForm = '';
    public $methodForm = '';
    public $dateCita = '';
    public $buttonSubmitText = '';
    public $formId = '';


    public function __construct(
        $modalId = '',
        $modalTitle = '',
        $routeForm = '',
        $dateCita = '',
        $buttonSubmitText = '',
        $methodForm = 'POST',
        $formId = ''
    )
    {



        $this->modalId = $modalId;
        $this->modalTitle = $modalTitle;
        $this->routeForm = $routeForm;
        $this->dateCita = $dateCita;
        $this->buttonSubmitText = $buttonSubmitText;
        $this->methodForm = $methodForm;
        $this->formId = $formId;
    }
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-citas');
    }
}
