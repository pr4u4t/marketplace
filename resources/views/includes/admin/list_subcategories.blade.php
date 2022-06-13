<ul @if(isset($klass)) class="{{ $klass }}" @endif>
    @foreach($categories as $category)
    <li>
        <div class="row">
            <div class="col-md-6">
            <i class="{{ $category->icon }}"></i>
            <a href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a>
            </div>
            <div class="col-md-3">
                {{ $category->weight }}
            </div>
            <div class="col-md-3">
                <a class="btn btn-outline-danger btn-sm" href="{{ route('admin.categories.delete', $category->id) }}">Delete</a>
            </div>
        </div>
    
        @if($category->children->isNotEmpty())
            @include('includes.admin.list_subcategories', [
                'categories'    => $category->children
            ])
        @endif
    </li>
    @endforeach
</ul> 
