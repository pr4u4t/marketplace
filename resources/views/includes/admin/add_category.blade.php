<h4>Add new category</h4>
<hr>
<form action="{{ route('admin.categories.new') }}"  method="POST">
    {{ csrf_field() }}
    
    <label for="name">Name:</label>
    <input id="name" name="name" placeholder="Category name" class="form-control mb-3 @error('name', $errors) is-invalid @enderror"/>
    
    <label for="name">Typography:</label>
    <input id="typography" name="typography" placeholder="Category typography" class="form-control mb-3 @error('name', $errors) is-invalid @enderror"/>
    
    <label for="weight">Weight:</label>
    <input name="weight" type="number" step="1" value="0" class="form-control mb-3 @error('name', $errors) is-invalid @enderror"/>
    
    <input name="active" type="checkbox" checked class="form-check-input ml-1 @error('name', $errors) is-invalid @enderror"/>
    <label class="form-check-label ml-4 mb-3" for="active">Active</label>
    
    @error('name', $errors)
        <div class="invalid-feedback d-block">{{ $errors->first('name') }}</div>
    @enderror
    
    <label class="d-block" for="parent_id">Parent category:</label>
    <select name="parent_id" class="form-control mb-3" id="parent_id">
        <option value="" selected>No parent category</option>
        @foreach($roots as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @if($cat->children->isNotEmpty())
                @include('includes.admin.subcategories', [
                    'categories'    => $cat->children,
                    'level'         => '---',
                    'parent_id'     => null
                ])
            @endif
        @endforeach
    </select>
    
    <label for="name">Description:</label>
    <textarea id="description" name="description" class="form-control mb-3 @error('name', $errors) is-invalid @enderror">
    </textarea>
    
    <button class="btn btn-outline-success d-flex float-right" type="submit">Add category</button>
</form> 
