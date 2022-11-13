@php
if(session('language') == 'english'){
    $tags=App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
    $tagsFix = [];
    foreach ($tags as $tag) {
        $tag = explode(',', $tag->product_tags_en);
        $arrayCount = count($tag);
        for ($i = 0; $i < $arrayCount; $i++) {
            $tagsFix = array_merge($tagsFix, [$tag[$i]]);
        }
    }
}
  
else{
    $tags=App\Models\Product::groupBy('product_tags_fr')->select('product_tags_fr')->get();
    $tagsFix = [];
    foreach ($tags as $tag) {
        $tag = explode(',', $tag->product_tags_fr);
        $arrayCount = count($tag);
        for ($i = 0; $i < $arrayCount; $i++) {
            $tagsFix = array_merge($tagsFix, [$tag[$i]]);
        }
    }
}

$tagsFix = array_unique($tagsFix);
@endphp


<div class="sidebar-widget product-tag wow fadeInUp">
<h3 class="section-title">Product tags</h3>
<div class="sidebar-widget-body outer-top-xs"> 
<div class="tag-list"> 

    @foreach($tagsFix as $tag)
    <a class="item active" href="{{ route('product.tag',$tag) }}">
        {{ $tag }}
    </a> 
    @endforeach

</div>
</div>
</div>