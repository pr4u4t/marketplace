<h3>Edit category - <em>{{ $category->name }} <i class="{{ $category->icon }}"></i> </em></h3>
<hr>
<form action="{{ route('admin.categories.edit', $category->id) }}"  method="POST">
    {{ csrf_field() }}
    <label for="name">Category name</label>
    <input name="name" id="name" placeholder="Category name" value="{{ $category->name }}" class="form-control mb-3 @error('name', $errors) is-invalid @enderror"/>
    
    <label for="name">Typography: </label>
    <input id="typography" name="typography" placeholder="Category typography" value="{{ $category->icon }}" class="form-control mb-3 @error('name', $errors) is-invalid @enderror"/>
    
    <label for="weight">Weight:</label>
    <input name="weight" type="number" step="1" placeholder="0" class="form-control mb-3 @error('name', $errors) is-invalid @enderror" value="{{ $category->weight }}"/>
    
    <input name="active" type="checkbox" @if($category->active == true) checked @endif class="form-check-input ml-1 @error('name', $errors) is-invalid @enderror"/>
    <label class="form-check-label ml-4 mb-3" for="active">Active</label>
    
    @error('name', $errors)
        <div class="invalid-feedback d-block">{{ $errors->first('name') }}</div>
    @enderror
    
    <label class="d-block" for="parent_id">Parent category:</label>
    
    <select name="parent_id" class="form-control mb-3" id="parent_id">
        <option value="" @if($category->parent_id == null) selected="selected" @endif> No parent category </option>
        @foreach($roots as $cat)
            <option value="{{ $cat->id }}" @if($category->parent_id == $cat->id) selected @endif>{{ $cat->name }}</option>
            @if($cat->children->isNotEmpty())
                @include('includes.admin.subcategories', [
                    'categories'    => $cat->children,
                    'level'         => '---',
                    'parent_id'     => $category->parent_id
                ])
            @endif
        @endforeach
    </select>
    
    <label for="description">Description:</label>
    <textarea id="description" name="description"  class="form-control mb-3 @error('name', $errors) is-invalid @enderror">
        {{ $category->description }}
    </textarea>
    
    <button class="btn btn-outline-success d-flex float-right" type="submit">Save category</button>
</form> 
