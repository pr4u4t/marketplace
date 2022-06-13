@extends('master.admin')

@section('admin-breadcrumb')
@include('includes.breadcrumb',[
    'breadcrumb' => [
        'Home'          => '/',
        'Admin'         => route('admin.index'),
        'Categories'    => route('admin.categories')
    ]
])
@endsection

@section('admin-content')

    @include('includes.flash.success')
    @include('includes.flash.error')
    <h3 class="mb-5">Categories</h3>

    <div class="row">
        <div class="col-md-6 admin-categories">
            <h4>List of categories ({{ count($categories) }})</h4>
            <hr>
            @if($rootCategories->isNotEmpty())
                @include('includes.admin.listcategories', ['categories' => $rootCategories])
            @else
                <div class="alert alert-warning text-center">There are no categories!</div>
            @endif
        </div>
        <div class="col-md-6">
            @include('includes.admin.add_category', [
                'categories' => $categories   
            ])
        </div>
    </div>
@stop
