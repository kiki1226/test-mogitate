<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BackButton extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $href;
    public $class;
    public function __construct($href = '/', $class = 'btn-back')
    {
        $this->href = $href;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.back-button');
    }
}
