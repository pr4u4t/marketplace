@extends('master.main')

@section('title', 'Vendors')

@section('content')
    @include('includes.breadcrumb',[
        'breadcrumb' => [
            'Home'           => '/',
            'Vendors'        => route('vendors'),
        ]
    ])
<div class="row vendors">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="row">
            <h1 class="col-md-11 col-lg-12">
                Vendors
            </h1>
            <div class="col-md-1 col-lg-1 text-lg-right">
                {{-- @include('includes.viewpicker') --}}
            </div>
        </div>
        
        <hr>

        @foreach($vendors->chunk(3) as $chunks)
        <div class="row mt-3">
            @foreach($chunks as $vendor)
                <div class="col-md-4 my-md-0 my-2 col-12">
                    @include('includes.vendor.card', [
                        'vendor'    => $vendor,
                        'summary'   => true
                    ])
                </div>
            @endforeach
        </div>
        @endforeach

        {{ $vendors->links('includes.paginate') }}
    </div>
</div>

@stop
