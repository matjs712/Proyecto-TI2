@extends('layouts.admin')
@section('title')
Venta Presencial | {{ $sitio }}
@endsection

@section('content')

<style>

    #video {
  position: relative;
}

#video video {
  position: relative;
  z-index: 1;
}

#video canvas {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 0;
}
</style>

<div class="container">

        <div class="row vh-100">
            <div class="col-md-7">
                <div class="card h-75">
                    <div class="card-body h-100 d-flex flex-column">
                        <h6>Detalles</h6>
                        <div class="h-100" style="max-height:500px; overflow-y:auto; overflow-x:hidden" id="productos-container">

                        </div>
                        <button id="btnMostrarModal" class="btn btn-primary" style="width: 100%">Escanear Producto</button>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                        <div class="card-body">
                            <h6>Orden</h6>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p>Total:</p>
                                <p id="precio"></p>
                            </div>
                            <hr>
                            <select class="form-select w-100 p-1" id="metodoPago"  aria-label="Default select">
                                <option hidden selected>Metodo de pago</option>
                                <option value="1">Efectivo</option>
                                <option value="2">WebPay</option>
                              </select>
                              <hr>
                            <button style="width: 100%;" class="btn btn-primary btnPagar">Seleccione metodo de pago</button>
                        </div>
                </div>
            </div>
        </div>
</div>


<!-- Modal de escaneo -->
<div id="escanerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="escanerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content overflow-hidden">
            <div class="modal-header">
                <h5 class="modal-title" id="escanerModalLabel">Escanear producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center w-100 h-75 overflow-hidden">
                <div class="" id="video"></div>
            </div>

        </div>
    </div>
</div>
{{-- Modal pago QR --}}
<div id="qrModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content h-100">
            <div class="modal-header">
                <h5 class="modal-title" id="qrModalLabel">Realizar pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body justify-content-center">
                <canvas class="row m-auto" style="height: 300px; width: 300px" id="qr"></canvas>
                <button id="completarPago" class="row btn btn-primary w-100 mt-4">Completar pago</button>
            </div>

        </div>
    </div>
</div>
{{-- Comprobante de pago --}}
<div id="pdf" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content h-100">
            <div class="modal-header">
                <h5 class="modal-title" id="qrModalLabel">Realizar pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <embed src="{{ asset('storage/pdf/example.pdf') }}" width="100%" height="500" type="application/pdf">
            </div>
        </div>
    </div>
</div>


