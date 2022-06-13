@foreach($categories as $cat)
    <option value="{{ $cat->id }}" @if($parent_id == $cat->id) selected @endif>{{ $level }}{{ $cat->name }}</option>
    @include('includes.admin.subcategories', [
        'categories'    => $cat->children,
        'level'         => "$level$level",
        'parent_id'     => $parent_id
    ])
@endforeach 
