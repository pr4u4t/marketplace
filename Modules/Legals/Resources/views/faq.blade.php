@extends('master.main')

@section('title','Terms and Conditions')

@section('content')
    @include('includes.breadcrumb',[
        'breadcrumb' => [
            'Home'       => '/',
            'FAQ'        => route('legals.faq'),
        ]
    ])
@stop
