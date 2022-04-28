@extends('layouts.layout')
<!-- Posts -->
@section('title', 'Ordenes')
@section('contenido')
<section>
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="row">
                <div class="col-12 mb-5">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th style="text-align:center">#</th>
                                <th style="text-align:center">Fecha creación</th>
                                <th style="text-align:center">Referencia</th>
                                <th style="text-align:center">Nombre comprador</th>
                                <th style="text-align:center">Correo comprador</th>
                                <th style="text-align:center">Telefono comprador</th>
                                <th style="text-align:center">Estado</th>
                                <th style="text-align:center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($ordenes) > 0)
                            @foreach ($ordenes as $orden)
                            <x-orden-list :orden="$orden" />
                            @endforeach
                            @else
                            <tr>
                                <td style="text-align: center;" colspan="7">Sin ordenes para listar</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<x-modal-alert :id="'orden-pendiente-modal'" :titulo="'Orden pendiente'" :mensaje="'Usted ya cuenta con una orden de compra pendiente, por favor finalice el pago a través del botón \'retomar\' o espere algunos minutos'" />
@if (isset($flag_pendiente))
<script>
    let orden = new Orden();
    orden.mostrarModalOrdenPendiente('orden-pendiente-modal');
</script>
@endif
@endsection