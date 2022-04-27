<?php

namespace App\Http\Controllers\V1;

use App\Models\V1\Ordenes;
use Illuminate\Http\Request;
use App\Models\V1\PaymentInfo;
use App\Interfaces\paymentGateWay;
use App\Payments\V1\PlaceToPayGateWay;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\v1\creaOrdenRequest;
use App\Repositories\V1\OrdenCompraRepository;
use App\Repositories\V1\CarroComprasRepository;
use Illuminate\Routing\Controller as BaseController;

class OrdenesController extends BaseController
{
    const LIMITE_PAGO = 10; //expiración de la sesión pago en minutos
    private $ordenRepositories;
    private $carroComprasRepositories;
    private paymentGateWay $paymentGateWay;

    public function __construct(OrdenCompraRepository $ordenRepository, CarroComprasRepository $carroComprasRepository)
    {
        $this->ordenRepositories = $ordenRepository;
        $this->carroComprasRepositories = $carroComprasRepository;
        $this->paymentGateWay = new PlaceToPayGateWay();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ordenes = $this->ordenRepositories->getOrdenesUsuario();
        return view('ordenes', ['ordenes' => $ordenes]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store($slug_carrito)
    {
        //consulto si hay un orden pendiente
        if (count($this->ordenRepositories->getOrdenPendiente()) > 0) {
            //si la hay redirige a listado de ordenes
            $ordenes = $this->ordenRepositories->getOrdenesUsuario();
            return view('ordenes', [
                'ordenes'        => $ordenes,
                'flag_pendiente' => true
            ]);
        } else {
            //si no la hay envia creacion de nueva orden
            //consultamos el carro de compras activo para el usuario autenticado
            $carrito = $this->carroComprasRepositories->getBySlug($slug_carrito);
            $total = $this->carroComprasRepositories->calcularTotalCarroCompras($carrito);
            return view('crear-orden', ["total_compra" => $total, "slug_carrito" => $slug_carrito]);
        }
    }

    public function createOrder(creaOrdenRequest $request, $slug_carrito)
    {
        try {
            $referencia = uniqid();
            $carrito = $this->carroComprasRepositories->getBySlug($slug_carrito);
            $totalCompra = $this->carroComprasRepositories->calcularTotalCarroCompras($carrito);
            //creacion de sesion con la pasarela de pagos
            $sesion_pago = $this->paymentGateWay->createRequest((new PaymentInfo($referencia, 'compra_prueba', 'COP', $totalCompra)), 'http://127.0.0.1:8000/home-3', self::LIMITE_PAGO, 'es_CO');
            //sesion de pago creada correctamente
            if ($sesion_pago['status']['status'] == 'OK') {
                $ordenCompra = $this->ordenRepositories->save(new Ordenes([
                    'referencia'       => $referencia,
                    'request_id'       => $sesion_pago['requestId'],
                    'codigo_usuario'   => auth()->user()->id,
                    'customer_name'    => $request->nombre,
                    'customer_email'   => $request->correo,
                    'customer_mobile'  => $request->telefono,
                    'estado'           => 'activo',
                    'registro_usuario' => auth()->user()->id
                ]));
                //creacion de la orden a partir del carro de compras (pasar por caja)
                $this->ordenRepositories->cargaProductosCarroCompras($carrito, $ordenCompra);
                //se redirige a la pasarela de pagos
                return Redirect::to($sesion_pago['processUrl']);
            }
        } catch (\Throwable $th) {
            echo 'Error al crear la orden de compra, motivo: ' . $th->getMessage();
        }
    }
}
