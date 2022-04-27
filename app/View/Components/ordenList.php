<?php

namespace App\View\Components;

use App\Models\V1\Ordenes;
use Illuminate\View\Component;

class ordenList extends Component
{
    public Ordenes $orden;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Ordenes $orden)
    {
        $this->orden = $orden;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.orden-list');
    }
}
