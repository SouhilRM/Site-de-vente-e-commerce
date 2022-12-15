@php
  $route = Route::current()->getName();
  $prefix = Request::route()->getPrefix();
@endphp
<aside class="main-sidebar">
<section class="sidebar">	
		
  <div class="user-profile">
  <div class="ulogo">
    <a href="{{ route('admin_dashboard') }}">
      <!-- logo for regular state and mobile devices -->
      <div class="d-flex align-items-center justify-content-center">					 	
        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
        <h3><b>Easy-Web</b> Shop</h3>
      </div>
    </a>
  </div>
  </div>
      
<ul class="sidebar-menu" data-widget="tree">  
  
    <li class="{{ ($route == 'admin_dashboard')? 'active' : '' }}">
      <a href="{{ route('admin_dashboard') }}">
        <i data-feather="pie-chart"></i>
        <span>Dashboard</span>
      </a>
    </li>

    @php
      $brand = (auth()->guard('admin')->user()->brand == 1);
      $category = (auth()->guard('admin')->user()->category == 1);
      $product = (auth()->guard('admin')->user()->product == 1);
      $slider = (auth()->guard('admin')->user()->slider == 1);
      $coupons = (auth()->guard('admin')->user()->coupons == 1);
      $shipping = (auth()->guard('admin')->user()->shipping == 1);
      //$blog = (auth()->guard('admin')->user()->blog == 1);
      $setting = (auth()->guard('admin')->user()->setting == 1);
      $returnorder = (auth()->guard('admin')->user()->returnorder == 1);
      $review = (auth()->guard('admin')->user()->review == 1);
      $orders = (auth()->guard('admin')->user()->orders == 1);
      $stock = (auth()->guard('admin')->user()->stock == 1);
      $reports = (auth()->guard('admin')->user()->reports == 1);
      $alluser = (auth()->guard('admin')->user()->alluser == 1);
      $adminuserrole = (auth()->guard('admin')->user()->adminuserrole == 1);
    @endphp
  
    @if($brand == true)
    <li class="treeview {{ ($prefix == '/brand')? 'active' : '' }}">
      <a href="#">
        <i data-feather="message-circle"></i>
        <span>Brands</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>

      <ul class="treeview-menu">
        <li class="{{ ($route == 'all.brand')? 'active' : '' }}">
          <a href="{{ route('all.brand') }}"><i class="ti-more"></i>All Brands</a>
        </li>
      </ul>
    </li>
    @else
    @endif

    @if($category == true)
    <li class="treeview {{ ($prefix == '/categorie')? 'active' : '' }}">
      <a href="#">
        <i data-feather="message-circle"></i>
        <span>Categories</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>

      <ul class="treeview-menu">
        <li class="{{ ($route == 'all.categorie')? 'active' : '' }}">
          <a href="{{ route('all.categorie') }}"><i class="ti-more"></i>All category</a>
        </li>
        <li class="{{ ($route == 'all.sub.categorie')? 'active' : '' }}">
          <a href="{{ route('all.sub.categorie') }}"><i class="ti-more"></i>All sub-category</a>
        </li>
        <li class="{{ ($route == 'all.sub.sub.categorie')? 'active' : '' }}">
          <a href="{{ route('all.sub.sub.categorie') }}"><i class="ti-more"></i>All sub-sub-category</a>
        </li>
      </ul>
    </li>
    @else
    @endif

    @if($product == true)
    <li class="treeview {{ ($prefix == '/product')? 'active' : '' }}">
      <a href="#">
        <i data-feather="message-circle"></i>
        <span>Products</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>

      <ul class="treeview-menu">
        <li class="{{ ($route == 'all.product')? 'active' : '' }}">
          <a href="{{ route('all.product') }}"><i class="ti-more"></i>All products</a>
        </li>
        <li class="{{ ($route == 'add.product')? 'active' : '' }}">
          <a href="{{ route('add.product') }}"><i class="ti-more"></i>Add products</a>
        </li>
        
      </ul>
    </li>
    @else
    @endif

    @if($slider == true)
    <li class="treeview {{ ($prefix == '/slider')? 'active' : '' }}">
      <a href="#">
        <i data-feather="message-circle"></i>
        <span>Sliders</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>

      <ul class="treeview-menu">
        <li class="{{ ($route == 'all.slider')? 'active' : '' }}">
          <a href="{{ route('all.slider') }}"><i class="ti-more"></i>All Slider</a>
        </li>
        
      </ul>
    </li>
    @else
    @endif

    @if($coupons == true)
    <li class="treeview {{ ($prefix == '/coupon')? 'active' : '' }}">
      <a href="#">
        <i data-feather="message-circle"></i>
        <span>Coupons</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>

      <ul class="treeview-menu">
        <li class="{{ ($route == 'manage-coupon')? 'active' : '' }}">
          <a href="{{ route('manage-coupon') }}"><i class="ti-more"></i>Manage Coupon</a>
        </li>
        
      </ul>
    </li>
    @else
    @endif

    @if($shipping == true)
    <li class="treeview {{ ($prefix == '/shipping')? 'active' : '' }}">
      <a href="#">
        <i data-feather="message-circle"></i>
        <span>Shipping Area</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>

      <ul class="treeview-menu">
        <li class="{{ ($route == 'manage-division')? 'active' : '' }}">
          <a href="{{ route('manage-division') }}"><i class="ti-more"></i>Ship Division</a>
        </li>
        <li class="{{ ($route == 'manage-district')? 'active':'' }}">
          <a href="{{ route('manage-district') }}"><i class="ti-more"></i>Ship District</a>
        </li>
        <li class="{{ ($route == 'manage-state')? 'active':'' }}">
          <a href="{{ route('manage-state') }}"><i class="ti-more"></i>Ship State</a>
        </li>
      </ul>
    </li>
    @else
    @endif

    @if($orders == true)
    <li class="treeview {{ ($prefix == '/orders')? 'active' : '' }}">
      <a href="#">
        <i data-feather="message-circle"></i>
        <span>orders Area</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>

      <ul class="treeview-menu">
        <li class="{{ ($route == 'pending-orders')? 'active':'' }}">
          <a href="{{ route('pending-orders') }}"><i class="ti-more"></i>Pending Orders</a>
        </li>

        <li class="{{ ($route == 'confirmed-orders')? 'active':'' }}">
          <a href="{{ route('confirmed-orders') }}"><i class="ti-more"></i>Confirmed Orders</a>
        </li>

        <li class="{{ ($route == 'processing-orders')? 'active':'' }}">
          <a href="{{ route('processing-orders') }}"><i class="ti-more"></i>Processing Orders</a>
        </li>

        <li class="{{ ($route == 'picked-orders')? 'active':'' }}">
          <a href="{{ route('picked-orders') }}"><i class="ti-more"></i> Picked Orders</a>
        </li>

        <li class="{{ ($route == 'shipped-orders')? 'active':'' }}">
          <a href="{{ route('shipped-orders') }}"><i class="ti-more"></i> Shipped Orders</a>
        </li>

        <li class="{{ ($route == 'delivered-orders')? 'active':'' }}">
          <a href="{{ route('delivered-orders') }}"><i class="ti-more"></i> Delivered Orders</a>
        </li>

        <li class="{{ ($route == 'cancel-orders')? 'active':'' }}">
          <a href="{{ route('cancel-orders') }}"><i class="ti-more"></i> Cancel Orders</a>
        </li>
      </ul>
    </li>
    @else
    @endif
  
    <li class="header nav-small-cap">User Interface</li>

    @if($reports == true)
    <li class="treeview {{ ($prefix == '/reports')? 'active' : '' }}">
      <a href="#">
        <i data-feather="message-circle"></i>
        <span>All Reports </span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>

      <ul class="treeview-menu">
        <li class="{{ ($route == 'all-reports')? 'active':'' }}">
          <a href="{{ route('all-reports') }}"><i class="ti-more"></i>All Reports</a>
        </li>
      </ul>
    </li>
    @else
    @endif

    @if($alluser == true)
    <li class="treeview {{ ($prefix == '/alluser')?'active':'' }}  ">
      <a href="#">
        <i data-feather="file"></i>
        <span>All Users </span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{ ($route == 'all-users')? 'active':'' }}">
          <a href="{{ route('all-users') }}"><i class="ti-more"></i>All Users</a>
        </li>
      </ul>
    </li>
    @else
    @endif

    @if($setting == true)
    <li class="treeview {{ ($prefix == '/setting')?'active':'' }}  ">
      <a href="#">
        <i data-feather="file"></i>
        <span>Manage Setting</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{ ($route == 'site.setting')? 'active':'' }}">
          <a href="{{ route('site.setting') }}"><i class="ti-more"></i>Site Setting</a>
        </li>
        <li class="{{ ($route == 'seo.setting')? 'active':'' }}">
          <a href="{{ route('seo.setting') }}"><i class="ti-more"></i>Seo Setting</a>
        </li>
      </ul>
    </li>
    @else
    @endif

    @if($returnorder == true)
    <li class="treeview {{ ($prefix == '/return')?'active':'' }}  ">
      <a href="#">
        <i data-feather="file"></i>
        <span>Return Order</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{ ($route == 'return.request')? 'active':'' }}">
          <a href="{{ route('return.request') }}"><i class="ti-more"></i>Return Request</a>
        </li>
        <li class="{{ ($route == 'all.request')? 'active':'' }}">
          <a href="{{ route('all.request') }}"><i class="ti-more"></i>All Request</a>
        </li>
      </ul>
    </li>
    @else
    @endif

    @if($review == true)
    <li class="treeview {{ ($prefix == '/review')?'active':'' }}  ">
      <a href="#">
        <i data-feather="file"></i>
        <span>Manage Review</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{ ($route == 'pending.review')? 'active':'' }}">
          <a href="{{ route('pending.review') }}"><i class="ti-more"></i>Pending Review</a>
        </li>

        <li class="{{ ($route == 'publish.review')? 'active':'' }}">
          <a href="{{ route('publish.review') }}"><i class="ti-more"></i>Publish Review</a>
        </li>
      </ul>
    </li>
    @else
    @endif

    @if($stock == true)
    <li class="treeview {{ ($prefix == '/stock')?'active':'' }}  ">
      <a href="#">
        <i data-feather="file"></i>
        <span>Manage Stock </span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{ ($route == 'product.stock')? 'active':'' }}">
          <a href="{{ route('product.stock') }}"><i class="ti-more"></i>Product Stock</a>
        </li>
      </ul>
    </li>
    @else
    @endif

    @if($adminuserrole == true)
    <li class="treeview {{ ($prefix == '/adminuserrole')?'active':'' }}  ">
      <a href="#">
        <i data-feather="file"></i>
        <span>Admin User Role </span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
      <li class="{{ ($route == 'all.admin.user')? 'active':'' }}">
        <a href="{{ route('all.admin.user') }}"><i class="ti-more"></i>All Admin User </a>
      </li>
      </ul>
    </li>
    @else
    @endif

</ul>

</section>
</aside>