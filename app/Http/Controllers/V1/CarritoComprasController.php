<?php

namespace App\Http\Controllers\V1;

use App\Models\V1\CarroCompras;
use App\Repositories\V1\ProductosRepository;
use App\Repositories\V1\CarroComprasRepository;
use Illuminate\Routing\Controller as BaseController;

class CarritoComprasController extends BaseController
{
    //Repositorios
    private $carroComprasRepositories;
    private $productoRepositories;

    public function __construct(CarroComprasRepository $_carroComprasRepositories, ProductosRepository $_productoRepositories)
    {
        //$this->middleware('auth');
        $this->carroComprasRepositories = $_carroComprasRepositories;
        $this->productoRepositories = $_productoRepositories;
    }

    //Esta funcion retorna el carro de compras activo para el usuario logueado
    public function carroComprasUsuario()
    {
        //consultamos el carro de compras activo para el usuario autenticado
        $carroComprasActivo = $this->carroComprasRepositories->carroComprasUsuarioActual();

        //retornamos el carro de compras a la vista
        return view('carrito-compras', [
            "carroCompras" => $carroComprasActivo
        ]);
    }


    //Esta funcion recibe el identificador slug del producto y la cantidad para ser agregado 
    //al carrito de compras
    public function adicionProducto($slug_producto, $cantidad)
    {
        //consultamos el carro de compras activo para el usuario autenticado
        $carroComprasActivo = $this->carroComprasRepositories->carroComprasUsuarioActual();
        $producto = $this->productoRepositories->getBySlug($slug_producto);

        //si no existe un carro activo lo creamos
        if (is_null($carroComprasActivo)) {
            $carroComprasActivo = $this->carroComprasRepositories->save(new CarroCompras([
                'codigo_usuario'   => auth()->user()->id,
                'estado'           => 'activo',
                'registro_usuario' => auth()->user()->id
            ]));
        }

        //ya con producto y carro asignamos el producto y lo retornamos
        if ($producto && $carroComprasActivo) {
            $carroComprasActivo = $this->carroComprasRepositories->adicionProducto($carroComprasActivo, $producto, $cantidad);
        }

        //retornamos el carro de compras a la vista
        return view('carrito-compras', [
            "carroCompras" => $carroComprasActivo
        ]);
    }
}
