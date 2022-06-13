@extends('master.main')

@section('title', $category ? $category->name : 'All products'. ' category')

@section('content')
    @php
        $crumbs = [
            'Home'        => '/',
            'Products'    => route('index.shop'),
        ];
        
        if(isset($parents)){
            foreach($parents as $parent){
                $crumbs += [ $parent->name => route('market.category.show', $parent) ];
            }
        }
        
        if(isset($category)){
            $crumbs += [ $category->name => route('market.category.show', $category) ];
        }
        
    @endphp
    @include('includes.breadcrumb',[
        'breadcrumb' => $crumbs
    ])
    <div class="row cats">
    
        <div class="col-md-12 col-sm-12 col-lg-4">
            @include('includes.categories', [
                'categories'    => $categories,
                'open'          => false,
                'badge'         => true
            ])
        </div>
        
        <div class="col-md-12 col-sm-12 col-lg-8">
            <div class="row">
                <h1 class="col-md-11 col-lg-8">
                @if($category) 
                    {{ $category->name }}
                    <small>- category</small>
                @else
                    All products
                @endif
                </h1>
                <div class="col-md-1 col-lg-1 text-lg-right">
                    @include('includes.viewpicker')
                </div>
            </div>
            <hr>

            @if($productsView == 'list')
                @foreach($products as $product)
                    @include('includes.product.row', ['product' => $product])
                @endforeach
            @else
                @foreach($products->chunk(3) as $chunks)
                    <div class="row mt-3">
                        @foreach($chunks as $product)
                            <div class="col-md-4 my-md-0 my-2 col-12">
                                @include('includes.product.card', ['product' => $product])
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif

             {{ $products->links('includes.paginate') }}
        </div>
    </div>

@stop
