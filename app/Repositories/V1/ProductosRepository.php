<?php

namespace App\Repositories\V1;

use App\Models\V1\Producto;
use App\Repositories\BaseRepository;

class ProductosRepository extends BaseRepository
{
    const RELATIONS = ['getImagenesRelation'];

    public function __construct(Producto $producto)
    {
        parent::__construct($producto, self::RELATIONS);
    }
}
