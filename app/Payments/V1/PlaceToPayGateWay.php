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
        $now = new DateTime(now());
        $expiration = (new Carbon($now))->addMinutes(($expiration_minutes < 10) ? 10 : $expiration_minutes);
        $expiration = $expiration->format(DateTime::ATOM);

        return Http::post(env('URL_BASE_PLACETOPAY').'api/session', [
            "locale"     => $locale,
            "auth"       => $this->authPlaceToPay($now),
            "payment"    => $this->paymentPlaceToPay($payment),
            "expiration" => $expiration,
            "returnUrl"  => $return_url,
            "ipAddress"  => Request()->ip(),
            "userAgent"  => "PlacetoPay Sandbox"
        ])->throw()->json();
    }

    public function getRequestInformation(String $id_session)
    {
        $now = new DateTime(now());

        return Http::post(env('URL_BASE_PLACETOPAY') . 'api/session/' . $id_session, [
            "auth" => $this->authPlaceToPay($now),
        ])->throw()->json();
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

    public function castStateResponde(String $state = 'CREATED')
    {
        switch ($state) {
            case 'CREATED':
            case 'PENDING':
                return 'created';
            case 'APPROVED':
                return 'payed';
            case 'REJECTED':
                return 'rejected';
            default:
                return 'created';
        }
    }
}
