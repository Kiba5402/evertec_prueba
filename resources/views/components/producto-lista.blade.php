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