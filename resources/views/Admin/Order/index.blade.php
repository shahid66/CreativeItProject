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
                            <h3>All Users</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User_name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Order</th>
                                    <th scope="col">Payment Method</th>

                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Total Tk</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key=>$item)
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        <td>{{ $item->rel_to_customer->name }}</td>
                                        <td>{{ $item->rel_to_customer->email }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            @php
                                                if($item->payment_method==1){
                                                    echo "Cash On delivery";
                                                }else if($item->payment_method==2){
                                                    echo "SSLCommerch";
                                                }else if($item->role==3){
                                                    echo "janina";
                                                }
                                            @endphp</td>
                                        <td>{{ $item->created_at->diffInHours() >24?$item->created_at->format('d/m/y h:i:s A'):$item->created_at->diffForHumans() }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->total }}</td>



                                        <td>
                                            <a class="btn btn-danger deleteBtn" href="{{route('user.delete',$item->id) }}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>

                            </table>
                            {{-- {{ $orders->links() }} --}}
                        </div>
                    </div>
                </div>

            </div>
</div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
</section>
@endsection
@section('footer_script')




@endsection
