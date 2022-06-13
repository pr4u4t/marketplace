<div class="row categories-block">
    <h2 class="col-md-12" style="text-align:center">Main categories</h2>
    <hr class="col-9 d-md-none">
    <div class="horizon-slider">
        <div class="roll">
        @foreach($categories as $cat)
            <div class="col-md-2">
                <a href="{{ route('market.category.show', $cat) }}" class="d-block" style="text-align:center">
                    @if(isset($icon) and $icon === true)
                        <span class="d-block" style="border-radius:3em; border:1px solid #000; padding:0.2em; text-align:center; height: 6em; width: 6em; margin: auto;">
                            <i class="d-block {{ $cat->icon }}" style="font-size:4em; color:#000; position: relative; top: .2em;"></i>
                        </span>
                    @endif
                    <span class="label d-block">
                        {{$cat->name}}
                    </span>
                </a>
                @if(isset($badge) and $badge === true) 
                    <span class="badge badge-warning badge-pill"> {{ $cat->num_products }} </span> 
                @endif
            </div>
        @endforeach
        </div>
    </div>
</div>
