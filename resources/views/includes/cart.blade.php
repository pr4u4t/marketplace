<ul class="dropdown-menu cart">

@if(!empty($items))
    @foreach($items as $productId => $item)
    <li class="d-flex">
        <div class="col-md-6">
            <a href="{{ route('product.show', $item->offer->product) }}">
                <span>{{ $item->offer->product->name }}</span>
            </a>
        </div>
        <div class="col-md-2">
            <span> {{ $item->quantity }} </span>
        </div>
        <div class="col-md-2">
            <span class="badge badge-info">
                @include('includes.currency', ['value' => $item->quantity*$item->offer->price])
            </span>
        </div>
    </li>
    @endforeach
    <li class="dropdown-divider"></li>
    <li class="d-flex">
        <div class="col-md-7"><span class="font-weight-bold">Total:</span></div>
        <div class="col-md-5"> @include('includes.currency', ['value' => $total ])<div>
    </li>
@else
    <li><div class="col-md-12">Your cart is empty </div></li>
@endif
</ul>
