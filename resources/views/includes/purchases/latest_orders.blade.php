<div class="row latest-orders-block">
    <div class="container">
        <div class="col-md-12">
            <h4 style="text-align:center">
            Latest orders
            </h4>
            <hr class="col-9 d-md-none">
            @foreach($latestOrders as $order)
                <table class="table table-borderless table-hover">
                    <tr>
                        <td>
                            <img class="img-fluid" height="23px" width="23px"
                            src="{{ asset('storage/'  . $order->offer->product->frontImage()->image) }}"
                            alt="{{ $order->offer->product->name }}">
                        </td>

                        <td>
                            {{str_limit($order->offer->product->name,50,'...')}}
                        </td>

                        <td class="text-right">
                            {{$order->getSumLocalCurrency()}} {{$order->getLocalSymbol()}}
                        </td>
                    </tr>
                </table>
            @endforeach
        </div>
    </div>
</div> 
