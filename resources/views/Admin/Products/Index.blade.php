@extends('layouts.Starlight')

@section('title')
product
@endsection
@section('product')
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
                    <h3>All Product</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>

                            <th scope="col">Price</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Discount Price</th>
                            <th scope="col">Description</th>
                            <th scope="col">Images</th>
                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($allProduct as $key=> $item)
                            <tr>
                                <th scope="row">{{$key+1 }}</th>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->product_price }}</td>
                                <td>{{ $item->discount }}</td>
                                <td>{{ $item->discount_price }}</td>
                                <td>{{substr($item->description,0,50).'...more' }}</td>
                                <td>
                                    <img width="50" src="{{ asset('/uploads/products/preview')}}/{{ $item->product_image }}" alt="">
                                </td>

                                {{-- <td>{{ $item->created_at->diffInHours() >24?$item->created_at:$item->created_at->diffForHumans()  }}</td> --}}
                                <td>

                                    <a class="btn btn-info" href="{{ url('/InventoryIndex') }}/{{ $item->id }}">Inventory</a>
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
                    <form action="{{ url('/product/insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Product Name</label>
                          <input name="product_name" type="text" class="form-control"  >
                          @error('product_name')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Name</label>
                            <select class="form-control select_category" name="category_id" id="">
                                <option value="">--SELECT--</option>
                                @foreach ($allCategory as $item)
                                <option  value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @endforeach
                              </select>
                              @error('category_id')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">SubCategory Name</label>
                            <select class="form-control" name="sub_category_id" id="sub_cat">
                                <option value="">--SELECT--</option>
                                {{-- @foreach ($AllCategory as $item)
                                <option {{$item->id==$SubCategory_id->category_id?"selected":""  }} value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @endforeach --}}
                              </select>
                              @error('sub_category_id')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Product Price</label>
                            <input name="product_price" type="text" class="form-control"  >
                            @error('product_price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Discount %</label>
                            <input name="discount_percent" type="text" class="form-control" >
                            @error('discount_percent')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                          </div>
                          {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Discount Amount</label>
                            <input name="discount_price" type="text" class="form-control"  >
                            @error('discount_percent')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                          </div> --}}

                          <div class="form-group">
                            <label for="exampleInputEmail1">Description </label>
                            <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Image </label>
                            <input name="image" type="file" class="form-control"  >
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Product Thumbnails </label>
                            <input multiple name="image_thumbnails[]" type="file" class="form-control"  >
                            @error('image_thumbnails')
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

@section('footer_script')

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

@endsection
