<?php

namespace App\Repositories\V1;

use App\Models\V1\Producto;
use App\Models\V1\CarroCompras;
use App\Repositories\BaseRepository;
use App\Models\V1\CarroComprasVsProductos;

class CarroComprasRepository extends BaseRepository
{
    const RELATIONS = ['getProductosRelation'];

    public function __construct(CarroCompras $carroCompras)
    {
        parent::__construct($carroCompras, self::RELATIONS);
    }

    public function carroComprasUsuarioActual()
    {
        return CarroCompras::where('codigo_usuario', auth()->user()->id)
            ->where('estado', 'activo')->first();
    }

    public function adicionProducto(CarroCompras $carroCompras, Producto $producto, $cantidad = 1)
    {
        //Adición del producto al carro de compras, si ya existe actualiza la cantidad
        CarroComprasVsProductos::updateOrCreate(
            ['codigo_producto' => $producto->id, 'codigo_carro_compras' => $carroCompras->id],
            ['cantidad_producto' => $cantidad, 'estado' => 'activo']
        );

        return $carroCompras;
    }
}
