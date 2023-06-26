{{csrf_field()}}
<input type="hidden" name="id" value="{{ $product->id }}">
<div class="row mt-5">
  <div class="col-md-6">
      <div class="form-group">
        <label for="name" class="mb-1">Title</label>
        <input type="text" class="form-control mb-3" name="name" id="name" value="{{ old('name', $product->name)}}" required>
        <div class="error">{{$errors->first('name')}}</div>
      </div>
      <div class="form-group">
        <label for="code" class="mb-1">Code</label>
        <input type="text" class="form-control mb-3" name="code" id="code" value="{{ old('code', $product->code)}}" required>
        <div class="error">{{$errors->first('code')}}</div>
      </div>
      <div class="form-group">
        <label for="categories" class="mb-1">Category</label>
        <div class="multiselect-dropdown">
          <select class="form-control mb-3" name="categories[]" id="checkboxes" multiple="multiple">
            @foreach($categories as $category)
                <option value="{{$category->id}}" 
                  {{$product->categories[0]->id ? ($product->categories[0]->id === $category->id) ? "selected" : null : null}} required
                >
                  {{$category->name}}
                </option>
            @endforeach
          </select>
        </div>
        <div class="error">{{$errors->first('categories')}}</div>
      </div>
      <div class="form-group">
        <label for="warranties" class="mb-1">Warranty Period</label>
        <select class="form-control mb-3" name="warranty" id="warranties">
            <option value="None" {{($product->warranty === "None") ? "selected" : null}}>
                None
            </option>
            <option value="None" {{($product->warranty === "6 months") ? "selected" : null}}>
                6 months
            </option>
            <option value="None" {{($product->warranty === "1 year") ? "selected" : null}}>
                1 Year
            </option>
        </select>
        <div class="error">{{$errors->first('warranty')}}</div>
      </div>
      <div class="form-group">
        <label for="image">Change Image</label>
        <input type="file" name="image" class="form-control-file" id="image">
        @if($product->getImage() != "")
            <img style="width: 100px" src="{{ $file_path_view.$product->getImage() }}" alt="Thumbnail">
        @endif
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
        <label for="price" class="mb-1">Price</label>
        <input type="number" class="form-control mb-3" name="price" id="price" value="{{old('price', $product->price)}}" required>
        <div class="error">{{$errors->first('price')}}</div>
      </div>
      <div class="form-group">
        <label for="quantity" class="mb-1">Quantity</label>
        <input type="number" class="form-control mb-3" name="quantity" id="quantity" value="{{old('quantity', $product->quantity)}}" required>
        <div class="error">{{$errors->first('quantity')}}</div>
      </div>
      <div class="form-group">
        <label for="description" class="mb-1">Description</label>
        <textarea name="description" id="description" rows="5" class="form-control mb-3" >
          {{old('description', $product->description)}}
        </textarea>
        <div class="error">{{$errors->first('description')}}</div>
      </div>
  </div>
</div>
<div class="mt-5">
  <button type="submit" class="btn btn-primary btn-lg" style="float: right">Submit</button>
</div>

<!-- Initialize the plugin: -->
      <script src=
"http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js">
      </script> 
      <link href=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
            rel="stylesheet" > 
      <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
      </script>
      <script src=
"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js">
      </script> 
      <link href=
"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"
      rel="stylesheet">
<script> 
  $(document).ready(function() { 
      $('#checkboxes').multiselect(); 
  }); 
</script> 


