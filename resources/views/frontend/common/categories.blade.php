<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
    <ul class="nav">
        @foreach ($categories as $category)
        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="{{ $category->categorie_icone }}" aria-hidden="true"></i>
            @if(session('language') == 'english'){{$category->categorie_name_en}}
            @else {{$category->categorie_name_fr}} 
            @endif
        </a>
        <ul class="dropdown-menu mega-menu">
            <li class="yamm-content">
            <div class="row">
                @foreach($category->subcategories as $subcat)
                <div class="col-sm-12 col-md-3">
                <h2 class="title">
                    <a href="{{ route('product.subcat',[$subcat->id,$subcat->categorie_slug_en]) }}">
                    @if(session('language') == 'english'){{$subcat->categorie_name_en}}
                    @else {{$subcat->categorie_name_fr}} 
                    @endif
                    </a>
                </h2>
                <ul class="links list-unstyled">
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
            </div>
            </li>
        </ul>
        </li>
        @endforeach
    </nav>
</div>