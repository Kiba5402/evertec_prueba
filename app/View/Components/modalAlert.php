<?php

namespace App\View\Components;

use Illuminate\View\Component;

class modalAlert extends Component
{
    public string $id;
    public string $titulo;
    public string $mensaje;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $titulo, $mensaje)
    {
        $this->id      = $id;
        $this->titulo  = $titulo;
        $this->mensaje = $mensaje;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-alert');
    }
}
