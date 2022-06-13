@extends('master.admin')

@section('admin-breadcrumb')
    @include('includes.breadcrumb',[
        'breadcrumb' => [
            'Home'    => '/',
            'Admin'   => route('admin.index'),
            'Log'     => route('admin.log'),
        ]
])
@endsection

@section('admin-content')
<div class="row">
    <div class="col">
        <h4>
        Site performance
        </h4>
        <hr>
        <p>
        
        </p>
    </div>
</div>


@stop

