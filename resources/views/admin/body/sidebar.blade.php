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
  
    <li class="header nav-small-cap">User Interface</li>
    
    <li class="treeview">
      <a href="#">
        <i data-feather="credit-card"></i>
        <span>Cards</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="card_advanced.html"><i class="ti-more"></i>Advanced Cards</a></li>
        <li><a href="card_basic.html"><i class="ti-more"></i>Basic Cards</a></li>
        <li><a href="card_color.html"><i class="ti-more"></i>Cards Color</a></li>
      </ul>
    </li>

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

  </ul>

</section>
</aside>