@foreach($categories as $cat)
    @if($cat->children->isNotEmpty())
        <details class="tree-nav__item is-expandable" @if((isset($category) and $category->name == $cat->name) or (isset($parents) and $parents->contains(function ($value,$key) use($cat) { return $value->name == $cat->name; }) or isset($open) and $open === true)) open="" @endif>
        <summary class="fa tree-nav__item-title"> 
            <a href="{{ route('category.show', $cat) }}"> {{ $cat->name }} </a> 
            @if(isset($badge) and $badge === true) <span class="badge badge-warning badge-pill">{{ $cat->num_products }}</span> </summary> @endif
            @include('includes.subcategories', [
                'categories' => $cat->children,
                'open'       => isset($open) ? $open : false,
                'badge'      => isset($badge) ? $badge : false
            ])
        </details>
    @else
        <div class="tree-nav__item">
            <a href="{{ route('category.show', $cat) }}" class="tree-nav__item-title">{{ $cat->name }} </a> 
            @if(isset($badge) and $badge === true) <span class="badge badge-warning badge-pill"> {{ $cat->num_products }} </span> @endif 
        </div>
    @endif

@endforeach
