<?php

namespace App\Models\V1;

use App\Models\V1\Producto;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImagenesProducto extends Model
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
        'id',
        'slug',
        'codigo_producto',
        'url',
        'estado',
        'created_at',
        'updated_at',
        'registro_usuario',
        'registro_usuario_actualizacion'
    ];

    public function getProductoRelation()
    {
        return $this->belongsTo(Producto::class, 'codigo_producto');
    }

    public function getRegistroUsuarioRelation()
    {
        return $this->belongsTo(User::class, 'registro_usuario');
    }

    public function getRegistroUsuarioActualizacionRelation()
    {
        return $this->belongsTo(User::class, 'registro_usuario_actualizacion');
    }

    public function getGetCreatedAtAttribute()
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }

    public function getGetUpdatedAtAttribute()
    {
        return $this->updated_at->format('Y-m-d H:i:s');
    }

    public function sluggable(): array
    {
        return [
            'slug' => ['source' => 'customSlug']
        ];
    }

    public function getCustomSlugAttribute()
    {
        return 'imagen-producto-' . substr(uniqid(), -10, -1);
    }
}
