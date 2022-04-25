<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CarruselImg extends Component
{

    public array $imagenes;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $imagenes = [])
    {
        $this->imagenes = $imagenes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.carrusel-img');
    }
}
