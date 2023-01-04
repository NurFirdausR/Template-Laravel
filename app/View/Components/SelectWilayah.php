<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectWilayah extends Component
{
    public $isInline;
    public $listType;
    public $label;
    public $value;
    public $type;
    public $name;
    public $id;
    public $targetId;
    public $labelRequired;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $isInline = false,
        $listType = 'provinsi',
        $label = 'Provinsi',
        $value = "",
        $name = 'provinsi_id',
        $id = 'provinsi_id',
        $targetId = '#kabupaten_id',
        $labelRequired = true
    ) {
        $this->isInline = $isInline;
        $this->listType = $listType;
        $this->label = $label;
        $this->value = $value;
        $this->name = $name;
        $this->id = $id;
        $this->targetId = $targetId;
        $this->labelRequired = $labelRequired;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-wilayah');
    }
}
