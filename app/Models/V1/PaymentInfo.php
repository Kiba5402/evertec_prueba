<?php

namespace App\Models\V1;

class PaymentInfo
{

    public String $referencia;
    public String $descripcion;
    public String $tipo_moneda;
    public Float $total;

    public function __construct(String $_referencia, String $_descripcion, String $_tipo_moneda, Float $_total)
    {
        $this->referencia  = $_referencia;
        $this->descripcion = $_descripcion;
        $this->tipo_moneda = $_tipo_moneda;
        $this->total       = $_total;
    }
}
