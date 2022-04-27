<?php

namespace App\Models\V1;

use App\Models\User;
use App\Models\OrdenVsProductos;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ordenes extends Model
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
        'id',
        'slug',
        'referencia',
        'codigo_usuario',
        'customer_name',
        'customer_email',
        'customer_mobile',
        'status',
        'estado',
        'created_at',
        'updated_at',
        'registro_usuario',
        'registro_usuario_actualizacion'
    ];

    public function getPivotProductosRelation()
    {
        return $this->hasMany(OrdenVsProductos::class, 'codigo_orden', 'id')
            ->where('orden_vs_productos.estado', "activo");
    }

    public function getUsuarioRelation()
    {
        return $this->belongsTo(User::class, 'codigo_usuario');
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

    public function getStatusCastAttribute()
    {
        switch ($this->status) {
            case 'created':
                return 'pendiente';
            case 'payed':
                return 'pago exitoso';
            case 'created':
                return 'rechazado';
        }
    }

    public function sluggable(): array
    {
        return [
            'slug' => ['source' => 'customSlug']
        ];
    }

    public function getCustomSlugAttribute()
    {
        return 'orden-' . substr(uniqid(), -10, -1);
    }
}
