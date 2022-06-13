@extends('master.main')

@section('title','Home Page')

@section('wide')
    @include('master.carousel')

    <div class="col-12" style="margin-right:auto; margin-left:auto;">
        @include('includes.detailedsearch', [ 
            'collapsible'   => true,
            'search_str'    => "Search over $productsCount products"
        ])
    </div>
@endsection

@section('content')
    <div class="categories-block">
        <div class="container">
        @include('includes.categories_block', [ 
            'categories'    => $roots, 
            'icon'          => true ]
        )
        </div>
    </div>
    
   
    @include('includes.product.newest_products')
    
    @if(isset($latestOrders) and count($latestOrders))
        @include('includes.purchases.latest_orders')
    @endif
    
    
    @if(isset($topVendors) and count($topVendors))
        @include('includes.vendor.top_vendors')
    @endif
    
    @if(isset($risingVendors) and count($risingVendors))
        @include('includes.vendor.rising_vendors')
    @endif
    
    @include('includes.vendor.newest_vendors')
    
    @include('includes.user.newest_users')
    
    @include('includes.seller_protection')
    
@stop
