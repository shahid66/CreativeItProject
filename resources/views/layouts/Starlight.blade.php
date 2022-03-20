<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Spider- @yield('title')</title>

    <!-- vendor css -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('dashbord/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ asset('dashbord/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{ asset('dashbord/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">


    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('dashbord/css/starlight.css') }}">
    <link rel="stylesheet" href="{{ asset('dashbord/css/Custom.css') }}">
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> starlight</a></div>
    <div class="sl-sideleft">
      <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
      </div><!-- input-group -->

      <label class="sidebar-label">Navigation</label>
      <div class="sl-sideleft-menu">
        <a href="{{ url('/home2') }}" class="sl-menu-link @yield('dashboard')">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        <a href="#" class="sl-menu-link @yield('category')">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Category</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{ url('/category') }}" class="nav-link">All Category</a></li>

        </ul>
        <a href="#" class="sl-menu-link @yield('subcategory')">
            <div class="sl-menu-item">
              <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
              <span class="menu-item-label">Sub Category</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ url('/subcategory') }}" class="nav-link">All SubCategory</a></li>

          </ul>

          <a href="#" class="sl-menu-link @yield('product')">
            <div class="sl-menu-item">
              <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
              <span class="menu-item-label">Products</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ url('/product') }}" class="nav-link">All Product</a></li>

          </ul>

          <a href="#" class="sl-menu-link @yield('colorSize')">
            <div class="sl-menu-item">
              <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
              <span class="menu-item-label">Color & Size</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ url('/color/size') }}" class="nav-link">Color & Size</a></li>

          </ul>

          <a href="#" class="sl-menu-link @yield('coupon')">
            <div class="sl-menu-item">
              <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
              <span class="menu-item-label">Coupon</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('coupon') }}" class="nav-link">Coupon</a></li>

          </ul>

          <a href="#" class="sl-menu-link @yield('coupon')">
            <div class="sl-menu-item">
              <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
              <span class="menu-item-label">Order</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('order.admin.view') }}" class="nav-link">All Order</a></li>

          </ul>

      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name">{{ Auth::user()->name }}<span class="hidden-md-down"></span></span>
              <img src="{{ asset('uploads/users/') }}/{{ Auth::user()->photo }}" class="wd-32 rounded-circle" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href="{{ url('/profile') }}"><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>

                <li>
                    <a href="{{ route('logout.admin') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     <i class="icon ion-power"></i> Sign Out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
        <div class="navicon-right">
          <a id="btnRightMenu" href="" class="pos-relative">
            <i class="icon ion-ios-bell-outline"></i>
            <!-- start: if statement -->
            <span class="square-8 bg-danger"></span>
            <!-- end: if statement -->
          </a>
        </div><!-- navicon-right -->
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    <div class="sl-sideright">
      <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Messages (2)</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notifications (8)</a>
        </li>
      </ul><!-- sidebar-tabs -->

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane pos-absolute a-0 mg-t-60 active" id="messages" role="tabpanel">
          <div class="media-list">
            <!-- loop starts here -->
            <a href="" class="media-list-link">
              <div class="media">
                <img src="../img/img3.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Donna Seay</p>
                  <span class="d-block tx-11 tx-gray-500">2 minutes ago</span>
                  <p class="tx-13 mg-t-10 mg-b-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
                </div>
              </div><!-- media -->
            </a>
            <!-- loop ends here -->
            <a href="" class="media-list-link">
              <div class="media">
                <img src="../img/img4.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Samantha Francis</p>
                  <span class="d-block tx-11 tx-gray-500">3 hours ago</span>
                  <p class="tx-13 mg-t-10 mg-b-0">My entire soul, like these sweet mornings of spring.</p>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link">
              <div class="media">
                <img src="../img/img7.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Robert Walker</p>
                  <span class="d-block tx-11 tx-gray-500">5 hours ago</span>
                  <p class="tx-13 mg-t-10 mg-b-0">I should be incapable of drawing a single stroke at the present moment...</p>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link">
              <div class="media">
                <img src="../img/img5.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Larry Smith</p>
                  <span class="d-block tx-11 tx-gray-500">Yesterday, 8:34pm</span>

                  <p class="tx-13 mg-t-10 mg-b-0">When, while the lovely valley teems with vapour around me, and the meridian sun strikes...</p>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link">
              <div class="media">
                <img src="../img/img3.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Donna Seay</p>
                  <span class="d-block tx-11 tx-gray-500">Jan 23, 2:32am</span>
                  <p class="tx-13 mg-t-10 mg-b-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
                </div>
              </div><!-- media -->
            </a>
          </div><!-- media-list -->
          <div class="pd-15">
            <a href="" class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">View More Messages</a>
          </div>
        </div><!-- #messages -->

        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="notifications" role="tabpanel">
          <div class="media-list">
            <!-- loop starts here -->
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img8.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 18 others in a post.</p>
                  <span class="tx-12">October 03, 2017 8:45am</span>
                </div>
              </div><!-- media -->
            </a>
            <!-- loop ends here -->
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img9.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Mellisa Brown</strong> appreciated your work <strong class="tx-medium tx-gray-800">The Social Network</strong></p>
                  <span class="tx-12">October 02, 2017 12:44am</span>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img10.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700">20+ new items added are for sale in your <strong class="tx-medium tx-gray-800">Sale Group</strong></p>
                  <span class="tx-12">October 01, 2017 10:20pm</span>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img5.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium tx-gray-800">Ronnie Mara</strong></p>
                  <span class="tx-12">October 01, 2017 6:08pm</span>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img8.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 12 others in a post.</p>
                  <span class="tx-12">September 27, 2017 6:45am</span>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img10.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700">10+ new items added are for sale in your <strong class="tx-medium tx-gray-800">Sale Group</strong></p>
                  <span class="tx-12">September 28, 2017 11:30pm</span>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img9.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Mellisa Brown</strong> appreciated your work <strong class="tx-medium tx-gray-800">The Great Pyramid</strong></p>
                  <span class="tx-12">September 26, 2017 11:01am</span>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img5.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium tx-gray-800">Ronnie Mara</strong></p>
                  <span class="tx-12">September 23, 2017 9:19pm</span>
                </div>
              </div><!-- media -->
            </a>
          </div><!-- media-list -->
        </div><!-- #notifications -->

      </div><!-- tab-content -->
    </div><!-- sl-sideright -->
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->


            @yield('content')

    <!-- ########## END: MAIN PANEL ########## -->

    <script src="{{ asset('dashbord/lib/jquery/jquery.js')}}"></script>
    <script src="{{ asset('dashbord/lib/popper.js/popper.js')}}"></script>
    <script src="{{ asset('dashbord/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{ asset('dashbord/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('dashbord/js/starlight.js')}}"></script>
@yield('footer_script')
  </body>
</html>
