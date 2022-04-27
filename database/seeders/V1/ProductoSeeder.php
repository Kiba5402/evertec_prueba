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
            'descripcion'                    => 'Caja que contiene objetos aleatorios valorados en $100.000 pesos',
            'valor'                          => 100000,
            'estado'                         => 'activo',
            'registro_usuario'               => self::ID_ADMIN,
            'registro_usuario_actualizacion' => self::ID_ADMIN
        ]), ['images/productos/1/mistery-1.jpg', 'images/productos/1/mistery-2.jpg']);
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
