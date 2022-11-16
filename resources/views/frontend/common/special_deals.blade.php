<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title">Special Deals</h3>
    <div class="sidebar-widget-body outer-top-xs">
    <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
        @php $k=0; @endphp
        @while($k<count($special_deals))
        <div class="item">
            <div class="products special-product"> 
            @for($i = 0 ; $i<3 ; $i++,$k++)
            @if($k<count($special_deals))
            <div class="product">
            <div class="product-micro">
                <div class="row product-micro-row">
                <div class="col col-xs-5">
                    <div class="product-image">
                    <div class="image"> <a href="{{ route('product.details',[$special_deals[$k]->id,$special_deals[$k]->product_slug_en]) }}"> <img src="{{ asset($special_deals[$k]->product_thambnail) }}" alt=""> </a> </div>
                    </div>
                </div>
                <div class="col col-xs-7">
                    <div class="product-info">
                    <h3 class="name">
                        <a href="{{ route('product.details',[$special_deals[$k]->id,$special_deals[$k]->product_slug_en]) }}">
                            @if(session('language') == 'english'){{$special_deals[$k]->product_name_en}}
                            @else {{$special_deals[$k]->product_name_fr}} 
                            @endif
                        </a>
                    </h3>
                    <div class="rating rateit-small"></div>
                    <div class="product-price">
                        @if($special_deals[$k]->discount_price)
                            <span class="price"> ${{$special_deals[$k]->discount_price}} </span> 
                            <span class="price-before-discount">$ {{$special_deals[$k]->selling_price}}</span>
                        @else
                            <span class="price"> ${{$special_deals[$k]->selling_price}} </span>
                        @endif
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            @endif
            @endfor
        </div>
        </div> 
        @endwhile
    </div>
    </div>
</div>