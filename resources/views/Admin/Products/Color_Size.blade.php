@extends('layouts.Starlight')

@section('title')
Color & Size
@endsection
@section('colorSize')
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
                    <h3>All Color</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Color Name</th>

                            <th scope="col">Color</th>
                            <th scope="col">Created_at</th>

                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($AllColor as $key=> $item)
                            <tr>
                                <th scope="row">{{$key+1 }}</th>
                                <td>{{ $item->color_name }}</td>
                                <td><i class="color_icon" style="background:{{ $item->color_code }};"></i></td>
                                <td>{{ $item->created_at->diffForHumans()  }}</td>

                                <td>


                                    <a class="btn btn-danger" href="{{ url('/category/delete/') }}/{{ $item->id }}">Delete</a>
                                </td>
                              </tr>
                            @endforeach


                        </tbody>
                      </table>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-head text-center">
                    <h3>All Size</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>


                            <th scope="col">Size</th>
                            <th scope="col">Created_at</th>

                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($AllSize as $key=> $item)
                            <tr>
                                <th scope="row">{{$key+1 }}</th>
                                <td>{{ $item->size_name }}</td>

                                <td>{{ $item->created_at->diffForHumans() }}</td>

                                <td>


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
                    <h3>Add Color</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/color/size/insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Color Name</label>
                          <input name="color_name"   type="text" class="form-control"  >
                          @error('color_name')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Color Code</label>
                            <input name="color_code"  type="text" class="form-control"  >
                            @error('product_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                          </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary ">Add</button>
                        </div>
                      </form>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-head text-center">
                    <h3>Add Size</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/size/insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Size Name</label>
                          <input name="size_name"   type="text" class="form-control"  >
                          @error('size_name')
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

{{-- @section('footer_script')

<script>
    $('.select_category').change(function(){
        var category_id=$(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getSubCategory',
            data:{category_id:category_id},
            success:function(data){
                $('#sub_cat').html(data);
            }
        })

    });

    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.select_category').select2();
});
</script>

@endsection --}}
