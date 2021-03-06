<?php

namespace App\View\Components;

use App\Models\V1\Producto as modelo_producto;
use Illuminate\View\Component;

class Producto extends Component
{
    public modelo_producto $producto;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(modelo_producto $producto)
    {
        $this->producto = $producto;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.producto');
    }
}
