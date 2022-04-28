@extends('layouts.layout')
<!-- Posts -->
@section('title', 'Productos')
@section('contenido')
<section>
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="row">
                @foreach ($productos as $producto)
                <x-producto :producto="$producto"/>
                @endforeach
            </div>
        </div>
    </div>
</section>
<script>
    let links = new Links();
    links.selectCategory('productos-category');
</script>
@endsection