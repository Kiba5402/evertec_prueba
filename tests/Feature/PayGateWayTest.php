<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\V1\PaymentInfo;
use App\Payments\V1\PlaceToPayGateWay;
use Tests\Traits\TransactionForTesting;

class productosTest extends TestCase
{
    use TransactionForTesting;

    //test de cracion de sesiones de pago
    public function test_create_request_payment_placetopay()
    {
        $payment = new PlaceToPayGateWay();
        $sesion_pago = $payment->createRequest((new PaymentInfo(uniqid(), 'compra_prueba_testing', 'COP', 10000)), env('APP_URL') . '/order/return-paygateway/' . 'orden_compra_slug', 10, 'es_CO');

        if (isset($sesion_pago)) {
            if (array_key_exists('status', $sesion_pago)) {
                if (array_key_exists('status', $sesion_pago['status'])) {
                    if ($sesion_pago['status']['status'] == 'OK') {
                        return $this->assertTrue(true);
                    }
                }
            }
        }
    }

    //test de consulta de sesiones de pago
    public function test_check_request_payment_placetopay()
    {
        $payment = new PlaceToPayGateWay();
        $sesion_pago = $payment->createRequest((new PaymentInfo(uniqid(), 'compra_prueba_testing', 'COP', 10000)), env('APP_URL') . '/order/return-paygateway/' . 'orden_compra_slug', 10, 'es_CO');

        if (isset($sesion_pago)) {
            if (array_key_exists('status', $sesion_pago)) {
                if (array_key_exists('status', $sesion_pago['status'])) {
                    if ($sesion_pago['status']['status'] == 'OK') {
                        $consulta_sesion = $payment->getRequestInformation($sesion_pago['requestId']);
                        if ($consulta_sesion) return $this->assertTrue(true);
                    }
                }
            }
        }
    }
}
