@extends('master.main')

@section('title', 'Users')

@section('content')
    @include('includes.breadcrumb',[
        'breadcrumb' => [
            'Home'         => '/',
            'Users'        => route('users.show'),
        ]
    ])
<div class="row users">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="row">
            <h3 class="col-md-11 col-lg-12">
                Users
            </h3>
            <div class="col-md-1 col-lg-1 text-lg-right">
                {{-- @include('includes.viewpicker') --}}
            </div>
        </div>
        
        <hr>

        @foreach($users->chunk(4) as $chunks)
        <div class="row mt-3">
            @foreach($chunks as $user)
                    @include('includes.user.newest_user_card', [
                        'user'      => $user,
                        'summary'   => true
                    ])

            @endforeach
        </div>
        @endforeach

        {{ $users->links('includes.paginate') }}
    </div>
</div>

@stop
