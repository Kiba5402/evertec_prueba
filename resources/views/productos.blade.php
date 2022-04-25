@extends('layouts.layout')
<!-- Posts -->
@section('title', 'Productos')
@section('contenido')
<section>
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="row">
                @foreach ($productos as $producto)
                <x-producto :categoria="'Unico'" :nombre="$producto->nombre" :descripcion="$producto->descripcion" :imagenes="$producto->getImagenesRelation->toArray()" />
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection