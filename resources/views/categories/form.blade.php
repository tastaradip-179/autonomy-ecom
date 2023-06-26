{{csrf_field()}}
<input type="hidden" name="id" value="{{ $category->id }}">
<div class="row mt-5">
  <div class="mx-auto" style="width: 500px">
      <div class="form-group">
        <label for="name" class="mb-1">Name</label>
        <input type="text" class="form-control mb-3" name="name" id="name" value="{{ old('name', $category->name)}}">
        <div class="error">{{$errors->first('name')}}</div>
      </div>
      <div class="form-group">
        <label for="parent_id" class="mb-1">Parent Category</label>
        <select class="form-control mb-3" name="parent_id" id="parent_id">
          <option value="0">Select</option>
            @foreach($categories as $parent_category)
                <option value="{{$parent_category->id}}" {{($category->parent_id === $parent_category->id) ? "selected" : null}}>
                  {{$parent_category->name}}
                </option>
            @endforeach
        </select>
        <div class="error">{{$errors->first('parent_id')}}</div>
      </div>
  </div>
</div>
<div class="mt-5 text-center">
  <button type="submit" class="btn btn-primary btn-lg">Submit</button>
</div>


