<script type="text/javascript" defer>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
    // Start Product View with Modal 
    function productView(id){
        // alert(id)
        $.ajax({
            type: 'GET',
            url: '/product/view/modal/'+id,
            dataType:'json',
            success:function(data){
                // console.log(data)
                $('#pname').text(data.product.product_name_en);
                //$('#price').text(data.product.selling_price);
                $('#pcode').text(data.product.product_code);
                $('#pcategory').text(data.product.category.categorie_name_en);
                $('#pbrand').text(data.product.brand.brand_name_en);
                $('#pimage').attr('src','/'+data.product.product_thambnail);

                $('#product_id').val(id);
                $('#qty').val(1);
                    
                // Product Price 
                if (data.product.discount_price == null) {
                    $('#pprice').text('');
                    $('#oldprice').text('');

                    $('#pprice').text('$'+data.product.selling_price);
                }else{
                    $('#pprice').text('');
                    $('#oldprice').text('');

                    $('#pprice').text('$'+data.product.discount_price);
                    $('#oldprice').text('$'+data.product.selling_price);
                } // end prodcut price 

                // Start Stock opiton
                if (data.product.product_qty > 0) {
                    $('#aviable').text('');
                    $('#stockout').text('');

                    $('#aviable').text('aviable');
                }else{
                    $('#aviable').text('');
                    $('#stockout').text('');
                    
                    $('#stockout').text('stockout');
                } // end Stock Option 

                //color
                $('select[name="color"]').empty();
                $.each(data.color,function(key,value){
                    if (data.color != "") {
                        $('#colorArea').show();
                    }else{
                        $('#colorArea').hide();
                    }
                    $('select[name="color"]').append('<option value=" '+value+' ">'+value+' </option>')
                })//end color

                //size
                $('select[name="size"]').empty();
                $.each(data.size,function(key,value){
                    if (data.size != "") {
                        $('#sizeArea').show();
                    }else{
                        $('#sizeArea').hide();
                    }
                    $('select[name="size"]').append('<option value=" '+value+' ">'+value+' </option>')
                })//end size
            }
        })
    }

    // Start Add To Cart Product 
    function addToCart(){
        var product_name = $('#pname').text();
        var id = $('#product_id').val();
        var color = $('#color option:selected').text();
        var size = $('#size option:selected').text();
        var quantity = $('#qty').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{
                color:color, 
                size:size, 
                quantity:quantity, 
                product_name:product_name
            },
            url: "/cart/data/store/"+id,
            success:function(data){
                
                miniCart()
                $('#closeModel').click();
                //console.log(data)
                // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message 
            }
        })
    }

</script>

<script type="text/javascript" defer>
    function miniCart(){
       $.ajax({
           type: 'GET',
           url: '/product/mini/cart',
           dataType:'json',
           success:function(response){

            $('span[id="cartSubTotal"]').text(response.cartTotal);
            $('#cartQty').text(response.cartQty);
            var miniCart = ""

            $.each(response.carts, function(key,value){
                miniCart += 
                `
                <div class="cart-item product-summary">
                    <div class="row">
                    <div class="col-xs-4">
                        <div class="image"> 
                            <a href=""><img src="/${value.options.image}" alt=""></a> 
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <h3 class="name">
                            <a href="">${value.name}</a>
                        </h3>
                        <div class="price">$${value.price} * ${value.qty} </div>
                    </div>
                    <div class="col-xs-1 action"> 
                        <div class="col-xs-1 action"> 
                        <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button>
                    </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>
                `
            });
            $('#miniCart').html(miniCart);
           }
       })
    }
    miniCart();

    // mini cart remove Start 
    function miniCartRemove(rowId){
        $.ajax({
            type: 'GET',
            url: '/minicart/product-remove/'+rowId,
            dataType:'json',
            success:function(data){
            miniCart();
             // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message 
            }
        });
    }
    // mini cart remove end
</script>

