<?php

namespace App\Interfaces;

use App\Models\V1\Payment;

interface paymentGateWay
{
  public function createRequest(Payment $payment);
  public function getRequestInformation(String $id_session);
}
