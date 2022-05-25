<div id="categories">
    <h4>Categories</h4>
    <hr>
    <input type="checkbox" class="d-lg-none" style="position:absolute; right:1em; top:0.5em; z-index:500">
    <i class="fas fa-angle-down d-block d-lg-none"> </i>
    <nav class="tree-nav">
        @include('includes.subcategories', [
            'categories'    => $categories,
            'open'          => isset($open) ? $open : false,
            'badge'         => isset($badge) ? $badge : false
        ])
    </nav>
</div>
