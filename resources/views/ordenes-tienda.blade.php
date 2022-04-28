@extends('layouts.layout')
<!-- Posts -->
@section('title', 'Ordenes Tienda')
@section('contenido')
<section>
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="row">
                <div class="col-12 mb-5">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="text-align:center">#</th>
                                <th style="text-align:center">Fecha creación</th>
                                <th style="text-align:center">Referencia</th>
                                <th style="text-align:center">Nombre comprador</th>
                                <th style="text-align:center">Correo comprador</th>
                                <th style="text-align:center">Teléfono comprador</th>
                                <th style="text-align:center">Nombre usuario</th>
                                <th style="text-align:center">Valor</th>
                                <th style="text-align:center">Detalle</th>
                                <th style="text-align:center">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0 ?>
                            @if (count($ordenes) > 0)
                            @foreach ($ordenes as $orden)
                            <x-orden-list :orden="$orden" :admin="true" />
                            <?php $total += $orden->total ?>
                            @endforeach
                            @else
                            <tr>
                                <td style="text-align: center;" colspan="9">Sin ordenes para listar</td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7">Total</th>
                                <th style="text-align:center">${{number_format($total,2,",",".")}}</th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection