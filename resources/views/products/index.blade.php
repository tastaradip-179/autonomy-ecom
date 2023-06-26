@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <div class="mt-5 mb-3 flex">
        <div style="float: right">
            <a href="{{ route('products.create') }}" class="btn btn-success">Add New Product</a>
            <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
        </div>
      </div>
    </div>
    <div class="row">
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::has('fail'))
            <div class="alert alert-danger">
                {{Session::get('fail')}}
            </div>
        @endif
    </div>
    <form action="{{ route('products.search') }}" method="post">
        {{csrf_field()}} 
        <div class="row mt-5">
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="form-control mb-3" name="name" id="name" placeholder="Search by name"  value="{{ old('name')}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="form-control mb-3" name="code" id="code" placeholder="Search by code"   value="{{ old('code')}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select class="form-control mb-3" name="category" id="category">
                        <option value="">Search by category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">
                              {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <div class="row mb-5 mt-3">
        <h2>All Products</h2>
    </div>
    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Image</th>
                  <th scope="col">Title</th>
                  <th scope="col">Code</th>
                  <th scope="col">Category</th>
                  <th scope="col">Price</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Action</th>
                </tr>   
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>
                        @if($product->getImage() != "")
                            <img style="width: 100px" src="{{ $file_path_view.$product->getImage() }}" alt="Thumbnail">
                        @endif
                    </td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->code}}</td>
                    <td>{{$product->category_id}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Action
                            </button>
                            <ul class="dropdown-menu">
                              <li style="border-bottom: 1px solid #ccc">
                                <a class="dropdown-item" href="{{ route('products.show', $product) }}">View</a>
                              </li>
                              <li style="border-bottom: 1px solid #ccc">
                                <a class="dropdown-item" href="{{ route('products.edit', $product) }}">Edit</a>
                              </li>
                              <li style="border-bottom: 1px solid #ccc">
                                <a class="dropdown-item" href="{{ route('products.attributes.view', $product) }}">Attributes</a>
                              </li>
                              <li class="text-center pt-2">
                                <form id="destroy-form" action="{{ route('products.destroy', $product) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger">Delete</button>
                                </form> 
                              </li>
                            </ul>
                        </div>
                    </td>
                </tr> 
                @endforeach
            </tbody>
        </table>
        {{$products->render('pagination::bootstrap-4')}}
    </div>
</div>
@endsection