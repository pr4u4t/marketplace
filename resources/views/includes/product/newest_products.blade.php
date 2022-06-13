<div class="row newest-products-block" style="background:#f3f4f5">
    <div class="container">
        <div class="col-md-12 col-sm-12 col-lg-12 mt-3">
            <h3 style="text-align:center">
            Newest products
            </h3>
            <hr class="col-9 d-md-none">
            @if(isset($newestProducts) and count($newestProducts))
                <div class="mt-5" style="margin-top: 1.3rem !important;">
                    @foreach( $newestProducts as $chunks)
                        <div class="row mt-3">
                            @foreach($chunks as $product)
                                <div class="col-md-3 my-md-0 my-2 col-sm-6 col-6">
                                    @include('includes.product.card', ['product' => $product])
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @else
                <h4 class="text-center">No new products at this time, be the first to add!</h4>
            @endif
        </div>
    </div>
</div> 
