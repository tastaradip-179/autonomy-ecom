@extends('layouts.app')
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css">
<link href="{{asset('tagsinput/tagsinput.css')}}" rel="stylesheet" type="text/css">
@section('content')
        <div class="container mx-auto">
            <div class="row">
                <div class="mt-5 mb-3 flex">
                  <div style="float: right">
                      <a href="{{ route('products.index') }}" class="btn btn-success">All Products</a>
                      <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
                  </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="row">
                    <div class="col-md-7">
                        <h4 class="mt-2 text-center font-medium text-lg">Add Attributes of {{$product->name}}</h4>
                            <table class="table mt-5">
                                <thead class="thead-dark">
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Value</th>
                                    <th scope="col">Action</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                        @php($i=1)
                                        @foreach($attributes as $attribute)
                                        <form action="{{ route('products.attributes.store', ['product'=>$product]) }}" method="post">
                                            {{csrf_field()}}
                                        <tr>
                                            @php($attribute_name = $attribute->name)
                                            <input type="hidden" name="attribute_id" value={{$attribute->id}}> 
                                            <th scope="row">{{$i++}}</th>
                                            <td>{{$attribute_name}}</td>
                                            <td>
                                                <input type="text" class="form-control" name='attribute_value'
                                                data-role="tagsinput" placeholder="write a value and enter"/>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </td>
                                        </tr> 
                                        </form>
                                        @endforeach
                                </tbody>
                            </table>
                    </div>
                    <div class="col-md-5">
                        <div class="card mt-2">
                            <div class="card-header">All Attributes of {{$product->name}}</div>
                            <div class="card-body">
                                @foreach($product->attributes as $product_attribute)
                                @if($product_attribute->pivot->attribute_value != null)
                                <div style="display: flex; gap: 2px">
                                    <label>{{$product_attribute->name}}-></label>
                                    <h5>{{$product_attribute->pivot->attribute_value}}</h5>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="{{asset('tagsinput/tagsinput.js')}}"></script>
