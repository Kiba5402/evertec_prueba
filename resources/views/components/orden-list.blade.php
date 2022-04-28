<tr>
    <td style="vertical-align:middle;text-align:center;">
        <span style="font-size:1.1em">{{$orden->id}}</span>
    </td>
    <td style="vertical-align:middle;text-align:center;">
        <span style="font-size:1.1em">{{$orden->getCreatedAt}}</span>
    </td>
    <td style="vertical-align:middle;text-align:center;">
        <span style="font-size:1.1em">{{$orden->referencia}}</span>
    </td>
    <td style="vertical-align:middle;text-align:center;">
        <span style="font-size:1.1em">{{$orden->customer_name}}</span>
    </td>
    <td style="vertical-align:middle;text-align:center;">
        <span style="font-size:1.1em">{{$orden->customer_email}}</span>
    </td>
    <td style="vertical-align:middle;text-align:center;">
        <span style="font-size:1.1em">{{$orden->customer_mobile}}</span>
    </td>
    @if ($admin)
    <td style="vertical-align:middle;text-align:center;">
        <span style="font-size:1.1em">{{$orden->getUsuarioRelation->name}}</span>
    </td>
    @endif
    <td style="vertical-align:middle;text-align:center;">
        <span style="font-size:1.1em">${{number_format($orden->total,2,",",".")}}</span>
    </td>
    <td style="vertical-align:middle;text-align:center;">
        <h5>
            <a href="/order/order-summary/{{$orden->slug}}" class="badge bg-info bg-gradient">
                Detalle
            </a>
        </h5>
    </td>
    <td style="vertical-align:middle;text-align:center;">
        <span style="font-size:1.1em">{{$orden->status_cast}}</span>
    </td>
    @if (!$admin)
    <td style="vertical-align:middle;text-align:center;">
        @if ($orden->status == 'created')
        <h5>
            <a href="{{$orden->request_url}}" class="badge bg-success bg-gradient">
                Continuar con el pago
            </a>
        </h5>
        @elseif ($orden->status == 'rejected')
        <h5>
            <a href="/order/pay-order/{{$orden->slug}}" class="badge bg-warning text-dark bg-gradient">
                Reintentar el pago
            </a>
        </h5>
        @else
        -
        @endif
        <span style="font-size:1.1em"></span>
    </td>
    @endif
</tr>