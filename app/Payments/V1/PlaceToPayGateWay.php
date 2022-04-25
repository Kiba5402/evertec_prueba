<?php

namespace App\Http\Payments\V1\Payments;

use App\Interfaces\paymentGateWay;
use App\Models\V1\Payment;

class PlaceToPayGateWay implements paymentGateWay
{
    public function createRequest(Payment $payment)
    {
    }

    public function getRequestInformation(String $id_session)
    {
    }
}
