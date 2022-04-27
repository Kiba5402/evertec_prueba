@extends('layouts.layout')
<!-- Posts -->
@section('title', 'Crear Orden')
@section('contenido')
<section>
    <form class="row justify-content-center" method="post" action="/order/create-order/{{$slug_carrito}}">
        {{ csrf_field() }}
        <div class="col-8">
            <h5>Datos del comprador</h5>
            <br>
            <div class="mb-3">
                <label for="userName" class="form-label">Nombre comprador</label>
                <input value="{{ old('nombre') }}" name="nombre" id="userName" type="input" class="form-control">
                @error('nombre')
                <p class="error-message error-field">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Correo electrónico</label>
                <input value="{{ old('correo') }}" name="correo" id="userEmail" type="email" class="form-control @error('email') is-invalid @enderror">
                @error('correo')
                <p class="error-message error-field">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="userPhone" class="form-label">Teléfono de contacto</label>
                <input value="{{ old('telefono') }}" name="telefono" id="userPhone" type="input" class="form-control">
                @error('telefono')
                <p class="error-message error-field">{{ $message }}</p>
                @enderror
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