$(document).ready(function(){
const sweet = (response) =>{
    return Swal.fire({
        toast: true,
        position: 'bottom-end',
        timer: 2000,
        timerProgressBar: true,
        icon: 'success',
        title: `${response.status}`,
        showConfirmButton: false,
      })
}
    loadCart();
    loadWish();
    getQTY();

    // let searchProduct = document.getElementById("search_product");
    // let buttonSearch = document.getElementById("buttonSearch");
    // let buttonSubmit = document.querySelector(".search-submit");

    // buttonSearch.addEventListener("click", function() {
    //     searchProduct.style.opacity = "1";
    //     searchProduct.style.width = "320px";
    //     searchProduct.style.visibility = "visible";
    //     buttonSubmit.style.display = "block";
    //     buttonSearch.style.display = "none";
    // });

    // document.addEventListener("click", function(event) {
    //     // Si el elemento clickeado NO es el searchProduct ni uno de sus hijos
    //     if (!buttonSearch.contains(event.target) && !searchProduct.contains(event.target)) {
    //         searchProduct.style.opacity = "0";
    //         searchProduct.style.width = "0";
    //         searchProduct.style.visibility = "hidden";
    //         buttonSubmit.style.display = "none";
    //         buttonSearch.style.display = "block";
    //     }
    // });

    // buttonSearch.addEventListener("click", function(event) {
    //     event.stopPropagation();
    // });


    $('.qty-button').click(function () {
        $('.qty-count').html('');
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    function getQTY() {
        $.ajax({
          method: "GET",
          url: "/notificationsajax",
          success: function (response) {
            $('.qty-item').html('');
            $('.qty-count').html('');
            var count = 0;
            var remainingCount = 0;
            console.log(response);
            $.each(response, function (key, value) {
              if (key === '+') {
                remainingCount = value;
              } else {
                count++;
                var color = 'black';
                if (value == '1') {
                  color = 'orange';
                } else if (value == '2') {
                  color = 'red';
                }
                var linkHTML = '<a href="/notificaciones" class="dropdown-item" style="color: ' + color + '"><div class="media"><div class="media-body"><span>' + key + '</span></div></div></a>';
                $('.qty-item').append(linkHTML);
              }
            });
      
            if (remainingCount > 0) {
                
              var remainingText = '<a href="/notificaciones" class="dropdown-item text-primary" ><div class="media"><div class="media-body"><span>' + '+' + remainingCount + ' notificaciones restantes'  + '</span></div></div></a>';
              $('.qty-item').append('<div>' + remainingText + '</div>');
            }
      
            $('.qty-count').html(count);
          }
        });
      }

    $('.addCartBtn').click(function (e) {
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
                'product_id': prod_id,
                'product_qty': prod_qty,
            },
            success: function (response) {
                loadCart();
                sweet(response);
            }
        });
    })

    function loadCart() {

        $.ajax({
            method: "GET",
            url: "/load-cart-data",
            success: function (response) {
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
            }
        });
    }
    function loadWish() {

        $.ajax({
            method: "GET",
            url: "/load-wish-data",
            success: function (response) {
                $('.wish-count').html('');
                $('.wish-count').html(response.count);
            }
        });
    }

    $('.addToWishlist').click(function (e) {
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
            success: function (response) {
                loadWish();
                sweet(response);
            }
        });
    })
    
    $('.increment-btn').click(function (e) {
        e.preventDefault()

        var inc_value = $(this).closest('.prod_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? '0' : value;
        if (value < 10) {
            value++;
            $(this).closest('.prod_data').find('.qty-input').val(value);
        }
    })
    $('.decrement-btn').click(function (e) {
        e.preventDefault()

        var inc_value = $(this).closest('.prod_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? '0' : value;
        if (value > 0) {
            value--;
            $(this).closest('.prod_data').find('.qty-input').val(value);
        }
    })
    $('.delete-cart-item').click(function (e) {
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
                'product_id': prod_id,
            },
            success: function (response){
                sweet(response);
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        });
    })
    $('.remove-wishlist-item').click(function (e) {
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
                'prod_id': prod_id,
            },
            success: function (response){
                sweet(response);
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        });
    })
    $('.changeQuantity').click(function (e) {
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
                'product_id': prod_id,
                'product_qty': qty
            },
            success: function (response) {
                window.location.reload();
            }
        });

    })

})

window.addEventListener('load', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('sho');
            } else {
                entry.target.classList.remove('sho');
            }
        })
    });
    const hiddenElements = document.querySelectorAll('.hide');
    hiddenElements.forEach((el) => observer.observe(el));
    const hiddenElements2 = document.querySelectorAll('.hide2');
    hiddenElements2.forEach((el) => observer.observe(el));
});

// $(window).on('scroll', function() { //funcion para cuando se haga scroll aparezca el modal
//     var scrollPosition = $(this).scrollTop();
//     var pageHeight = $(document).height();
//     var windowHeight = $(this).height();
//     var twentyPercentHeight = (pageHeight - windowHeight) * 0.2; // Calcula el 20% de la altura de la página

//     if (scrollPosition >= twentyPercentHeight) {
//         $('#modalInicio').modal('show');
//         $(window).off('scroll'); // Desactiva el evento de scroll después de mostrar el modal
//     }
// });
window.addEventListener('load', () => {
    // Seleccionar el modal
    var modal = document.getElementById('modalInicio')
    var modalBootstrap = new bootstrap.Modal(modal)
    setTimeout(function () {
        // $('#modalInicio').modal('show');
        modalBootstrap.show()
    }, 2000); // esperar 2 segundos antes de mostrar el modal
});


const countdown = () =>{
    const countDate = new Date('june 3, 2023 22:00:00').getTime();
    const now = new Date().getTime();
    const gap = countDate - now;

    const second = 1000;
    const minute = second * 60;
    const hour = minute * 60;
    const day = hour * 24;

    const textDay = Math.floor(gap / day);
    const textHour = Math.floor((gap % day) / hour);
    const textMinute = Math.floor((gap % hour) / minute);
    const textSecond = Math.floor((gap % minute) / second);

    document.querySelector('.dayy').innerText = textDay;
    document.querySelector('.hourr').innerText = textHour;
    document.querySelector('.minutee').innerText = textMinute;
    document.querySelector('.secondd').innerText = textSecond;

    // if(gap < 10000){
    //     // Hacer algo
    // }
}
setInterval(() => countdown(), 1000);

