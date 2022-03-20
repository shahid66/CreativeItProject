@extends('layouts.Starlight')

@section('title')
edit-subcategory
@endsection
@section('content')
<section>
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('/home2') }}">Home</a>
            <a class="breadcrumb-item" href="{{ url('/subcategory') }}">SubCategory</a>

            <span class="breadcrumb-item active">Edit SubCategory</span>
        </nav>

        <div class="sl-pagebody">
    <div class="row ">

        <div class="col-md-6 m-auto">
            <div class="card">
                <div class="card-head text-center">
                    <h3>Update Sub Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/subcategory/update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input name="cat_id" value="{{ $SubCategory_id->id }}" type="hidden" class="form-control" >
                          <label for="exampleInputEmail1">Category Name</label>

                          <select class="form-control" name="category_id" id="">
                            <option value="">--SELECT--</option>
                            @foreach ($AllCategory as $item)
                            <option {{$item->id==$SubCategory_id->category_id?"selected":""  }} value="{{ $item->id }}">{{ $item->category_name }}</option>
                            @endforeach
                          </select>
                          @error('category_id')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sub Category Name</label>
                            <input name="sub_category_name" value="{{ $SubCategory_id->sub_category_name }}" type="text" class="form-control" >
                            @error('sub_category_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                          </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary ">Update</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
</section>
@endsection
