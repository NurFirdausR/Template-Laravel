<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormDinamis extends Component
{
    public $key;
    public $params;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($key, $params = [])
    {
        $this->key = $key;
        $this->params = $params;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-dinamis');
    }
}
