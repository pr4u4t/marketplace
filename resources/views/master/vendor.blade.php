@extends('master.main')

@section('title','Vendor - ' . $vendor->username )

@section('content')
    @include('includes.breadcrumb',[
        'breadcrumb' => [
            'Home'              => '/',
            'Vendors'           => route('vendors'),
            $vendor->username   => null
        ]
    ])

    <div class="row">
        <div class="col-md-12 profile-bg {{$vendor->vendor->getProfileBg()}} rounded pt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('includes.vendor.card')
                </div>
            </div>
            <div class="row justify-content-center" style="margin-top:5em">
                <div class="col-md-8">
                    <details class="rounded" style="background:#fff; margin-bottom:1em">
                        <summary style="font-weight:bold"> {{ $vendor->username.' PGP Key' }} </summary>
                        @include('includes.pgp',[
                            'pgp'   => $pgp
                        ])
                    </details>
                </div>
            </div>
        </div>
    </div>

    @include('includes.vendor.stats')
    
    @yield('vendor-content')
@stop
