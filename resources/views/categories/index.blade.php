@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <div class="mt-5 mb-3 flex">
        <div style="float: right">
            <a href="{{ route('categories.create') }}" class="btn btn-success">Add New Category</a>
            <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
        </div>
      </div>
    </div>
    <div class="row mb-5 mt-3">
        <h2>All Categories</h2>
    </div>
    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Main Category</th>
                  <th scope="col">Action</th>
                </tr>   
            </thead>
            <tbody>
                @php($i=1)
                @foreach($categories as $category)
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$category->name}}</td>
                    <td>
                        @if($category->parentCategory != null)
                        {{$category->parentCategory->name}}
                        @endif
                    </td>
                    <td style="display: flex; gap:2px">
                        <a href="{{ route('categories.show', $category) }}" class="btn btn-info">
                            View
                        </a>
                        <form id="destroy-form" action="{{ route('categories.destroy', $category) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                        </form> 
                    </td>
                </tr> 
                @endforeach
            </tbody>
        </table>
        {{$categories->render('pagination::bootstrap-4')}}
    </div>
</div>
@endsection