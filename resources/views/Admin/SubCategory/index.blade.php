@extends('layouts.Starlight')

@section('title')
subcategory
@endsection
@section('subcategory')
active
@endsection
@section('content')
<section>
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="{{ url('/home2') }}">Home</a>
          <a class="breadcrumb-item" href="{{ url('/category') }}">Category</a>
          <a class="breadcrumb-item" href="{{ url('/subcategory') }}">SubCategory</a>
        </nav>

        <div class="sl-pagebody">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-head text-center">
                    <h3>All Sub Category</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sub Category Name</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Created_BY</th>
                            <th scope="col">Created_At</th>
                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($AllSubCategory as $key=> $item)
                            <tr>
                                <th scope="row">{{$key+1 }}</th>
                                <td>{{ $item->sub_category_name }}</td>
                                <td>{{  App\Models\CategoryModel::find($item->category_id)->category_name  }}</td>
                                <td>{{ App\Models\User::find($item->added_by)->name }}</td>
                                <td>{{ $item->created_at->diffInHours() >24?$item->created_at:$item->created_at->diffForHumans()  }}</td>
                                <td>

                                    <a class="btn btn-warning" href="{{ url('/subcategory/edit/') }}/{{ $item->id }}">Edit</a>
                                    <a class="btn btn-danger" href="{{ url('/subcategory/delete/') }}/{{ $item->id }}">Delete</a>
                                </td>
                              </tr>
                            @endforeach


                        </tbody>
                      </table>
                </div>
            </div>


                <div class="card">
                    <div class="card-head text-center">
                        <h3>All trash Sub Category</h3>
                    </div>
                    <div class="card-body">
                        @if (session('soft_delete'))
                        <div class="alert alert-success">
                            {{ session('soft_delete') }}
                        </div>
                         @endif

                         @if (session('delete'))
                        <div class="alert alert-success">
                            {{ session('delete') }}
                        </div>
                        @endif

                        @if (session('restore'))
                        <div class="alert alert-success">
                            {{ session('restore') }}
                        </div>
                        @endif
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Sub Category Name</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Created_BY</th>
                                <th scope="col">Created_At</th>
                                <th scope="col">Action</th>

                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($AllTrashSubCategory as $key=> $item)
                                <tr>
                                    <th scope="row">{{$key+1 }}</th>
                                    <td>{{ $item->sub_category_name }}</td>
                                    <td>{{  App\Models\CategoryModel::find($item->category_id)->category_name  }}</td>
                                    <td>{{ App\Models\User::find($item->added_by)->name }}</td>
                                    <td>{{ $item->created_at->diffInHours() >24?$item->created_at:$item->created_at->diffForHumans()  }}</td>
                                    <td>

                                        <a class="btn btn-warning" href="{{ url('/subcategory/restore/') }}/{{ $item->id }}">Restore</a>
                                        <a class="btn btn-danger" href="{{ url('/subcategory/permanentDelete/') }}/{{ $item->id }}">Delete</a>
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
                    <h3>Add Sub Category</h3>
                </div>
                @if (session('insert'))
                    <div class="alert alert-success">
                        {{ session('insert') }}
                    </div>
                @endif
                @if (session('exists'))
                <div class="alert alert-danger">
                    {{ session('exists') }}
                </div>
                @endif
                <div class="card-body">
                    <form action="{{ url('/subcategory/insert') }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Category Name</label>

                          <select class="form-control" name="category_id" id="">
                            <option value="">--SELECT--</option>
                            @foreach ($AllCategory as $item)
                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                            @endforeach
                          </select>
                          @error('category_id')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sub Category Name</label>
                            <input name="sub_category_name" type="text" class="form-control" >
                            @error('sub_category_name')
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
