<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Evertec - @yield('title')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('css/styles.css') !!}">
</head>

<body>
    <!-- Logo -->
    <nav class="navbar navbar-expand-lg navbar-light bg-main">
        <div class="container">
            <a class="navbar-brand m-auto" href="#">
                <img src="{{asset('images/logo.png')}}" width="120" alt="" loading="lazy">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <x-login />
            </div>
        </div>
    </nav>
    <!-- Contenido -->
    <section class="container-fluid content">
        <!-- Categorías -->
        <div class="row justify-content-center">
            <div class="col-10 col-md-12">
                <nav class="text-center my-5">
                    <a id="productos-category" href="{{route('home')}}" class="mx-3 pb-3 link-category d-block d-md-inline selected-category">Productos</a>
                    <a id="carrito-category" href="{{route('shopping-cart.get-User-Sc')}}" class="mx-3 pb-3 link-category d-block d-md-inline">Carrito Compras</a>
                    <a id="ordenes-category" href="{{route('order.get-orders')}}" class="mx-3 pb-3 link-category d-block d-md-inline">Ordenes Usuario</a>
                    @if (auth()->user())
                    @if (auth()->user()->profile == 1)
                    <a id="ordenes-tienda-category" href="{{route('order.get-all-orders')}}" class="mx-3 pb-3 link-category d-block d-md-inline">Ordenes Tienda</a>
                    @endif
                    @endif
                </nav>
            </div>
        </div>

        <div style="min-height: 34.5rem">
            <!-- contenido -->
            @yield('contenido')
        </div>

        <!-- Footer -->
        <footer class="container-fluid bg-main">
            <div class="row text-center p-4">
                <div class="mb-3">
                    <img src="{{asset('images/logo.png')}}" alt="Evertec logo" width="100" id="logofooter">
                </div>
                <div id="col-md-10">
                    <a target="_blank" href="https://www.linkedin.com/in/cristian-reyes-5502a21a9">
                        <img src="{{asset('images/linkdin2.png')}}" class="img-fluid" width="25px" alt="LinkedIn Cristhian Reyes">
                    </a>
                    <a target="_blank" href="https://github.com/Kiba5402">
                        <img src="{{asset('images/github.png')}}" class="img-fluid" width="30px" alt="GitHub Cristhian Reyes">
                    </a>
                    <p class="mt-3">2022 Cristhian Reyes.</p>
                </div>
            </div>
        </footer>
</body>

</html>