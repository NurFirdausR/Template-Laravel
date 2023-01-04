<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectJenjangPendidikan extends Component
{
    public $isInline;
    public $label;
    public $value;
    public $type;
    public $name;
    public $id;
    public $labelRequired;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $isInline = false,
        $label = 'Jenjang Pendidikan',
        $value = "",
        $name = 'jenjang_pendidikan_id',
        $id = 'jenjang_pendidikan_id',
        $labelRequired = true
    ) {
        $this->isInline = $isInline;
        $this->label = $label;
        $this->value = $value;
        $this->name = $name;
        $this->id = $id;
        $this->labelRequired = $labelRequired;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-jenjang-pendidikan');
    }
}
