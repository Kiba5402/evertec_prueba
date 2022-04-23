<?php

namespace Database\Seeders\V1;

use App\Models\V1\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{

    const ID_ADMIN = 1;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creación del producto e imágenes asociadas
        $this->creaImagen(Producto::create([
            'nombre'                         => 'Caja misteriosa',
            'descripcion'                    => 'Caja que contiene objetos aleatorios valorados en 1000 pesos',
            'valor'                          => 1000,
            'estado'                         => 'activo',
            'registro_usuario'               => self::ID_ADMIN,
            'registro_usuario_actualizacion' => self::ID_ADMIN
        ]), ['img_1', 'img_2']);
    }

    private function creaImagen(Producto $producto = null, array $imagenes)
    {
        if ($producto)
            foreach ($imagenes as $img) {
                $producto->getImagenesRelation()->create([
                    'url'              => $img,
                    'estado'           => 'activo',
                    'registro_usuario' => self::ID_ADMIN,
                ]);
            }
    }
}
