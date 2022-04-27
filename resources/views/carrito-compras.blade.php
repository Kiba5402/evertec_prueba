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
                            @foreach ($carroCompras->getPivotProductosRelation as $productoPivot)
                            <x-producto-lista :cantidad="$productoPivot->cantidad_producto" :producto="$productoPivot->getProductoRelation" />
                            <?php $total += ($productoPivot->cantidad_producto * $productoPivot->getProductoRelation->valor) ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-12" style="text-align:right">
                    <h5>Total </h5>
                    <span style="text-align:center">${{number_format($total,2,",",".")}}</span>
                    <br>
                    <br>
                    <button type="button" class="btn btn-dark">Continuar con la compra</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection