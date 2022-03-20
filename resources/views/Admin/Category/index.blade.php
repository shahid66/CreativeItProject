@extends('layouts.Starlight')

@section('title')
category
@endsection
@section('category')
active
@endsection
@section('content')
<section>
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="{{ url('/home2') }}">Home</a>
          <a class="breadcrumb-item" href="{{ url('/category') }}">Category</a>

        </nav>

        <div class="sl-pagebody">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-head text-center">
                    <h3>All Category</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Category Image</th>
                            <th scope="col">Created_BY</th>
                            <th scope="col">Created_At</th>
                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($AllCategory as $key=> $item)
                            <tr>
                                <th scope="row">{{$key+1 }}</th>
                                <td>{{ $item->category_name }}</td>
                                <td> <img width="80" src="{{ asset('uploads/category/images') }}/{{ $item->category_image }}" alt=""> </td>
                                <td>{{ App\Models\User::find($item->added_by)->name }}</td>
                                <td>{{ $item->created_at->diffInHours() >24?$item->created_at:$item->created_at->diffForHumans()  }}</td>
                                <td>

                                    <a class="btn btn-warning" href="{{ url('/category/edit/') }}/{{ $item->id }}">Edit</a>
                                    <a class="btn btn-danger" href="{{ url('/category/delete/') }}/{{ $item->id }}">Delete</a>
                                </td>
                              </tr>
                            @endforeach


                        </tbody>
                      </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-head text-center">
                    <h3>Add Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/category/insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Category Name</label>
                          <input name="category_name" type="text" class="form-control" >
                          @error('category_name')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Image</label>
                            <input name="category_image" type="file" class="form-control" >
                            @error('category_image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                          </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary ">Add</button>
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
