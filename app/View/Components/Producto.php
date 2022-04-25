<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Producto extends Component
{
    public string $categoria;
    public string $nombre;
    public string $descripcion;
    public array $imagenes;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categoria, $nombre, $descripcion, $imagenes)
    {
        $this->categoria   = $categoria;
        $this->nombre      = $nombre;
        $this->descripcion = $descripcion;
        $this->imagenes    = $imagenes;
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
