<header class="header-style-1"> 
  
    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
      <div class="container">
        <div class="header-top-inner">
          <div class="cnt-account">
            <ul class="list-unstyled">
              <li><a href=""><i class="icon fa fa-user"></i>My Account</a></li>
              <li><a href="{{ route('wishlist') }}"><i class="icon fa fa-heart"></i>Wishlist</a></li>
              <li><a href="{{ route('mycart') }}"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
              <li><a href="{{ route('checkout') }}"><i class="icon fa fa-check"></i>Checkout</a></li>

              @auth
              <li>
                <a href="" type="button" data-toggle="modal" data-target="#ordertraking"><i class="icon fa fa-check"></i>Order Traking</a>
              </li>
              @else
              @endauth
              <li>

                @auth
                <a href="{{ route('login') }}"><i class="icon fa fa-user"></i>Profile</a>
                @else
                <a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>Login/Register</a>
                @endauth

              </li>
            </ul>
          </div>
          <!-- /.cnt-account -->
          
          <div class="cnt-block">
            <ul class="list-unstyled list-inline">
              @auth
              
              @else
              @endauth
              <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">Language </span><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  @if(session()->get('language') == 'english')
                  <li><a href="{{ route('french.languange') }}">French</a></li>
                  @else
                  <li><a href="{{ route('english.languange') }}">English</a></li>
                  @endif
                </ul>
              </li>
            </ul>
            <!-- /.list-unstyled --> 
          </div>
          <!-- /.cnt-cart -->
          <div class="clearfix"></div>
        </div>
        <!-- /.header-top-inner --> 
      </div>
      <!-- /.container --> 
    </div>
    <!-- /.header-top --> 
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 
            <!-- ============================================================= LOGO ============================================================= -->
          @php
            $setting = App\Models\SiteSetting::find(1);
          @endphp
            <div class="logo"> <a href="{{ route('home') }}"> <img src="{{ asset($setting->logo) }}" alt="logo"> </a> </div>
            <!-- /.logo --> 
            <!-- ============================================================= LOGO : END ============================================================= --> </div>
          <!-- /.logo-holder -->
          
          <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder"> 
            <!-- /.contact-row --> 
            <!-- ============================================================= SEARCH AREA ============================================================= -->
            <div class="search-area">
              <form method="post" action="{{ route('product.search') }}">
                @csrf
                <div class="control-group">
                  <ul class="categories-filter animate-dropdown">
                    <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">Categories <b class="caret"></b></a>
                      <ul class="dropdown-menu" role="menu" >
                        <li class="menu-header">Computer</li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Clothing</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Electronics</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Shoes</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Watches</a></li>
                      </ul>
                    </li>
                  </ul>
                  <input class="search-field" name="search" id="search" onfocus="search_result_show()" onblur="search_result_hide()"  placeholder="Search here..." />
                  <button type="submit" class="search-button"></button>
                </div>
              </form>
              <div id="searchProducts"></div>
            </div>
            <!-- /.search-area --> 
            <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
          <!-- /.top-search-holder -->
          
        <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
            
            
          <!-- =================== SHOPPING CART DROPDOWN ======================= -->
            
            <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
              <div class="items-cart-inner">
                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                
                <div class="basket-item-count">
                  <span class="count" id="cartQty"> </span>
                </div>
                <div class="total-price-basket"> 
                  <span class="lbl">cart -</span> 
                  <span class="total-price"> 
                    <span class="sign">$</span>
                    <span class="value" id="cartSubTotal"></span> 
                  </span> 
                </div>

              </div>
              </a>
              <ul class="dropdown-menu">
                <li>


                  <div id="miniCart"></div>
                  
                  
                  <div class="clearfix cart-total">

                    <div class="pull-right"> 
                      <span class="text">Sub Total :</span>
                      <span class="sign">$</span>
                      <span class="price" id="cartSubTotal"> </span> 
                    </div>

                    <div class="clearfix"></div>
                    <a href="{{ route('checkout') }}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
                  <!-- /.cart-total--> 
                  
                </li>
              </ul>
              <!-- /.dropdown-menu--> 
            </div>
            <!-- /.dropdown-cart --> 
            
          <!-- =================== SHOPPING CART DROPDOWN : END================== -->
          
          
        </div>
          <!-- /.top-cart-row --> 
        </div>
        <!-- /.row --> 
        
      </div>
      <!-- /.container --> 
      
    </div>
    <!-- /.main-header --> 
    
    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
      <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
          <div class="navbar-header">
         <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
         <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          </div>
          <div class="nav-bg-class">
            <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
              <div class="nav-outer">
                <ul class="nav navbar-nav">


                  <li class="active dropdown yamm-fw"> 
                    <a href="{{ route('home') }}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Home</a> 
                  </li>



                  @php
                  $categories = App\Models\Categorie::orderBy('categorie_name_en','ASC')->get();
                  @endphp

                  @foreach ($categories as $category)
                  <li class="dropdown yamm mega-menu"> 

                    <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                      @if(session('language') == 'english'){{$category->categorie_name_en}}
                      @else {{$category->categorie_name_fr}} 
                      @endif
                    </a>

                    <ul class="dropdown-menu container">
                      <li>
                        <div class="yamm-content ">
                          <div class="row">
                            @foreach($category->subcategories as $subcat)
                            <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                              <h2 class="title">
                                <a href="{{ route('product.subcat',[$subcat->id,$subcat->categorie_slug_en]) }}">
                                @if(session('language') == 'english'){{$subcat->categorie_name_en}}
                                @else {{$subcat->categorie_name_fr}} 
                                @endif
                                </a>
                              </h2>
                              <ul class="links">
                                

                                @foreach($subcat->subsubcategories as $subsubcat)
                                <li>
                                <a href="{{ route('product.subsubcat',[$subsubcat->id,$subsubcat->categorie_slug_en]) }}">
                                  @if(session('language') == 'english'){{$subsubcat->categorie_name_en}}
                                  @else {{$subsubcat->categorie_name_fr}} 
                                  @endif
                                </a>
                                </li>
                                @endforeach

                              </ul>
                            </div>
                            @endforeach
                            <!-- /.col -->
                            
                            <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="{{ asset('frontend/assets/images/banners/top-menu-banner.jpg') }}" alt=""> </div>
                            <!-- /.yamm-content --> 
                          </div>
                        </div>
                      </li>
                    </ul>

                  </li>
                  @endforeach

                  <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li>
                </ul>
                <!-- /.navbar-nav -->
                <div class="clearfix"></div>
              </div>
              <!-- /.nav-outer --> 
            </div>
            <!-- /.navbar-collapse --> 
            
          </div>
          <!-- /.nav-bg-class --> 
        </div>
        <!-- /.navbar-default --> 
      </div>
      <!-- /.container-class --> 
      
    </div>
    <!-- /.header-nav --> 
    <!-- ============================================== NAVBAR : END ============================================== --> 
    

    <!-- Order Traking Modal -->
<div class="modal fade" id="ordertraking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Track Your Order </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" action="{{ route('order.tracking') }}">
          @csrf
         <div class="modal-body">
          <label>Invoice Code</label>
          <input type="text" name="code" required="" class="form-control" placeholder="Your Order Invoice Number">           
         </div>

         <button class="btn btn-danger" type="submit" style="margin-left: 17px;"> Track Now </button>

        </form> 


      </div>

    </div>
  </div>
</div>
</header>

<style>
  .search-area{
    position: relative;
  }
  #searchProducts {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background: #ffffff;
    z-index: 999;
    border-radius: 8px;
    margin-top: 5px;
  }
</style>

<script>
  function search_result_hide(){
    $("#searchProducts").slideUp();
  }
   function search_result_show(){
      $("#searchProducts").slideDown();
  }
</script>