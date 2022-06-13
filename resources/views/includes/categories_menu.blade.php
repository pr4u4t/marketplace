<ul>
    @foreach($categories as $cat)
    <li class="">
        <a href="{{ route('market.category.show', $cat) }}" class="">
            @if(isset($icon) and $icon === true)
                <i class="{{ $cat->icon }}"></i>
            @endif
            {{ $cat->name }}
        </a>
        @if(isset($badge) and $badge === true) 
            <span class="badge badge-warning badge-pill"> {{ $cat->num_products }} </span> 
        @endif
    </li>
    @endforeach
</li>
