<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\V1\Producto as modelo_producto;

class productoLista extends Component
{
    public modelo_producto $producto;
    public int $cantidad;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $cantidad, modelo_producto $producto)
    {
        $this->producto = $producto;
        $this->cantidad = $cantidad;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.producto-lista');
    }
}