<!--  /// Start Add Wishlist Page  //// -->
<script type="text/javascript" defer>
    function addToWishList(product_id){
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/add-to-wishlist/"+product_id,
            success:function(data){
                // Start Message 
                 const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message 
            }
        })
    }
</script>
<!--  /// End Add Wishlist Page  ////   -->

<!-- /// Load Wishlist Data  -->
<script type="text/javascript" defer>
    function wishlist(){
       $.ajax({
           type: 'GET',
           url: '/get-wishlist-product',
           dataType:'json',
           success:function(response){
               var rows = ""
               $.each(response, function(key,value){
                //en attendant jucequa ce que tu le fasse proprement avec cle etrangere + supression en cascade
                if(value.product){
                    rows += `
                    <tr>
                    <td class="col-md-2">
                        <img src="/${value.product.product_thambnail} " alt="imga">
                    </td>
                    <td class="col-md-7">
                        <div class="product-name">
                            <a href="#">${value.product.product_name_en}</a>
                        </div>
                        
                        <div class="price">
                            ${value.product.discount_price == null
                                ? `$${value.product.selling_price}`
                                :
                                `$${value.product.discount_price} 
                                <span>$${value.product.selling_price}</span>`
                            }  
                        </div>
                    </td>
                    <td class="col-md-2">
                        <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="${value.product_id}" onclick="productView(this.id)"> Add to Cart </button>
                    </td>
                    <td class="col-md-1 close-btn">
                        <button type="submit" class="" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fa fa-times"></i></button>
                    </td>
                    </tr>
                    `
                }
                });
               $('#wishlist').html(rows);
            }
        })
    }
    wishlist();

    ///  Wishlist remove Start 
    function wishlistRemove(id){
        $.ajax({
            type: 'GET',
            url: '/wishlist-remove/'+id,
            dataType:'json',
            success:function(data){
            wishlist();
             // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message 
            }
        });
    }
    // End Wishlist remove  
</script> 
<!-- /// End Load Wisch list Data  -->

