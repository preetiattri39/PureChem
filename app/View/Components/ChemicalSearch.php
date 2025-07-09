<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ChemicalSearch extends Component
{
    /**
     * Create a new component instance.
     */

    public $title;
    public $placeholder;
    public $action;
    public $method;
    public $buttonText;
    public $formValue;
    public $required;

    public function __construct($title, $placeholder, $action, $method = 'POST', $buttonText = 'Search', $formValue, $required = true)
    {
        $this->title = $title;
        $this->placeholder = $placeholder;
        $this->formValue = $formValue;
        $this->action = $action;
        $this->method = strtoupper($method);
        $this->buttonText = $buttonText;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chemical-search');
    }
}
