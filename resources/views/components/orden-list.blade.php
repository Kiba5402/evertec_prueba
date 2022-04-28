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
    <td style="vertical-align:middle;text-align:center;">
        <span style="font-size:1.1em">{{$orden->status_cast}}</span>
    </td>
    <td style="vertical-align:middle;text-align:center;">
        @if ($orden->status == 'created')
        <h5>
            <a href="{{$orden->request_url}}" class="badge bg-success">
                Continuar con el pago
            </a>
        </h5>
        @elseif ($orden->status == 'rejected')
        <h5>
            <a href="/order/pay-order/{{$orden->slug}}" class="badge bg-warning text-dark">
                Reintentar el pago
            </a>
        </h5>
        @else
        -
        @endif
        <span style="font-size:1.1em"></span>
    </td>
</tr>