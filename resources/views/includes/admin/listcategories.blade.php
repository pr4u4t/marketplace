<div class="row">
    <div class="col-md-6">Name</div>
    <div class="col-md-3">Weight</div>
    <div class="col-md-3">Action</div>
</div>
<hr/>

@if($categories->isNotEmpty())
    @include('includes.admin.list_subcategories', [
        'categories'    => $categories
    ])
@endif
