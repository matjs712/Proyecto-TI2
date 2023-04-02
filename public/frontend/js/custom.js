$(document).ready(function(){

    loadCart();
    loadWish();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    
    $('.addCartBtn').click(function (e){
        e.preventDefault()
        var prod_id = $(this).closest('.prod_data').find('.prod_id').val();
        var prod_qty = $(this).closest('.prod_data').find('.qty-input').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                'product_id'  : prod_id,
                'product_qty' : prod_qty,
            },
            success: function (response){
                loadCart();
                swal(response.status);
            }
        });
    })

    function loadCart(){
        
        $.ajax({
            method: "GET",
            url: "/load-cart-data",
            success: function (response){
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
            }
        });
    }
    function loadWish(){
        
        $.ajax({
            method: "GET",
            url: "/load-wish-data",
            success: function (response){
                $('.wish-count').html('');
                $('.wish-count').html(response.count);
            }
        });
    }

    $('.addToWishlist').click(function (e){
        e.preventDefault()
        var prod_id = $(this).closest('.prod_data').find('.prod_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.ajax({
            method: "POST",
            url: "/add-to-wishlist",
            data: {
                'prod_id': prod_id,
            },
            success: function (response){
                loadWish();
                swal(response.status);
            }
        });
    })
    $('.increment-btn').click(function (e){
        e.preventDefault()

        var inc_value = $(this).closest('.prod_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? '0' : value;
        if(value < 10){
            value++;
            $(this).closest('.prod_data').find('.qty-input').val(value);
        }
    })
    $('.decrement-btn').click(function (e){
        e.preventDefault()

        var inc_value = $(this).closest('.prod_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? '0' : value;
        if(value > 0){
            value--;
            $(this).closest('.prod_data').find('.qty-input').val(value);
        }
    })
    $('.delete-cart-item').click(function (e){
        e.preventDefault()
        
        var prod_id = $(this).closest('.prod_data').find('.prod_id').val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        
        $.ajax({
            method: "POST",
            url: "delete-cart-item",
            data: {
                'product_id'  : prod_id,
            },
            success: function (response){
                swal("", response.status, "success");
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        });
    })
    $('.remove-wishlist-item').click(function (e){
        e.preventDefault()
        
        var prod_id = $(this).closest('.prod_data').find('.prod_id').val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        
        $.ajax({
            method: "POST",
            url: "delete-wishlist-item",
            data: {
                'prod_id'  : prod_id,
            },
            success: function (response){
                swal(response.status);
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        });
    })
    $('.changeQuantity').click(function (e){
        e.preventDefault()
        var prod_id = $(this).closest('.prod_data').find('.prod_id').val();
        var qty = $(this).closest('.prod_data').find('.qty-input').val();
             
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.ajax({
            type: "POST",
            url: "update-cart",
            data: {
                'product_id'  : prod_id,
                'product_qty' : qty
            },
            success: function (response){ 
                window.location.reload();
            }
        });
        
    })
})

