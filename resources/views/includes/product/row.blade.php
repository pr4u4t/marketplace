<div class="row my-2">

    <div class="col-md-3 col-sm-4 col-12">
        <img class="rounded img-thumbnail mw-100" src="{{ asset('storage/'  . $product->frontImage()->image) }}"
             alt="{{ $product->name }}">
    </div>

    <div class="col-md-9 col-sm-8 col-12">
        <div class="row pb-2 mb-2 border-bottom border-light">
            <div class="col-md-8">
                <a href="{{ route('product.show', $product) }}"><h3 class="mb-0">{{ $product->name }}</h3></a>
            </div>
            @if(isset($show_posted) and $show_posted == true)
                <div class="col-md-4">
                    <h5 class="mb-0 text-right">Posted by <a href="{{ route('vendor.show', $product->user) }}"
                                                class="badge badge-info">{{ $product->user->username }}</a></h5>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-7">
                From: <strong>@include('includes.currency', [ 'value' => $product->price_from ])</strong>
                @if(isset($show_category) and $show_category)
                    <br>
                    <span class="mr-2">Category:</span>
                    @foreach($product->category->parents() as $ancestor)
                        <a href="{{ route('category.show', $ancestor) }}">{{ $ancestor->name }}</a>
                        <i class="fas fa-chevron-right"></i>
                    @endforeach
                    <a href="{{ route('market.category.show', $product->category) }}">{{ $product->category->name }}</a>
                @endif
                <br>
                <span class="badge badge-info">{{ ucfirst($product->type) }}</span> type
                <br>
                <strong>{{ $product->quantity }}</strong> left / <strong>{{ $product->orders }}</strong>
                sold
            </div>

            <div class="col-md-5">
                @if(isset($show_description) and $show_description)
                <p class="text-muted">
                    {{ $product->short_description }}
                </p>
                @endif
                <p>
                    Payment coins:
                    @foreach($product->getCoins() as $coin)
                        <span class="badge badge-info">{{ strtoupper(\App\Purchase::coinDisplayName($coin)) }}</span>
                    @endforeach
                </p>
                <a href="{{ route('product.show', $product) }}" class="btn btn-primary d-block">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    Buy now
                </a>
            </div>

        </div>

    </div>

    {{--
        <div class="card-body">
        <p class="card-subtitle"></p>
        <p class="card-text">
        </p>
    </div>
    --}}


</div>
