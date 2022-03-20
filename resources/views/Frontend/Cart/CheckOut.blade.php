@extends('layouts.FrontEndMaster')

@section('contend')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Shop</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->


<!-- checkout area start -->
<div class="checkout-area pt-100px pb-100px">
    <div class="container">
        <form action="{{ url('/order/insert') }}" method="POST">
            @csrf
        <div class="row">
            @if (session('quantity_nai'))
                <div class="alert">{{ session('quantity_nai') }}</div>
            @endif
            <div class="col-lg-7">
                <div class="billing-info-wrap">
                    <h3>Billing Details</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ Auth::guard('customerlogin')->user()->name }}"/>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ Auth::guard('customerlogin')->user()->email }}"/>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <label>Company Name</label>
                                <input type="text" name="company_name" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="billing-select mb-4">
                                <label>Country</label>
                                <select class="js-example-basic-single" name="country_id" id="country_id">
                                    <option>Select a country</option>
                                    @foreach ($country as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach


                                </select>
                                @error('country_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="billing-select mb-4">
                                <label>Town / City</label>
                                <select class="js-example-basic-single" name="city_id" id="city_id">
                                    <option>Select a City</option>



                                </select>
                                @error('city_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <label>Street Address</label>
                                <input class="billing-address" name="address" placeholder="House number and street name"
                                    type="text" />

                            </div>
                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>


                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <label>Postcode / ZIP</label>
                                <input type="number" name="zip_code"/>
                                @error('zip_code')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <label>Phone</label>
                                <input type="number" name="phone"/>
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="additional-info-wrap">
                        <h4>Additional information</h4>
                        <div class="additional-info">
                            <label>Order notes</label>
                            <textarea placeholder="Notes about your order, e.g. special notes for delivery. "
                                name="notes"></textarea>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                <div class="your-order-area">
                    <h3>Your order</h3>
                    <div class="your-order-wrap gray-bg-4">
                        <div class="your-order-product-info">
                            <div class="your-order-top">
                                <ul>
                                    <li>Product</li>
                                    <li>Total</li>
                                </ul>
                            </div>
                            <div class="your-order-middle">
                                <ul>
                                    @php
                                        $total=0;
                                    @endphp
                                    @foreach ($Cart as $item)
                                    <li><span class="order-middle-left">{{ $item->rel_to_product->product_name }} X {{ $item->quantity }}</span> <span
                                        class="order-price">{{ $item->rel_to_product->discount_price * $item->quantity}} TK</span></li>

                                        @php
                                        $total +=$item->rel_to_product->discount_price * $item->quantity;
                                    @endphp
                                    @endforeach


                                </ul>
                            </div>
                            <div class="your-order-middle">
                                <ul>
                                    <li><span class="order-middle-left">Discount</span> <span
                                        class="order-price">{{ session('discount')}} TK</span></li>

                                </ul>
                            </div>
                            <div class="your-order-bottom">

                                <input style="width: 15px;height:15px" type="radio"  id="charge2" name="charge" class="charge" value="1"> Outside Dhaka (60 Tk) <br>
                                <input style="width: 15px;height:15px" type="radio"  id="charge2" name="charge" class="charge" value="2"> Outside Dhaka (100 Tk)
                                @error('charge')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="your-order-total">

                                <p class="d-none" id="discount_session" >{{ session('discount')}}</p>
                                <input class="d-none" type="text" name="discount_session" id="" value="{{ session('discount')}}">

                                <ul>
                                    <li class="order-total">Total</li>
                                    <li><span  >{{$total - session('discount')}}</span> Tk</li>

                                </ul>
                                <ul>
                                    <li class="order-total"></li>
                                    <li><span >+</span> </li>

                                </ul>
                                <ul>
                                    <li class="order-total"></li>
                                    <li>Delivery Charge</li>

                                </ul>

                            </div>

                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion element-mrg">
                                <div id="faq" class="panel-group">
                                    <div class="panel panel-default single-my-account m-0">
                                        <div class="panel-heading my-account-title">
                                            <input style="width: 15px;height:15px"  type="radio" name="payment_method" id="" value="1"> Cash on delivery
                                        </div>

                                    </div>
                                    <div class="panel panel-default single-my-account m-0">
                                        <div class="panel-heading my-account-title">
                                            <input style="width: 15px;height:15px"  type="radio" name="payment_method" id="" value="2"> Pay with SSLCommers
                                        </div>
                                    </div>
                                    <div class="panel panel-default single-my-account m-0">
                                        <div class="panel-heading my-account-title">
                                            <input style="width: 15px;height:15px"  type="radio" name="payment_method" value="3"> Pay with Stripe
                                        </div>
                                    </div>
                                    @error('payment_method')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Place-order mt-25">
                        <button class="btn-hover btn btn-primary" id="submit" type="submit">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
<!-- checkout area end -->




@endsection

@section('footer_script')
<script>
    $('#country_id').change(function(){
        var country_id =$(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getCity ',
            data:{country_id :country_id },
            success:function(data){

                $('#city_id').html(data);
            }
        })

    });

    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});



</script>
@endsection





