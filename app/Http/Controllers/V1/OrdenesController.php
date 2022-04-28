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
        //consulto si hay un orden pendiente
        if (count($this->ordenRepositories->getOrdenPendiente()) > 0 || true) {
            $referencia = uniqid();
            $carrito = $this->carroComprasRepositories->getBySlug($slug_carrito);
            $ordenCompra = null;
            $totalCompra = 0;
            if ($carrito) {
                $ordenCompra = $this->ordenRepositories->save(new Ordenes([
                    'referencia'       => $referencia,
                    'codigo_usuario'   => auth()->user()->id,
                    'customer_name'    => $request->nombre,
                    'customer_email'   => $request->correo,
                    'customer_mobile'  => $request->telefono,
                    'estado'           => 'activo',
                    'registro_usuario' => auth()->user()->id
                ]));
                //creacion de la orden a partir del carro de compras (pasar por caja)
                $this->ordenRepositories->cargaProductosCarroCompras($carrito, $ordenCompra);
                $totalCompra = $this->ordenRepositories->calcularTotalCarroCompras($ordenCompra);
            }
            //se redirige al resumen de la orden
            return view('resumen-orden', ["orden" => $ordenCompra, "total_compra" => $totalCompra]);
        }
    }

    public function orderPay($slug_orden)
    {
        try {
            $ordenCompra = $this->ordenRepositories->getBySlug($slug_orden);
            $totalCompra = $this->ordenRepositories->calcularTotalCarroCompras($ordenCompra);
            //creacion de sesion con la pasarela de pagos
            $sesion_pago = $this->paymentGateWay->createRequest((new PaymentInfo($ordenCompra->referencia, 'compra_prueba', 'COP', $totalCompra)), env('APP_URL') . '/order/return-paygateway/' . $ordenCompra->slug, self::LIMITE_PAGO, 'es_CO');
            if ($sesion_pago['status']['status'] == 'OK') {
                $ordenCompra->fill([
                    'request_url'      => $sesion_pago['processUrl'],
                    'request_id'       => $sesion_pago['requestId'],
                    'registro_usuario' => auth()->user()->id
                ]);
                $this->ordenRepositories->save($ordenCompra);
                //redirige a la pasarela de pago
                return Redirect::to($sesion_pago['processUrl']);
            }
        } catch (\Throwable $th) {
            echo 'Error al crear la orden de compra, motivo: ' . $th->getMessage();
        }
    }

    public function returnPayGateWay($slug_orden, $redireccion = true)
    {
        try {
            $orden = $this->ordenRepositories->getBySlug($slug_orden);
            if ($orden) {
                //consultamos el estado del pago
                $sesion_pago = $this->paymentGateWay->getRequestInformation($orden->request_id);
                if (isset($sesion_pago['status'])) {
                    $castState = $this->paymentGateWay->castStateResponde($sesion_pago['status']['status']);
                    $orden->fill([
                        'request_url' => ($castState == 'created') ? $orden->request_url : '',   //si la orden esta rechazada o ya pagada eliminamos la url de acceso a la sesion (esta sesion ya no tiene uso)
                        'status'      => $castState
                    ]);
                    $this->ordenRepositories->save($orden);
                    //si la orden fue aprobada eliminamos el carrito de compras activo del usuario 
                    $carrito = $this->carroComprasRepositories->carroComprasUsuarioActual();
                    if($carrito) $this->carroComprasRepositories->save($carrito->fill(['estado' => 'eliminado'])); 
                    //el job que actualiza estados de las ordenes usa esta funcion por lo
                    //tanto no es necesaria un a redireccion 
                    if ($redireccion) {
                        $ordenes = $this->ordenRepositories->getOrdenesUsuario();
                        return view('ordenes', ['ordenes' => $ordenes]);
                    }
                }
            }
        } catch (\Throwable $th) {
            echo 'Error al consultar la orden de compra sobre la pasarela de pagos, motivo: ' . $th->getMessage();
        }
    }
}
