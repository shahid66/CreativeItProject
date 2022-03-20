@extends('layouts.Starlight')

@section('title')
Inventory
@endsection
@section('Inventory')
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
                    <h3>All Inventory Details</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>

                            <th scope="col">Color</th>
                            <th scope="col">Size</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Created_at</th>
                            {{-- <th scope="col">Description</th>
                            <th scope="col">Images</th> --}}
                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($AllInventory as $key=> $item)
                            <tr>
                                <th scope="row">{{$key+1 }}</th>
                                <td>{{ $item->rel_to_product->product_name }}</td>
                                <td>{{ $item->rel_to_color->color_name }}</td>
                                <td>{{ $item->rel_to_size->size_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>




                                <td>

                                    <a class="btn btn-info" href="{{ url('/category/edit/') }}/{{ $item->id }}">Edit</a>
                                    <a class="btn btn-danger deleteBtn" href="{{ route('inventory.delete',$item->id)}}">Delete</a>
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
                    <h3>Add Inventory </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/InventoryInsert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Product Name</label>
                          <input name="product_id" value="{{ $product->id }}"   type="hidden" class="form-control"  >
                          <input name="product_name" value="{{ $product->product_name }}" readonly type="text" class="form-control"  >
                          @error('product_name')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Color Select</label>
                            <select class="form-control select_category" name="color_id" id="">
                                <option value="">--SELECT--</option>
                                @foreach ($color as $item)
                                <option  value="{{ $item->id }}">{{ $item->color_name }}</option>
                                @endforeach
                              </select>
                              @error('color_id')
                              <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Size Select</label>
                            <select class="form-control" name="size_id" id="sub_cat">
                                <option value="">--SELECT--</option>
                                @foreach ($Size as $item)
                                <option  value="{{ $item->id }}">{{ $item->size_name }}</option>
                                @endforeach
                              </select>
                              @error('size_id')
                              <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Product Quantity</label>
                            <input name="product_quantity" type="text" class="form-control"  >
                            @error('product_quantity')
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

    const deletebtns = document.querySelectorAll(".deleteBtn");

    deletebtns.forEach(function (btn) {

        const href = btn.getAttribute('href');

        btn.addEventListener('click', function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            })
        })
    })
</script>

@endsection
