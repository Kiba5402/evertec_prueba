<?php

namespace App\Repositories\V1;

use App\Models\V1\Ordenes;
use App\Repositories\BaseRepository;

class OrdenCompraRepository extends BaseRepository
{
    const RELATIONS = ['getPivotProductosRelation'];

    public function __construct(Ordenes $ordenes)
    {
        parent::__construct($ordenes, self::RELATIONS);
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

    public function cargaProductosCarroCompras()
    {
    }
}
