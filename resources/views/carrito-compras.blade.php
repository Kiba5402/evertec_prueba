@extends('layouts.layout')
<!-- Posts -->
@section('title', 'Carrito compras')
@section('contenido')
<section>
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="row">
                <div class="col-12 mb-5">
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
                            @if (isset($carroCompras))
                            @foreach ($carroCompras->getPivotProductosRelation as $productoPivot)
                            <x-producto-lista :cantidad="$productoPivot->cantidad_producto" :producto="$productoPivot->getProductoRelation" />
                            <?php $total += ($productoPivot->cantidad_producto * $productoPivot->getProductoRelation->valor) ?>
                            @endforeach
                            @else
                            <tr>
                                <td style="text-align: center;" colspan="4">Carrito de compras vacío</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-12" style="text-align:right">
                    <h5>Total </h5>
                    <span style="text-align:center">${{number_format($total,2,",",".")}}</span>
                    <br>
                    <br>
                    <a type="button" href="{{route('order.init-order', [isset($carroCompras)?$carroCompras->slug:''])}}" class="btn btn-dark {{!isset($carroCompras)?'disabled':''}}">
                        <span style="color:white">Continuar con la compra</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection