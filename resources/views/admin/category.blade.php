@extends('master.admin')

@section('admin-breadcrumb')
@include('includes.breadcrumb',[
    'breadcrumb' => [
        'Home'          => '/',
        'Admin'         => route('admin.index'),
        'Categories'    => route('admin.categories'),
        $category->name => route('admin.categories.show', $category->id)
    ]
])
@endsection

@section('admin-content')

    @include('includes.flash.success')
    @include('includes.flash.error')
    <h1 class="mb-5">Categories</h1>

    <div class="row">
        <div class="col-md-6">
             @include('includes.admin.edit_category', ['category' => $category])
        </div>
        <div class="col-md-6">
            @if($category->parent)
                <h3>Parent Category</h3>
                <hr>
                <a href="{{ route('admin.categories.show', $category->parent->id) }}"><strong>{{ $category->parent->name }}</strong></a>
            @endif
            
            @if($category->children->isNotEmpty())
                <h3 class="mt-3">Subcategories of this category</h3>
                <hr>
                @include('includes.admin.listcategories', ['categories' => $category->children])
            @endif
        </div>
    </div>


@stop
