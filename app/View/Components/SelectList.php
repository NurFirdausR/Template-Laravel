<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectList extends Component
{
    public $isInline;
    public $label;
    public $value;
    public $type;
    public $name;
    public $id;
    public $labelRequired;
    public $url;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $isInline = false,
        $label = '',
        $value = "",
        $name = '',
        $id = '',
        $labelRequired = true,
        $url = ''
    ) {
        $this->isInline = $isInline;
        $this->label = $label;
        $this->value = $value;
        $this->name = $name;
        $this->id = $id;
        $this->labelRequired = $labelRequired;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-list');
    }
}
