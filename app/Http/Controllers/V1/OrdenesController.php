<?php

namespace App\Http\Controllers\V1;

use App\Repositories\V1\OrdenCompraRepository;
use App\Repositories\V1\CarroComprasRepository;
use Illuminate\Routing\Controller as BaseController;

class OrdenesController extends BaseController
{
    private $ordenRepositories;
    private $carroComprasRepositories;

    public function __construct(OrdenCompraRepository $ordenRepository, CarroComprasRepository $carroComprasRepository)
    {
        $this->ordenRepositories = $ordenRepository;
        $this->carroComprasRepositories = $carroComprasRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ordenes = $this->ordenRepositories->getOrdenesUsuario();
        return view('ordenes', ['ordenes' => $ordenes]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store($slug_carrito)
    {
        //consulto si hay un orden pendiente
        if (count($this->ordenRepositories->getOrdenPendiente()) > 0) {
            //si la hay redirige a listado de ordenes
            $ordenes = $this->ordenRepositories->getOrdenesUsuario();
            return view('ordenes', [
                'ordenes'        => $ordenes,
                'flag_pendiente' => true
            ]);
        } else {
            //si no la hay envia creacion de nueva orden
            //consultamos el carro de compras activo para el usuario autenticado
            $carrito = $this->carroComprasRepositories->getBySlug($slug_carrito);
            $total = $this->carroComprasRepositories->calcularTotalCarroCompras($carrito);
            return view('crear-orden', ["total_compra" => $total]);
        }
    }
}
