@foreach($categories as $cat)
    @if($cat->children->isNotEmpty())
        <details class="tree-nav__item is-expandable" @if((isset($category) and $category->id == $cat->id) or (isset($parents) and $parents->contains(function ($value,$key) use($cat) { return $value->id == $cat->id; }) or isset($open) and $open === true)) open="" @endif>
            <summary class="tree-nav__item-title">
                <a href="{{ route('market.category.show', $cat) }}">
                    @if(isset($icon) and $icon === true)
                        <i class="{{ $cat->icon }}"></i>
                    @endif
                    {{ $cat->name }}
                </a>
                @if(isset($badge) and $badge === true) 
                    <span class="badge badge-warning badge-pill"> {{ $cat->num_products }} </span>
                @endif
            </summary> 
            @include('includes.subcategories', [
                'categories' => $cat->children,
                'open'       => isset($open) ? $open : false,
                'badge'      => isset($badge) ? $badge : false,
                'icon'       => isset($icon) ? $icon : false
            ])
        </details>
    @else
        <div class="tree-nav__item">
            <a href="{{ route('market.category.show', $cat) }}" class="tree-nav__item-title">
                @if(isset($icon) and $icon === true)
                    <i class="{{ $cat->icon }}"></i>
                @endif
                {{ $cat->name }}
            </a>
            @if(isset($badge) and $badge === true) 
                <span class="badge badge-warning badge-pill"> {{ $cat->num_products }} </span> 
            @endif
        </div>
    @endif

@endforeach
