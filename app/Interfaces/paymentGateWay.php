<?php

namespace App\Interfaces;

use App\Models\V1\PaymentInfo;

interface paymentGateWay
{
  public function createRequest(PaymentInfo $payment, string $returnUrl, int $expiration_minutes, string $locale);
  public function getRequestInformation(String $id_session);
  public function castStateResponde(String $state);
}
