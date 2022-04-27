<tr>
    <td>
        <h6 class="mb-1">{{$producto->nombre}}</h6>
        <div style="width: 8em;">
            <x-carrusel-img :imagenes="$producto->getImagenesRelation->toArray()" />
        </div>
        <span class="mb-1">{{$producto->descripcion}}</span>
    </td>
    <td style="vertical-align:middle;text-align:center;">
        <span style="font-size:1.1em">{{$cantidad}}</span>
    </td>
    <td style="vertical-align: middle;text-align: center;">
        <span style="font-size:1.1em">${{number_format($producto->valor,2,",",".")}}</span>
    </td>
    <td style="vertical-align: middle;text-align: center;">
        <span style="font-size:1.1em">${{number_format(($cantidad*$producto->valor),2,",",".")}}</span>
    </td>
</tr>

<!-- 

<div style="border-radius: 23px;" class="list-group-item list-group-item-action">
    <div class="row d-flex">
        <div class="col-12">
            <div class="d-flex w-150 justify-content-between">
                <h4 class="mb-1">{{$producto->nombre}}</h4>
            </div>
            <br>
            <div style="width: 8em;">
                <x-carrusel-img :imagenes="$producto->getImagenesRelation->toArray()" />
            </div>
            <br>
            <p class="mb-1" style="font-size:1.2em">{{$producto->descripcion}}</p>
            <div>
                Cantidad: <span style="font-size:1.1em" class="badge bg-secondary">{{$cantidad}}</span>
            </div>
            <div class="text-end ">
                Precio: <span style="font-size:1.1em" class="badge bg-secondary">${{number_format($producto->valor,2,",",".")}}</span>
                <input checked="checked" type="checkbox" value="" aria-label="...">
            </div>
        </div>
    </div>

</div> -->