@extends('layouts.Starlight')

@section('title')
edit-category
@endsection
@section('content')
<section>
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('/home2') }}">Home</a>
            <a class="breadcrumb-item" href="{{ url('/category') }}">Category</a>

            <span class="breadcrumb-item active">Edit Category</span>
        </nav>

        <div class="sl-pagebody">
    <div class="row ">

        <div class="col-md-6 m-auto">





            <div class="card">
                <div class="card-head text-center">
                    <h3>Update  Category Name</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/category/update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input name="cat_id" value="{{ $Category_id->id }}" type="hidden" class="form-control" >
                          <label for="exampleInputEmail1">Category Name</label>
                          <input name="category_name" value="{{ $Category_id->category_name }}" type="text" class="form-control"  placeholder="Enter email">
                          @error('category_name')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary ">Update</button>
                        </div>
                      </form>

                </div>
            </div>
            <div class="card">
                <div class="card-head text-center">
                    <h3>Update Category Image</h3>
                    @if (session('cat_image_update'))
                    <div class="alert alert-success">
                        {{ session('cat_image_update') }}
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ url('/category/image/update') }}" method="POST"  enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input name="cat_id" value="{{ $Category_id->id }}" type="hidden" class="form-control" >
                            <label for="exampleInputEmail1">Category Image</label>
                            <input name="category_image" type="file" class="form-control" >
                            @error('category_image')
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
