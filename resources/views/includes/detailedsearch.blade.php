<div class="row mb-5 search-block">
    <div class="col-8" style="margin:auto; min-height:13em">
        @if(isset($card) and $card == true)
        <div class="card">
            <div class="card-header mt-5">
                Detailed Search
            </div>
            <div class="card-body">
        @endif
                <form action="{{route('search')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                    
                    @if(isset($collapsible) and $collapsible == true)
                        <details class="col-12">
                            <summary style="position:relative; top:4em; display:block; height: 0;" class="mt-5 mb-5">
                                <span class="btn btn-primary" style="margin:auto; position:relative; top:2em;  width:7em; display:block">Filters <i class="fa-solid fa-filter"></i> </span>
                    @endif
                                <div class="form-group col-md-8" style="margin:auto; height:0">
                                    <div class="input-group" style="position:relative; top:-5em;">
                                        <input type="text" name="search" id="search" placeholder="@if(isset($search_str)) {{ $search_str }} @else Search something for you @endif" class="form-control" value="{{ app('request')->input('query') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary">Search <i class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                    </div>
                                </div>
                    @if(isset($collapsible) and $collapsible == true)
                            </summary>
                    @endif
                            <div class="row mb-5" style="margin-top:10em">
                                <div class="form-group col-md-2">
                                    <label for="user">User:</label>
                                    <input type="text" name="user" id="user" class="form-control" value="{{app('request')->input('user')}}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Category:</label>
                                    <select class="form-control" id="category" name="category">
                                        <option selected value="any">Any</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->name}}" @if(app('request')->input('category') == $category->name) selected @endif>{{$category->name}}</option>
                                            @if($category->children->isNotEmpty())
                                                @foreach($category->children as $child)
                                                    <option value="{{$child->name}}" @if(app('request')->input('category') == $child->name) selected @endif> > {{$child->name}}</option>
                                                    @if($child->children -> isNotEmpty())
                                                        @foreach($child->children as $subChild)
                                                            <option value="{{$subChild->name}}" @if(app('request')->input('category') == $subChild->name) selected @endif> >> {{$subChild->name}}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="product_type">Product type:</label>
                                    <select class="form-control" id="product_type" name="product_type">
                                        <option selected value="all">All</option>
                                        <option value="digital" @if(app('request')->input('type') == 'digital') selected @endif>Digital</option>
                                        <option value="physical" @if(app('request')->input('type') == 'physical') selected @endif>Physical</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Price range:</label>
                                    <input type="number" name="minimum_price" id="" placeholder="Minimum price USD"
                                        class="form-control" value="{{app('request')->input('price_min')}}" step="0.01">
                                    <input type="number" name="maximum_price" id="" placeholder="Maximum price USD"
                                        class="form-control mt-2" value="{{app('request')->input('price_max')}}" step="0.01">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Order By:</label>
                                    <select class="form-control" id="order_by" name="order_by">
                                        <option @if(app('request')->input('order_by') == 'price_asc' ||app('request')->input('order_by') == null) selected @endif value="price_asc">Price: Low to High</option>
                                        <option @if(app('request')->input('order_by') == 'price_desc') selected @endif value="price_desc">Price: High to Low</option>
                                        <option @if(app('request')->input('order_by') == 'newest') selected @endif value="newest">Newest</option>
                                    </select>
                                </div>
                                @if(isset($search_filter) and $search_filter == true)
                                <div class="form-group col-md-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Search<i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </div>
                                @endif
                            </div>
                    @if(isset($collapsible) and $collapsible == true)
                        </details>
                    @endif
                    </div>
                </form>
        @if(isset($card) and $card == true)
            </div>
        </div>
        @endif
    </div>
</div>
