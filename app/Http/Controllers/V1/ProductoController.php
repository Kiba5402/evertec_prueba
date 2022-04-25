<?php

namespace App\Http\Controllers\V1;

use Illuminate\Routing\Controller;
use App\Repositories\V1\ProductosRepository;

class ProductoController extends Controller
{
    private $productoRepositories;

    public function __construct(ProductosRepository $_productoRepositories)
    {
        $this->productoRepositories = $_productoRepositories;
    }

    public function index()
    {
        $productos = $this->productoRepositories->all();
        return view('productos', ['productos' => $productos]);
    }
}
