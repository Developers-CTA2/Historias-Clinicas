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
     public $paddingClass; // Define la propiedad correctamente
     public $onlyIcon;
 
     public function __construct(
         string $type = 'button',
         string $class = 'btn-primary',
         string $text = '',
         string $id = '',
         string $icon = '',
         string $tooltipText = '',
         bool $disabled = false,
         string $paddingClass = 'px-3 py-2', // Aquí mantenemos el nombre consistente
         bool $onlyIcon = false
     ) {

        dd($paddingClass);
         $this->type = $type;
         $this->class = $class;
         $this->text = $text;
         $this->id = $id;
         $this->icon = $icon;
         $this->tooltipText = $tooltipText;
         $this->disabled = $disabled;
         $this->onlyIcon = $onlyIcon;
         $this->paddingClass = $paddingClass; // Asegúrate de usar el mismo nombre
     }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-custom',
            [
                'type' => $this->type,
                'class' => $this->class,
                'text' => $this->text,
                'id' => $this->id,
                'icon' => $this->icon,
                'tooltipText' => $this->tooltipText,
                'disabled' => $this->disabled,
                'paddingClass' => $this->paddingClass, // Asegúrate de usar el mismo nombre
                'onlyIcon' => $this->onlyIcon
            ]
        );
    }
}
