@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="mt-5 mb-3 flex">
          <div style="float: right">
              <a href="{{ route('categories.index') }}" class="btn btn-success">All Categories</a>
              <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
          </div>
        </div>
    </div>
    <div class="row mt-5 mx-auto">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Category Details</div>
                <div class="card-body">
                    <form action="{{ route('categories.update', ['category'=> $category]) }}" method="post">
                        @include('categories.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  