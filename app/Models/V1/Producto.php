<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
        'id',
        'slug',
        'nombre',
        'descripcion',
        'valor',
        'estado',
        'created_at',
        'updated_at',
        'registro_usuario',
        'registro_usuario_actualizacion'
    ];

    public function getImagenesRelation()
    {
        return $this->hasMany(ImagenesProducto::class, 'codigo_producto', 'id')->where('estado', 'activo');
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

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'nombre',
                'onUpdate' => true
            ]
        ];
    }
}
