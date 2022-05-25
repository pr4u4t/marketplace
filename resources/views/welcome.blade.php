@extends('master.main')

@section('title','Home Page')

@section('content')

    {{--@include('includes.search')--}}

    <div class="row cats">
        <div class="col-md-12 col-sm-12 col-lg-4" style="margin-top:2.3em">
            @include('includes.categories', [
                'categories'    => $categories,
                'open'          => false,
                'badge'         => true
            ])
            <div class="row mt-3">
                <div class="col">
		    <!--
		    <div class="card ">
                        <div class="card-header">
                            Official Mirrors
                        </div>
                        <div class="card-body text-center">
                            @foreach(config('marketplace.mirrors') as $mirror)
                                <a href="{{$mirror}}" style="text-decoration:none;">{{$mirror}}</a>
                            @endforeach
                        </div>
		    </div>
		    -->
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-lg-8 mt-3">
            <h4>
            Newest products
            <hr>
            </h4>
            <div class="mt-5" style="margin-top: 1.3rem !important;">
                @foreach( $newestProducts as $chunks)
                    <div class="row mt-3">
                        @foreach($chunks as $product)
                            <div class="col-md-4 my-md-0 my-2 col-12">
                                @include('includes.product.card', ['product' => $product])
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            
            <div class="row">
                <div class="col">
                    <hr>
                </div>
            </div>
            @isModuleEnabled('FeaturedProducts')
                @include('featuredproducts::frontpagedisplay')
            @endisModuleEnabled
        </div>
        <div class="row col-md-12">
        
        <div class="col-md-4">
        <h4>
        Top Vendors
        </h4>
        <hr>
        @foreach(\App\Vendor::topVendors() as $vendor)
        <table class="table table-borderless table-hover">
        <tr>
        <td>
        <a href="{{route('vendor.show',$vendor)}}"
        style="text-decoration: none; color:#212529">{{$vendor->user->username}}</a>
        </td>
        <td class="text-right">
        <span class="btn btn-sm @if($vendor->vendor->experience >= 0) btn-primary @else btn-danger @endif active"
        style="cursor:default">Level {{$vendor->getLevel()}}</span>
        
        </td>
        </tr>
        </table>
        @endforeach
        </div>
        <div class="col-md-4">
        <h4>
        Latest orders
        </h4>
        <hr>
        @foreach(\App\Purchase::latestOrders() as $order)
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
        
        <div class="col-md-4">
        <h4>
        Rising vendors
        </h4>
        <hr>
        @foreach(\App\Vendor::risingVendors() as $vendor)
        <table class="table table-borderless table-hover">
        <tr>
        <td>
        <a href="{{route('vendor.show',$vendor)}}"
        style="text-decoration: none; color:#212529">{{$vendor->user->username}}</a>
        </td>
        <td class="text-right">
        <span class="btn btn-sm @if($vendor->vendor->experience >= 0) btn-primary @else btn-danger @endif active"
        style="cursor:default">Level {{$vendor->getLevel()}}</span>
        </td>
        </tr>
        </table>
        @endforeach
        </div>
        
        
        </div>
    </div>

@stop
