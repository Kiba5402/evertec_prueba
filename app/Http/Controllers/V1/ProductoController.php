<?php

namespace App\Http\Controllers\V1;

use Illuminate\Routing\Controller;
use App\Repositories\V1\ProductosRepository;

class ProductoController extends Controller
{
     //Repositorios
    private $productoRepositories;

    public function __construct(ProductosRepository $_productoRepositories)
    {
        $this->productoRepositories = $_productoRepositories;
    }

    //Funcion que retorna todos los productos registrados en el sistema
    public function index()
    {
        $productos = $this->productoRepositories->all();
        return view('productos', ['productos' => $productos]);
    }
}
