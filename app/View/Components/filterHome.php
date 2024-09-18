<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class filterHome extends Component
{
    public $months;
    public $years;
    public $idMonth;
    public $idYear;
    public $class;


    public function __construct($months, $years, $idMonth, $idYear, $class = '')
    {
        $this->months = $months;
        $this->years = $years;
        $this->idMonth = $idMonth;
        $this->idYear = $idYear;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filter-home');
    }
}
