@extends('layouts.Starlight')

@section('dashboard')
active
@endsection
@section('title')
dashbord
@endsection
@section('content')
<section>
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="{{ url('/home2') }}">Home</a>


        </nav>

        <div class="sl-pagebody">
            <div class="row ">

                <div class="col-md-8 ">
                    <div class="card">
                        <div class="card-head text-center">
                            <h3>All Coupon</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Validity</th>

                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($AllCoupon as $key=>$coupon)
                                    <tr>
                                        <th scope="row">{{ $AllCoupon->firstItem()+$key }}</th>
                                        <td>{{ $coupon->coupon_name }}</td>

                                        <td>{{ $coupon->coupon_discount }}</td>
                                        <td>{{ $coupon->coupon_validity }}</td>


                                        <td>{{ $coupon->created_at->diffInHours() >24?$coupon->created_at->format('d/m/y h:i:s A'):$coupon->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a class="btn btn-danger" href="{{ url('/subcategory/edit/') }}/{{ $coupon->id }}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>

                            </table>
                            {{ $AllCoupon->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-head text-center">
                            <h2>Add Coupon</h2>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('coupon.insert') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Coupon Name</label>
                                    <input type="text" name="coupon_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Coupon Discount</label>
                                    <input type="number" name="coupon_discount" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Coupon Validity</label>
                                    <input type="date" name="coupon_validity" class="form-control">
                                </div>


                                <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add Coupon</button>
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
