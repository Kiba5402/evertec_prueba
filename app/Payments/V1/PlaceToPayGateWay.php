<?php

namespace App\Payments\V1;

use DateTime;
use App\Models\V1\PaymentInfo;
use Illuminate\Support\Carbon;
use App\Interfaces\paymentGateWay;
use Illuminate\Support\Facades\Http;

class PlaceToPayGateWay implements paymentGateWay
{
    public function createRequest(PaymentInfo $payment, string $return_url, int $expiration_minutes, string $locale)
    {
        try {
            $now = new DateTime(now());
            $expiration = (new Carbon($now))->addMinutes(($expiration_minutes < 10) ? 10 : $expiration_minutes);
            $expiration = $expiration->format(DateTime::ATOM);

            return Http::post(env('URL_BASE_PLACETOPAY'), [
                "locale"     => $locale,
                "auth"       => $this->authPlaceToPay($now),
                "payment"    => $this->paymentPlaceToPay($payment),
                "expiration" => $expiration,
                "returnUrl"  => $return_url,
                "ipAddress"  => Request()->ip(),
                "userAgent"  => "PlacetoPay Sandbox"
            ])->throw()->json();
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage);
        }
    }

    public function getRequestInformation(String $id_session)
    {
    }


    private function paymentPlaceToPay(PaymentInfo $payment, $allowPartial = 'false')
    {
        return [
            "reference"   => $payment->referencia,
            "description" => $payment->descripcion,
            "amount"      => [
                "currency" => $payment->tipo_moneda,
                "total"    => $payment->total
            ],
            "allowPartial" => $allowPartial
        ];
    }

    private function authPlaceToPay(Datetime $now)
    {
        $fecha     = $now->format(DateTime::ATOM);
        $nonce     = uniqid();
        $login     = env('LOGIN_PLACETOPAY');
        $secret    = env('SECRET_PLACETOPAY');
        $tranKey   = base64_encode(sha1(($nonce . $fecha . $secret), true));

        return [
            "login"   => $login,
            "tranKey" => $tranKey,
            "nonce"   => base64_encode($nonce),
            "seed"    => $fecha
        ];
    }
}
