<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarroComprasVsProductos extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_producto',
        'codigo_carro_compras',
        'cantidad_producto',
        'estado',
    ];
    
    public function getProductoRelation()
    {
        return $this->belongsTo(Producto::class, 'codigo_producto');
    }
}
