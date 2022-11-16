<!-- ======================= SIDEBAR CATEGORY ======================== -->
    <div class="sidebar-widget wow fadeInUp">
    <h3 class="section-title">shop by</h3>
    <div class="widget-header">
        <h4 class="widget-title">Category</h4>
    </div>
    <div class="sidebar-widget-body">
    <div class="accordion">
        @foreach ($categories as $category)
        <div class="accordion-group">
            <div class="accordion-heading"> 
                <a href="#{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed"> 
                    @if(session('language') == 'english'){{$category->categorie_name_en}}
                    @else {{$category->categorie_name_fr}} 
                    @endif 
                </a> 
            </div>
            <!-- /.accordion-heading -->
            <div class="accordion-body collapse" id="{{ $category->id }}" style="height: 0px;">
            <div class="accordion-inner">
                <ul>
                    @foreach($category->subcategories as $subcat)
                <li>
                    <a href="{{ route('product.subcat',[$subcat->id,$subcat->categorie_slug_en]) }}">
                    @if(session('language') == 'english'){{$subcat->categorie_name_en}}
                    @else {{$subcat->categorie_name_fr}} 
                    @endif
                </a>
                </li>
                @endforeach
                </ul>
            </div>
            <!-- /.accordion-inner --> 
            </div>
            <!-- /.accordion-body --> 
        </div>
        <!-- /.accordion-group -->
        @endforeach
    </div>
    <!-- /.accordion --> 
    </div>
    <!-- /.sidebar-widget-body --> 
    </div>
    <!-- /.sidebar-widget --> 
<!-- ======================= SIDEBAR CATEGORY : END ================== --> 

<!-- ======================= PRICE SILDER============================= -->
    <div class="sidebar-widget wow fadeInUp">
    <div class="widget-header">
        <h4 class="widget-title">Price Slider</h4>
    </div>
    <div class="sidebar-widget-body m-t-10">
        <div class="price-range-holder"> <span class="min-max"> <span class="pull-left">$200.00</span> <span class="pull-right">$800.00</span> </span>
        <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">
        <input type="text" class="price-slider" value="" >
        </div>
        <!-- /.price-range-holder --> 
        <a href="#" class="lnk btn btn-primary">Show Now</a> </div>
    <!-- /.sidebar-widget-body --> 
    </div>
    <!-- /.sidebar-widget --> 
<!-- ======================= PRICE SILDER : END ====================== -->

<!-- ======================= MANUFACTURES============================= -->
    <div class="sidebar-widget wow fadeInUp">
    <div class="widget-header">
        <h4 class="widget-title">Manufactures</h4>
    </div>
    <div class="sidebar-widget-body">
        <ul class="list">
        <li><a href="#">Forever 18</a></li>
        <li><a href="#">Nike</a></li>
        <li><a href="#">Dolce & Gabbana</a></li>
        <li><a href="#">Alluare</a></li>
        <li><a href="#">Chanel</a></li>
        <li><a href="#">Other Brand</a></li>
        </ul>
        <!--<a href="#" class="lnk btn btn-primary">Show Now</a>--> 
    </div>
    <!-- /.sidebar-widget-body --> 
    </div>
    <!-- /.sidebar-widget --> 
<!-- ======================= MANUFACTURES: END ======================= -->

<!-- ======================= COLOR==================================== -->
    <div class="sidebar-widget wow fadeInUp">
    <div class="widget-header">
        <h4 class="widget-title">Colors</h4>
    </div>
    <div class="sidebar-widget-body">
        <ul class="list">
        <li><a href="#">Red</a></li>
        <li><a href="#">Blue</a></li>
        <li><a href="#">Yellow</a></li>
        <li><a href="#">Pink</a></li>
        <li><a href="#">Brown</a></li>
        <li><a href="#">Teal</a></li>
        </ul>
    </div>
    <!-- /.sidebar-widget-body --> 
    </div>
    <!-- /.sidebar-widget --> 
<!-- ======================= COLOR: END ============================== -->