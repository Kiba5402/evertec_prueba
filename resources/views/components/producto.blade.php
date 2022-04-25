<div class="col-md-4 col-12 justify-content-center mb-5">
    <div class="card m-auto" style="width: 18rem;">
        <x-carrusel-img :imagenes="$imagenes" />
        <div class="card-body">
            <small class="card-txt-category">Categoría: {{$categoria}}</small>
            <h5 class="card-title my-2">{{$nombre}}</h5>
            <div class="d-card-text">
                {{$descripcion}}
            </div>
            <a href="#" class="post-link"><b>Agregar al carrito</b></a>
            <hr>
            <div class="row">
                <div class="col-6 text-left">
                    <span class="card-txt-author">Evertec</span>
                </div>
                <div class="col-6 text-right">
                    <span class="card-txt-date">Hace 2 semanas</span>
                </div>
            </div>
        </div>
    </div>
</div>