<!-- /// Load My Cart /// -->
<script type="text/javascript" defer>
    function cart(){
       $.ajax({
           type: 'GET',
           url: '/get-cart-product',
           dataType:'json',
           success:function(response){
               var rows = ""
               $.each(response.carts, function(key,value){
                    rows += `
                    <tr>

                    <td class="col-md-2">
                        <img src="/${value.options.image} " alt="imga" style="width:60px; height:60px;">
                    </td>

                    <td class="col-md-2">
                        <div class="product-name">
                            <a href="#">${value.name}</a>
                        </div>
                        
                        <div class="price">
                            $${value.price}  
                        </div>
                    </td>

                    <td class="col-md-2">
                        ${value.options.color == null
                            ? `<span> .... </span>`
                            : `<strong>${value.options.color} </strong>` 
                        }  
                    </td>

                    <td class="col-md-2">
                        ${value.options.size == null
                            ? `<span> .... </span>`
                            : `<strong>${value.options.size} </strong>` 
                        }           
                    </td>

                    <td class="col-md-2">

                        ${value.qty>1
                            ? `<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)">-</button>`

                            : `<button type="submit" class="btn btn-danger btn-sm" disabled>-</button>`
                        }
                        

                        <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width:35px; height:27px; text-align:center;" >

                        <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrement(this.id)" >+</button>
                    </td>

                    <td class="col-md-2">
                        <!-- subtotal est une méthode du package bumbummen -->
                        <strong>$${value.subtotal} </strong> 
                    </td>

                    <td class="col-md-1 close-btn">
                        <!-- ici value.rowId et non pas .id !!!!! -->
                        <button type="submit" class="" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-times"></i></button>
                    </td>
                    </tr>
                    `
                });
               $('#cartPage').html(rows);
            }
        })
    }
    cart();

    ///  cart remove Start 
    function cartRemove(id){
        $.ajax({
            type: 'GET',
            url: '/cart-remove/'+id,
            dataType:'json',
            success:function(data){
            
            cart();
            miniCart();

            couponCalculation();
            $('#couponField').show();
            $('#coupon_name').val('');

             // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message 
            }
        });
    }
    // End cart remove

    // -------- CART INCREMENT --------//
    function cartIncrement(rowId){
        $.ajax({
            type:'GET',
            url: "/cart-increment/"+rowId,
            dataType:'json',
            success:function(data){
                couponCalculation();
                cart();
                miniCart();
            }
        });
    }
    // ---------- END CART INCREMENT -----///

    // -------- CART Decrement  --------//
    function cartDecrement(rowId){
        $.ajax({
            type:'GET',
            url: "/cart-decrement/"+rowId,
            dataType:'json',
            success:function(data){
                couponCalculation();
                cart();
                miniCart();
            }
        });
    }
    // ---------- END CART Decrement -----///
</script>
<!-- //End Load My cart / -->

<!--  //////////////// =========== Coupon Apply Start ================= ////  -->
<script type="text/javascript" defer>
    function applyCoupon(){
        // coupon_name c'est la variale qui est dans l'input du coupon dans la vue view_mycart t'ajoute juste juste un # pour la recuperer
        var coupon_name = $('#coupon_name').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            //on passe notre variable dans la route dans 'data' pour pouvoir l'utiliser dans le controller
            data: {coupon_name:coupon_name},
            url: "{{ url('/coupon-apply') }}",
            success:function(data){
                couponCalculation();
                //$('#couponField').hide(); pas ici mais un peu plus bas !!
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    // tu la mets ici pour que en cas de mauvais code ca ne la cache pas
                    $('#couponField').hide();
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
            }
        });
    } 
    
    function couponCalculation(){
        $.ajax({
            type: 'GET',
            url: "{{ url('/coupon-calculation') }}",
            dataType: 'json',
            success:function(data){
                if (data.total) {
                $('#couponCalField').html(
                    `
                    <tr>
                    <th>
                    <div class="cart-sub-total">
                        Subtotal<span class="inner-left-md">$ ${data.total}</span>
                    </div>
                    <div class="cart-grand-total">
                        Grand Total<span class="inner-left-md">$ ${data.total}</span>
                    </div>
                    </th>
                    </tr>
                    `
                )
                }else{
                 $('#couponCalField').html(
                `
                <tr>
                    <th>
                    <div class="cart-sub-total">
                        Subtotal<span class="inner-left-md">$ ${data.subtotal}</span>
                    </div>
                    <div class="cart-sub-total">
                        Coupon<span class="inner-left-md"> ${data.coupon_name}</span>
                        <button type="submit" onclick="couponRemove()"><i class="fa fa-times"></i>  </button>
                    </div>
                    <div class="cart-sub-total">
                        Discount Amount<span class="inner-left-md">$ ${data.discount_amount}</span>
                    </div>
                    <div class="cart-grand-total">
                        Grand Total<span class="inner-left-md">$ ${data.total_amount}</span>
                    </div>
                    </th>
                </tr>
                `
                )
                }
            }
        });
    }
    couponCalculation();
</script>
<!--  //////////////// =========== End Coupon Apply Start ================= ////  -->

<!--  //////////////// =========== Start Coupon Remove================= ////  -->

<script type="text/javascript" defer>
     
    function couponRemove(){
       $.ajax({
           type:'GET',
           url: "{{ url('/coupon-remove') }}",
           dataType: 'json',
           success:function(data){
               couponCalculation();
               $('#couponField').show();
               $('#coupon_name').val('');
                // Start Message 
               const Toast = Swal.mixin({
                     toast: true,
                     position: 'top-end',
                     
                     showConfirmButton: false,
                     timer: 3000
                   })
               if ($.isEmptyObject(data.error)) {
                   Toast.fire({
                       type: 'success',
                       icon: 'success',
                       title: data.success
                   })
               }else{
                   Toast.fire({
                       type: 'error',
                       icon: 'error',
                       title: data.error
                   })
               }
               // End Message 
           }
       });
    }
</script>
<!--  //////////////// =========== End Coupon Remove================= ////  -->