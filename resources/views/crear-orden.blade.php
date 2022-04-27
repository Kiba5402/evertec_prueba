@extends('layouts.layout')
<!-- Posts -->
@section('title', 'Crear Orden')
@section('contenido')
<section>
    <form class="row justify-content-center">
        <div class="col-8">
            <h5>Datos del comprador</h5>
            <br>
            <div class="mb-3">
                <label for="userName" class="form-label">Nombre comprador</label>
                <input id="userName" type="input" class="form-control">
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Correo electrónico</label>
                <input id="userEmail" type="email" class="form-control @error('email') is-invalid @enderror">
            </div>
            <div class="mb-3">
                <label for="userPhone" class="form-label">Teléfono de contacto</label>
                <input id="userPhone" type="input" class="form-control">
            </div>
        </div>
        <div class="col-8" style="text-align:right">
            <h5>Total de la compra</h5>
            <span style="text-align:center">${{number_format($total_compra,2,",",".")}}</span>
            <br>
            <br>
            <button type="submit" class="btn btn-dark">Continuar con el pago</button>
        </div>
    </form>
</section>
@endsection