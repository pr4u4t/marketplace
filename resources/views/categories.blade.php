@extends('master.main')

@section('title', 'Categories')

@section('content')
    @include('includes.breadcrumb',[
        'breadcrumb' => [
            'Home'              => '/',
            'Categories'        => route('categories'),
        ]
    ])
    
    @include('includes.categories', [
        'categories'    => $categories,
        'open'          => true,
        'badge'         => false
    ])
@stop 