@endsection()
@section('after_scripts')
<script>

    $('#btnMostrarModal').on('click', function () {
        let codigoLeido = false;
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                constraints:{
                    width: 480,
                    height: 360,
                },
                target: document.querySelector('#video')
            },
            // frequency: 10,
            decoder: {
                readers: ["code_128_reader"] // Puedes agregar otros tipos de lectores según tus necesidades
            }
        }, function (err) {
            if (err) {
                console.error(err);
                return;
            }

            Quagga.start();
            $('#escanerModal').modal('show');
        });

        Quagga.onDetected(function (result) {
            if(!codigoLeido){
                codigoLeido = true;
                let code = result.codeResult.code;
                Quagga.stop();
                agregarProducto(code);
                $('#escanerModal').modal('hide');
            }
        });


    });
    let productos = [];
    let precio;
    function agregarProducto(codigo) {
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.ajax({
            url: "agregar-producto",
            method: 'GET',
            data: {
                codigo: codigo
            },
            success: function (codigo) {
                //obtenerProductosEscaneados();
                productos.push(codigo);
                actualizarListaProductos(productos);
            },
            error: function (e) {
                console.log(e);
            }
        });
        }

    function actualizarListaProductos(productos) {
        let container = $('#productos-container');
        precio = 0;
        container.empty();
        productos.forEach(function (producto) {
            let card = $('<div>').addClass('card my-2').attr('id', producto.id).css('max-width', '640px');
            let row = $('<div>').addClass('row g-0');
            let imageCol = $('<div>').addClass('col-md-4');
            let image = $('<img>').addClass('img-fluid rounded-start').attr('src', '<?= Storage::url("uploads/productos/' + producto.image + '") ?>').attr('alt', 'Product Image');
            let contentCol = $('<div>').addClass('col-md-6');
            let cardBody = $('<div>').addClass('card-body');
            let cardTitle = $('<h5>').addClass('card-title').text(producto.name);
            let cardText = $('<p>').addClass('card-text').text(producto.description);
            let ctaSection = $('<div>').addClass('col-md-2 d-flex flex-column justify-content-between');
            let price = $('<p>').addClass('mt-4 mb-0 text-end').text(producto.selling_price);
            precio += parseInt(producto.selling_price);
            let deleteBtn = $('<button>').addClass('btn btn-danger mb-3 mr-3').append($('<i>').addClass('fa fa-trash'));


            imageCol.append(image);
            contentCol.append(cardBody.append(cardTitle, cardText));
            ctaSection.append(price, deleteBtn)
            row.append(imageCol, contentCol, ctaSection);
            card.append(row);
            container.append(card);
        });
        $('#precio').html('$ ' + precio);
        document.getElementById('productos-container').scrollTop = document.getElementById('productos-container').scrollHeight;
    }

    $('#metodoPago').on('change', function(){
        let valor = $(this).val();
        if(valor == 1)
            $('.btnPagar').html("Completar pago");
        else
            $('.btnPagar').html("Obtener QR");
    });

    $('#productos-container').on('click', '.btn-danger', function () {
        let productId = $(this).closest('.card').attr('id');
        console.log(productId);
    // Buscar el índice del producto en el array
        let productIndex = productos.findIndex(function (producto) {
            return producto.id == productId;
        });
        // console.log(productIndex);

    // Verificar si se encontró el índice y eliminar el producto del array
        if (productIndex !== -1) {
            precio -= parseInt(productos[productIndex].selling_price);
            productos.splice(productIndex, 1);
        }

        // Eliminar el elemento de la vista
        $(this).closest('.card').remove();
        $('#precio').html('$ ' + precio);
    });

    $('.btnPagar').click(function(e){


        e.preventDefault();

        let carrito = {};
        productos.forEach( function(producto){
            if(carrito[producto.id])
                carrito[producto.id].cantidad++;
            else
            carrito[producto.id] = {
                id: producto.id,
                precio: producto.selling_price,
                cantidad: 1
            }
        });


        for (let producto in carrito) {
            console.log(carrito[producto].id);
            console.log(carrito[producto].cantidad);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                method: "POST",
                url: "/add-to-cart",
                data: {
                    'product_id': carrito[producto].id,
                    'product_qty': carrito[producto].cantidad,
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (response){
                    console.log(response);
                }
            });
        }

        let metodoPago = document.getElementById('metodoPago').value;
        if(Object.keys(carrito).length > 0){
            if(metodoPago == 2){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                let qrContainer = document.getElementById('qr');
                $.ajax({
                    method: "POST",
                    url: "/iniciar-compra-presencial",
                    success: function (response) {
                        $('#qrModal').modal('show');
                        let qr = new QRious({
                            element: qrContainer,
                            value: response,
                            size: 200
                        });

                        $('#qr').html(qr);
                        console.log(response);
                    },
                    error: function (response){
                        console.log(response);
                    }
                });



            }
            else if(metodoPago == 1){
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "La orden estará pagada!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28A745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, confirmar!',
                    customClass:{
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        })
                        $.ajax({
                            method: "POST",
                            url: "/completar-pago",
                            success: function (response) {
                                Swal.fire({
                                    toast: true,
                                    position: 'bottom-end',
                                    timer: 1100,
                                    timerProgressBar: true,
                                    icon: 'success',
                                    title: "Pago realizado con exito",
                                    showConfirmButton: false,
                                    customClass: {
                                        popup: 'custom-swal-success'
                                    }
                                })
                                Swal.fire({
                                    title: 'Pago realizado con exito!',
                                    text: "Deseas recibir el comprobante por correo?",
                                    input: 'email',
                                    icon: 'success',
                                    showCancelButton: true,
                                    confirmButtonColor: '#28A745',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Si, enviar!',
                                    cancelButtonText: 'No, salir.',
                                    customClass:{
                                        confirmButton: 'btn btn-success',
                                        cancelButton: 'btn btn-danger'
                                    },
                                    inputValidator: (email) => {
                                        if (!email.includes('@')) {
                                        return 'Ingrese un correo electronico valido.';
                                        }
                                    },
                                    allowOutsideClick: () => !Swal.isLoading()
                                    }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        }),
                                        $.ajax({
                                            method: 'POST',
                                            url: '/enviar-correo',
                                            data:{ email: result.value },
                                            success: function(response){
                                                console.log(result.value);
                                                Swal.fire({
                                                    title: '¡Correo enviado con exito!',
                                                    text: 'se ah enviado la boleta.',
                                                    icon: 'success'
                                                });

                                            },
                                            error: function(response){
                                                console.log(response);
                                            }
                                        }).then((result) => {
                                            setTimeout(function() {
                                                location.reload();
                                            }, 500);
                                        })
                                    }
                                    else{
                                        setTimeout(function() {
                                            location.reload();
                                        }, 500);
                                    }

                                })

                            },
                            error: function (response){
                                console.log(response);
                            }
                        });

                    }
                })
            }
        }
        else{
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                timer: 1100,
                timerProgressBar: true,
                icon: 'warning',
                title: "Agregue algo al carrito",
                showConfirmButton: false,
                customClass: {
                }
            })
        }

    });

    $('#completarPago').click( function(e){
        $('#qrModal').modal('hide');
        Swal.fire({
                    title: 'Estas seguro?',
                    text: "La orden estará pagada!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28A745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, confirmar!',
                    customClass:{
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {

                                Swal.fire({
                                    title: 'Pago realizado con exito!',
                                    text: "Deseas recibir el comprobante por correo?",
                                    input: 'email',
                                    icon: 'success',
                                    showCancelButton: true,
                                    confirmButtonColor: '#28A745',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Si, enviar!',
                                    cancelButtonText: 'No, salir.',
                                    customClass:{
                                        confirmButton: 'btn btn-success',
                                        cancelButton: 'btn btn-danger'
                                    },

                                    allowOutsideClick: () => !Swal.isLoading()
                                    }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        }),
                                        $.ajax({
                                            method: 'POST',
                                            url: '/enviar-correo',
                                            data:{ email: result.value },
                                            success: function(response){
                                                console.log(result.value);
                                                Swal.fire({
                                                    title: '¡Correo enviado con exito!',
                                                    text: 'se ah enviado la boleta.',
                                                    icon: 'success'
                                                });

                                            },
                                            error: function(response){
                                                console.log(response);
                                            }
                                        }).then((result) => {
                                            setTimeout(function() {
                                                location.reload();
                                            }, 500);
                                        })
                                    }
                                    else{
                                        setTimeout(function() {
                                            location.reload();
                                        }, 500);
                                    }

                                })
                            }
                    });

    });

</script>
{{-- @if(session('pago'))
    <script>
        setTimeout(function() {
            location.reload();
        }, 500);
    </script>
@endif --}}

@endsection()
