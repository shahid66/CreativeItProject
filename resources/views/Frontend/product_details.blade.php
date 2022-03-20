@extends('layouts.FrontEndMaster')

@section('contend')


<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Product Details</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Product Details</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!-- Product Details Area Start -->
<div class="product-details-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                <!-- Swiper -->
                <div class="swiper-container zoom-top">
                    <div class="swiper-wrapper">
                        @foreach (App\Models\ProductThumbnail::where('product_id',$product_details->id)->get() as $item)

                        <div class="swiper-slide zoom-image-hover">
                            <img class="img-responsive m-auto" src="{{ asset('uploads/products/thumbnails') }}/{{ $item->thumbnail_name }}"
                                alt="">
                        </div>

                        @endforeach


                    </div>
                </div>
                <div class="swiper-container zoom-thumbs mt-3 mb-3">
                    <div class="swiper-wrapper">
                        @foreach (App\Models\ProductThumbnail::where('product_id',$product_details->id)->get() as $item)
                        <div class="swiper-slide">
                            <img class="img-responsive m-auto" src="{{ asset('uploads/products/thumbnails') }}/{{ $item->thumbnail_name }}"
                                alt="">
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">

                <form action="{{ url('/cart/insert') }}" method="POST">
                    @csrf

                    <div class="product-details-content quickview-content">
                        <h2>{{ $product_details->product_name }}</h2>
                        <div class="pricing-meta">
                            <ul>
                                @if ($product_details->discount)
                                <li class="old-price not-cut">BDT {{ $product_details->discount_price }}</li>
                                <li class="old-price cut">BDT {{ $product_details->product_price }}</li>
                                @else

                                <li class="old-price not-cut">BDT {{ $product_details->product_price }}</li>
                                @endif
                            </ul>
                        </div>
                        <div class="pro-details-rating-wrap">
                            <div class="rating-product">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="read-review"><a class="reviews" href="#">( 5 Customer Review )</a></span>
                        </div>
                        @if (App\Models\Inventory::where('product_id',$product_details->id)->where('color_id',1)->exists())

                        <input type="hidden" name="product_id" id="product_id" value="{{ $product_details->id }}">
                        <input type="hidden" name="color_id" id="color_id" value="{{ 1 }}">

                        @else
                        <div class="pro-details-color-info d-flex align-items-center">

                            <span>Color</span>
                            <div class="pro-details-color">
                                <ul>


                                    @foreach ($available_color as $color)
                                    <li><a class="color_id" name="{{ $color->color_id }}"  style="background:{{ App\Models\color::find($color->color_id)->color_code }} "></a></li>
                                    @endforeach
                                    <input type="hidden" name="color_id" id="color_id" value="{{ $color->color_id }}">

                                    <input type="hidden" name="product_id" id="product_id" value="{{ $product_details->id }}">


                                </ul>
                            </div>
                        </div>
                        @endif
                        <!-- Sidebar single item -->
                        @if (App\Models\Inventory::where('product_id',$product_details->id)->where('size_id',1)->exists())
                        <input type="hidden" name="size_id" id="size_id" value="{{ 1 }}">
                        @else
                        <div class="pro-details-size-info d-flex align-items-center">
                            <span>Size</span>
                            <div class="pro-details-size">
                                <ul id="color_details">
                                    Color select first

                                </ul>
                            </div>
                        </div>

                        <input type="hidden" name="size_id" id="size_id" value="">


                        <p style="color: red; font-weight:700"> <span id="qu_av"></span></p>
                        @endif

                        <p class="m-0">{{ $product_details->description }}</p>
                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                            </div>
                            @auth('customerlogin')
                            <div class="pro-details-cart">
                                <button class="add-cart" type="submit"> Add To
                                    Cart</button>
                            </div>
                            @else
                            <div class="pro-details-cart">
                                <a class="add-cart" href="{{ url('/customer/register/view') }}"> Add ToT
                                    Cart</a>
                            </div>
                            @endauth
                            <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                @if (App\Models\WishList::where('user_id',Auth::guard('customerlogin')->id())->where('product_id',$product_details->id)->exists())
                                <a class="wis_select" href="{{ route('wishInsert',$product_details->id) }}"><i class="pe-7s-like "></i></a>
                                @else
                                <a  href="{{ route('wishInsert',$product_details->id) }}"><i class="pe-7s-like "></i></a>
                                @endif


                            </div>
                            <div class="pro-details-compare-wishlist pro-details-compare">
                                <a href="compare.html"><i class="pe-7s-refresh-2"></i></a>
                            </div>
                        </div>
                        <div class="pro-details-sku-info pro-details-same-style  d-flex">
                            <span>SKU: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="#">Ch-256xl</a>
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-categories-info pro-details-same-style d-flex">
                            <span>Categories: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="#">{{ App\Models\CategoryModel::find($product_details->category_id)->category_name }}</a>
                                </li>
                                <li>,</li>
                                <li>
                                    <a href="#">{{ App\Models\SubcategoryModel::find($product_details->subcategory_id)->sub_category_name }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-social-info pro-details-same-style d-flex">
                            <span>Share: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- product details description area start -->
<div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav">
                <a data-bs-toggle="tab" href="#des-details2">Information</a>
                <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                <a data-bs-toggle="tab" href="#des-details3">Reviews (02)</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details2" class="tab-pane">
                    <div class="product-anotherinfo-wrapper text-start">
                        <ul>
                            <li><span>Weight</span> 400 g</li>
                            <li><span>Dimensions</span>10 x 10 x 15 cm</li>
                            <li><span>Materials</span> 60% cotton, 40% polyester</li>
                            <li><span>Other Info</span> American heirloom jean shorts pug seitan letterpress</li>
                        </ul>
                    </div>
                </div>
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p>

                            Lorem ipsum dolor sit amet, consectetur adipisi elit, incididunt ut labore et. Ut enim
                            ad minim veniam, quis nostrud exercita ullamco laboris nisi ut aliquip ex ea commol
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                            eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                            qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste
                            natus error sit voluptatem accusantiulo doloremque laudantium, totam rem aperiam, eaque
                            ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                            explicabo. Nemo enim ipsam voluptat quia voluptas sit aspernatur aut odit aut fugit, sed
                            quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro
                            quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                            quia non numquam eius modi tempora incidunt ut labore

                        </p>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="review-wrapper">
                                <div class="single-review">
                                    <div class="review-img">
                                        <img src="assets/images/review-image/1.png" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>White Lewis</h4>
                                                </div>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="review-left">
                                                <a href="#">Reply</a>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>
                                                Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                cubilia Curae Suspendisse viverra ed viverra. Mauris ullarper
                                                euismod vehicula. Phasellus quam nisi, congue id nulla.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-review child-review">
                                    <div class="review-img">
                                        <img src="assets/images/review-image/2.png" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>White Lewis</h4>
                                                </div>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="review-left">
                                                <a href="#">Reply</a>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                cubilia Curae Sus pen disse viverra ed viverra. Mauris ullarper
                                                euismod vehicula.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="ratting-form-wrapper pl-50">
                                <h3>Add a Review</h3>
                                <div class="ratting-form">
                                    <form action="#">
                                        <div class="star-box">
                                            <span>Your rating:</span>
                                            <div class="rating-product">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="rating-form-style">
                                                    <input placeholder="Name" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="rating-form-style">
                                                    <input placeholder="Email" type="email" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    <textarea name="Your Review" placeholder="Message"></textarea>
                                                    <button class="btn btn-primary btn-hover-color-primary "
                                                        type="submit" value="Submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product details description area end -->

<!-- Related product Area Start -->
<div class="related-product-area pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30px0px line-height-1">
                    <h2 class="title m-0">Related Products</h2>
                </div>
            </div>
        </div>
        <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
            <div class="new-product-wrapper swiper-wrapper">
                <div class="new-product-item swiper-slide">
                    <!-- Single Prodect -->
                    <div class="product">
                        <div class="thumb">
                            <a href="single-product.html" class="image">
                                <img src="assets/images/product-image/8.jpg" alt="Product" />
                            </a>
                            <span class="badges">
                                <span class="new">New</span>
                            </span>
                            <div class="actions">
                                <a href="#" class="action wishlist" title="Wishlist"><i
                                        class="pe-7s-like"></i></a>
                                <a href="#" class="action quickview" data-link-action="quickview"
                                    title="Quick view" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                <a href="compare.html" class="action compare" title="Compare"><i
                                        class="pe-7s-refresh-2"></i></a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <span class="ratings">
                                <span class="rating-wrap">
                                    <span class="star" style="width: 100%"></span>
                                </span>
                                <span class="rating-num">( 5 Review )</span>
                            </span>
                            <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                    Coat
                                </a>
                            </h5>
                            <span class="price">
                                <span class="new">$38.50</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="new-product-item swiper-slide">
                    <!-- Single Prodect -->
                    <div class="product">
                        <div class="thumb">
                            <a href="single-product.html" class="image">
                                <img src="assets/images/product-image/9.jpg" alt="Product" />
                            </a>
                            <span class="badges">
                                <span class="sale">-10%</span>
                                <span class="new">New</span>
                            </span>
                            <div class="actions">
                                <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                        class="pe-7s-like"></i></a>
                                <a href="#" class="action quickview" data-link-action="quickview"
                                    title="Quick view" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                <a href="compare.html" class="action compare" title="Compare"><i
                                        class="pe-7s-refresh-2"></i></a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <span class="ratings">
                                <span class="rating-wrap">
                                    <span class="star" style="width: 80%"></span>
                                </span>
                                <span class="rating-num">( 4 Review )</span>
                            </span>
                            <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                    Tights</a>
                            </h5>
                            <span class="price">
                                <span class="new">$38.50</span>
                                <span class="old">$48.50</span>
                            </span>
                        </div>
                    </div>
                    <!-- Single Prodect -->
                </div>
                <div class="new-product-item swiper-slide">
                    <!-- Single Prodect -->
                    <div class="product">
                        <div class="thumb">
                            <a href="single-product.html" class="image">
                                <img src="assets/images/product-image/10.jpg" alt="Product" />
                            </a>
                            <span class="badges">
                                <span class="sale">-7%</span>
                            </span>
                            <div class="actions">
                                <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                        class="pe-7s-like"></i></a>
                                <a href="#" class="action quickview" data-link-action="quickview"
                                    title="Quick view" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                <a href="compare.html" class="action compare" title="Compare"><i
                                        class="pe-7s-refresh-2"></i></a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <span class="ratings">
                                <span class="rating-wrap">
                                    <span class="star" style="width: 90%"></span>
                                </span>
                                <span class="rating-num">( 4.5 Review )</span>
                            </span>
                            <h5 class="title"><a href="single-product.html">Women's Long
                                    Sleeve
                                    Shirts</a></h5>
                            <span class="price">
                                <span class="new">$30.50</span>
                                <span class="old">$38.00</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="new-product-item swiper-slide">
                    <!-- Single Prodect -->
                    <div class="product">
                        <div class="thumb">
                            <a href="single-product.html" class="image">
                                <img src="assets/images/product-image/11.jpg" alt="Product" />
                            </a>
                            <span class="badges">
                                <span class="new">Sale</span>
                            </span>
                            <div class="actions">
                                <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                        class="pe-7s-like"></i></a>
                                <a href="#" class="action quickview" data-link-action="quickview"
                                    title="Quick view" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                <a href="compare.html" class="action compare" title="Compare"><i
                                        class="pe-7s-refresh-2"></i></a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <span class="ratings">
                                <span class="rating-wrap">
                                    <span class="star" style="width: 70%"></span>
                                </span>
                                <span class="rating-num">( 3.5 Review )</span>
                            </span>
                            <h5 class="title"><a href="single-product.html">Parrera
                                    Sunglasses -
                                    Lomashop</a></h5>
                            <span class="price">
                                <span class="new">$38.50</span>
                            </span>
                        </div>
                    </div>
                    <!-- Single Prodect -->
                </div>
                <div class="new-product-item swiper-slide">
                    <!-- Single Prodect -->
                    <div class="product">
                        <div class="thumb">
                            <a href="single-product.html" class="image">
                                <img src="assets/images/product-image/3.jpg" alt="Product" />
                            </a>
                            <span class="badges">
                                <span class="sale">-10%</span>
                                <span class="new">New</span>
                            </span>
                            <div class="actions">
                                <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                        class="pe-7s-like"></i></a>
                                <a href="#" class="action quickview" data-link-action="quickview"
                                    title="Quick view" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                <a href="compare.html" class="action compare" title="Compare"><i
                                        class="pe-7s-refresh-2"></i></a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <span class="ratings">
                                <span class="rating-wrap">
                                    <span class="star" style="width: 80%"></span>
                                </span>
                                <span class="rating-num">( 4 Review )</span>
                            </span>
                            <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                    Tights</a>
                            </h5>
                            <span class="price">
                                <span class="new">$38.50</span>
                                <span class="old">$48.50</span>
                            </span>
                        </div>
                    </div>
                    <!-- Single Prodect -->
                </div>
                <div class="new-product-item swiper-slide">
                    <!-- Single Prodect -->
                    <div class="product">
                        <div class="thumb">
                            <a href="single-product.html" class="image">
                                <img src="assets/images/product-image/1.jpg" alt="Product" />
                            </a>
                            <span class="badges">
                                <span class="new">New</span>
                            </span>
                            <div class="actions">
                                <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                        class="pe-7s-like"></i></a>
                                <a href="#" class="action quickview" data-link-action="quickview"
                                    title="Quick view" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                <a href="compare.html" class="action compare" title="Compare"><i
                                        class="pe-7s-refresh-2"></i></a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <span class="ratings">
                                <span class="rating-wrap">
                                    <span class="star" style="width: 100%"></span>
                                </span>
                                <span class="rating-num">( 5 Review )</span>
                            </span>
                            <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                    Coat
                                </a>
                            </h5>
                            <span class="price">
                                <span class="new">$38.50</span>
                            </span>
                        </div>
                    </div>
                    <!-- Single Prodect -->
                </div>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</div>
<!-- Related product Area End -->
@endsection
@section('footer_script')

<script>

$('.color_id').click(function(){
    var color_id= $(this).attr("name");
    var product_id="{{ $product_details->id }}";


    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getSize',
            data:{color_id:color_id,product_id:product_id},
            success:function(data){

                 $('#color_details').html(data);
                 $('.size_id').click(function(){
                     var size_id=$(this).attr('name')
                     $('#size_id').attr('value',size_id)

                     $.ajax({
                            type:'POST',
                            url:'/getQuantityAvailable',
                            data:{color_id:color_id,product_id:product_id,size_id:size_id},
                            success:function(data){

                                var quentity=parseInt(data);
                                var show=quentity -1;

                                    if(data == "1"){
                                        $('#qu_av').html('Item Available size: not in stoke');
                                    }
                                    else{
                                        $('#qu_av').html('Item Available size: '+show + ' items');
                                    }



                            }
                        })
                 })

            }
        })

})

$('.color_id').click(function(){
    var color_id=$(this).attr('name');
    $('#color_id').attr('value',color_id)

})
</script>
@if (session('cartAdd'))
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
  title: '{{ session('cartAdd') }}'
})

</script>
@endif
@endsection
