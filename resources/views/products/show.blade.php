@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="mt-5 mb-3 flex">
          <div style="float: right">
              <a href="{{ route('products.index') }}" class="btn btn-success">All Products</a>
              <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="mt-5">
            <div class="card">
                <div class="card-header">Product Details</div>
                <div class="card-body">
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="name" class="mb-1">Title</label>
                              <input type="text" class="form-control mb-3" name="name" id="name" value={{$product->name}} readonly>
                            </div>
                            <div class="form-group">
                              <label for="code" class="mb-1">Code</label>
                              <input type="text" class="form-control mb-3" name="code" id="code" value={{$product->code}} readonly>
                            </div>
                            <div class="form-group">
                              <label for="categories" class="mb-1">Category</label>
                              <input type="text" class="form-control mb-3" name="cat" id="cat" value={{$product->categories[0]->name}} readonly>
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
                              <label for="image">Image</label>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  