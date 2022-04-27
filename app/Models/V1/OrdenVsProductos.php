<?php

namespace App\Models\V1;

use App\Models\V1\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrdenVsProductos extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_producto',
        'codigo_orden',
        'cantidad_producto',
        'estado',
    ];
    
    public function getProductoRelation()
    {
        return $this->belongsTo(Producto::class, 'codigo_producto');
    }
}
