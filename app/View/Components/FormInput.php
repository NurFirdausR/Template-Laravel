<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInput extends Component
{

    public $label;
    public $value;
    public $type;
    public $name;
    public $id;
    public $class;
    public $listOption;
    public $labelRequired;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $label = 'Form label',
        $value = '',
        $type = 'text',
        $name = 'form_name',
        $id = 'form_id',
        $class = '',
        $listOption  = ['' => ''],
        $labelRequired = true,
    ) {
        $this->label = $label;
        $this->value = $value;
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
        $this->class = $class;
        $this->listOption = $listOption;
        $this->labelRequired = $labelRequired;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-input');
    }
}
