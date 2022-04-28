@extends('layouts.layout')
<!-- Posts -->
@section('title', 'Resumen Orden')
@section('contenido')
<section>
    @if (isset($orden))
    <div class="row justify-content-center">
        <div class="col-8">
            <h4 style="margin:auto">Resumen Compra</h4>
            <hr>
            <h5>Datos del comprador</h5>
            <br>
            <div class="mb-3">
                <label for="userName" class="form-label">Nombre comprador</label>
                <input value="{{$orden->customer_name}}" type="input" readonly class="form-control">
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Correo electrónico</label>
                <input value="{{$orden->customer_email}}" type="input" readonly class="form-control">
            </div>
            <div class="mb-3">
                <label for="userPhone" class="form-label">Teléfono de contacto</label>
                <input value="{{$orden->customer_mobile}}" type="input" readonly class="form-control">
            </div>
            <br>
        </div>
        <div class="col-8" style="text-align:left">
            <h5>Productos</h5>
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th style="text-align:center">Cantidad</th>
                        <th style="text-align:center">Precio</th>
                        <th style="text-align:center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0 ?>
                    @foreach ($orden->getPivotProductosRelation as $productoPivot)
                    <x-producto-lista :cantidad="$productoPivot->cantidad_producto" :producto="$productoPivot->getProductoRelation" />
                    <?php $total += ($productoPivot->cantidad_producto * $productoPivot->getProductoRelation->valor) ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-8" style="text-align:right">
            <h5>Total de la compra</h5>
            <span style="text-align:center">${{number_format($total_compra,2,",",".")}}</span>
            <br>
            <br>
            @if (isset($resumen))
            <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-dark">
                <span style="color:white">
                    Volver
                </span>
            </a>
            @else
            <a href="/order/pay-order/{{$orden->slug}}" class="btn btn-dark">
                <span style="color:white">
                    Continuar con el pago
                </span>
            </a>
            @endif
        </div>
    </div>
    <br>
    @else
    Sin orden valida.
    @endif
</section>
@endsection