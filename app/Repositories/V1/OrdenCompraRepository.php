<?php

namespace App\Repositories\V1;

use App\Models\V1\Ordenes;
use App\Models\V1\CarroCompras;
use App\Repositories\BaseRepository;

class OrdenCompraRepository extends BaseRepository
{
    const RELATIONS = ['getPivotProductosRelation'];

    public function __construct(Ordenes $ordenes)
    {
        parent::__construct($ordenes, self::RELATIONS);
    }

    public function getOrdenReferencia($referencia)
    {
        return Ordenes::where('referencia', $referencia)->get();
    }

    public function getOrdenesUsuario()
    {
        return Ordenes::where('codigo_usuario', auth()->user()->id)->get();
    }

    public function getOrdenPendiente()
    {
        return Ordenes::where('codigo_usuario', auth()->user()->id)
            ->where('status', 'created')->get();
    }

    public function cargaProductosCarroCompras(CarroCompras $carroCompras, Ordenes $ordenCompra)
    {
        foreach ($carroCompras->getPivotProductosRelation as $pivote) {
            $ordenCompra->getPivotProductosRelation()->create([
                'codigo_producto'   => $pivote->getProductoRelation->id,
                'cantidad_producto' => $pivote->cantidad_producto,
                'estado'            => 'activo'
            ]);
        }
    }

    public function calcularTotalCarroCompras(Ordenes $orden)
    {
        $total = 0;
        foreach ($orden->getPivotProductosRelation as $pivote) {
            $total += $pivote->getProductoRelation->valor * $pivote->cantidad_producto;
        }
        return $total;
    }
}
