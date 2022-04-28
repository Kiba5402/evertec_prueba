<?php

namespace App\View\Components;

use App\Models\V1\Ordenes;
use Illuminate\View\Component;
use phpDocumentor\Reflection\Types\Boolean;

class ordenList extends Component
{
    public Ordenes $orden;
    public bool $admin;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Ordenes $orden, $admin = false)
    {
        $this->orden = $orden;
        $this->admin = $admin;
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
