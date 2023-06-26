@extends('layouts.app')
@section('content')
        <div class="container mx-auto">
            <div class="row">
                <div class="mt-5 mb-3 flex">
                  <div style="float: right">
                      <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4 class="mt-5 text-center font-medium text-lg">Add A New Attribute</h4>
                    <form action="{{ route('attributes.store') }}" method="post" class="p-5">
                        {{csrf_field()}}
                        <div class="mx-auto">
                            <div class="form-group">
                                <label for="name" class="mb-1">Name</label>
                                <input type="text" class="form-control mb-3" name="name" id="name">
                                <div class="error">{{$errors->first('name')}}</div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </form> 
                </div>
                <div class="col-md-6">
                    <h4 class="mt-5 text-center font-medium text-lg">All Attributes</h4>
                    <table class="table mt-5">
                        <thead class="thead-dark">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Action</th>
                            </tr>   
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($attributes as $attribute)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td>{{$attribute->name}}</td>
                                <td>
                                    <form id="destroy-form" action="{{ route('attributes.destroy', $attribute) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger">Delete</button>
                                    </form> 
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection  