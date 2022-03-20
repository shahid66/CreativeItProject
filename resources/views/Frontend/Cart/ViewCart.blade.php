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
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!-- Cart Area Start -->
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="{{ route('allCartItem.update.quantity') }}" method="POST">
                    @csrf
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Size & Color</th>
                                    <th>Until Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


                                @forelse ($cartItem as $item)
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="#"><img class="img-responsive ml-15px"
                                                src="{{ asset('uploads/products/preview') }}/{{ $item->rel_to_product->product_image }}" alt="" /></a>
                                    </td>
                                    <td class="product-name"><a href="#">{{ $item->rel_to_product->product_name }}</a></td>
                                    <td class="product-name"><a href="#">{{App\Models\Size::where('id',$item->size_id)->first()->size_name  }} & {{ App\Models\color::where('id',$item->color_id)->first()->color_name  }}</a></td>
                                    <td class="product-price-cart"><span class="amount">{{ $item->rel_to_product->discount_price }}</span></td>


                                    <td class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton[{{ $item->id }}]"
                                                value="{{$item->quantity  }}" />
                                        </div>
                                    </td>
                                    <td class="product-subtotal">{{ $item->rel_to_product->discount_price * $item->quantity }}</td>
                                    <td class="product-remove">

                                        <a href="{{ route('cart.delete',$item->id) }}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="6">No item Into cart <br> Please Continue Shopping</td>
                                </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="{{ url('/') }}">Continue Shopping</a>
                                </div>
                                <div class="cart-clear">
                                    <button type="submit">Update Shopping Cart</button>
                                    <a href="{{ route('cart.clear') }}">Clear Shopping Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    {{-- <div class="col-lg-4 col-md-6 mb-lm-30px">
                        <div class="cart-tax">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                            </div>
                            <div class="tax-wrapper">
                                <p>Enter your destination to get a shipping estimate.</p>
                                <div class="tax-select-wrapper">
                                    <div class="tax-select">
                                        <label>
                                            * Country
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Bangladesh</option>
                                            <option>Albania</option>
                                            <option>Åland Islands</option>
                                            <option>Afghanistan</option>
                                            <option>Belgium</option>
                                        </select>
                                    </div>
                                    <div class="tax-select">
                                        <label>
                                            * Region / State
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Bangladesh</option>
                                            <option>Albania</option>
                                            <option>Åland Islands</option>
                                            <option>Afghanistan</option>
                                            <option>Belgium</option>
                                        </select>
                                    </div>
                                    <div class="tax-select mb-25px">
                                        <label>
                                            * Zip/Postal Code
                                        </label>
                                        <input type="text" />
                                    </div>
                                    <button class="cart-btn-2" type="submit">Get A Quote</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-6 col-md-6 mb-lm-30px">
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                            </div>
                            <div class="discount-code">
                                <p>Enter your coupon code if you have one.</p>
                                    @if ($message !=null)
                                        <div class="alert alert-warning">{{ $message }}</div>
                                    @else

                                    @endif

                                    <form action="{{ route('allCartItem') }}" method="GET">
                                    <input type="text" required="" id="coupon_name" name="coupon_name" value="{{ @$_GET['coupon_name'] }}" />
                                    <button class="cart-btn-2"  type="submit">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mt-md-30px">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>

                            <h5>Total products <span>{{ $c_product_price}} Tk</span></h5>
                            <h5>Discount <span>{{ $coupon_discount}} Tk</span></h5>
                            @php
                                session([
                                    'discount'=>$coupon_discount
                                    ])
                            @endphp
                            {{-- <div class="total-shipping">
                                <h5>Total shipping</h5>
                                <ul>
                                    <li><input type="checkbox" /> Standard <span>$20.00</span></li>
                                    <li><input type="checkbox" /> Express <span>$30.00</span></li>
                                </ul>
                            </div> --}}
                            <h4 class="grand-totall-title">Grand Total <span>{{ $c_product_price - $coupon_discount}} TK</span></h4>
                            <a href="{{ route('checkOut') }}">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Area End -->


@endsection

@section('footer_script')
{{-- <script>
    $('#applY_coupon').click(function(){
        var coupon_name=$('#coupon_name').val();
        var current_link='{{ url('/cart/all') }}';
        var create_link =current_link+'/'+coupon_name;
        window.location.href=create_link;
    });
</script> --}}

@if (session('cartClear'))
<script>
    const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: '{{ session('cartClear') }}'
})

</script>
@endif

@if (session('quantityUpdate'))
<script>
    const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: '{{ session('quantityUpdate') }}'
})

</script>
@endif

@if (session('cartDelete'))
<script>
    const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: '{{ session('cartDelete') }}'
})

</script>
@endif
@endsection





