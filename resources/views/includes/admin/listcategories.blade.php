<ul>
    @foreach($categories as $category)
        <li>
            <div class="row">
                <div class="col-md-6"><a href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a></div>
                <div class="col-md-3">{{ $category->weight }}</div>
                <div class="col-md-3"><a class="btn btn-outline-danger btn-sm" href="{{ route('admin.categories.delete', $category->id) }}">Delete</a></div>
            </div>
            @if($category->children->isNotEmpty())
                <ul class="m-0 p-0">
                    @include('includes.admin.listcategories', ['categories' => $category -> children])
                </ul>
            @endif
        </li>
    @endforeach
</ul>
