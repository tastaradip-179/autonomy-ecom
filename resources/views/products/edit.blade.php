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
                <div class="card-header">Edit Product</div>
                <div class="card-body">
                    <form action="{{ route('products.update', ['product'=> $product]) }}" method="post"  enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @include('products.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  