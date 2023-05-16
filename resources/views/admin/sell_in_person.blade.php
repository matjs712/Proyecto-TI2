@extends('layouts.admin')
@section('title')
Usuarios | {{ $sitio }}
@endsection

@section('content')
{{-- <div class="container">
    
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Detalles</h6>
                        <hr>
                        <div class="row checkout-form">
                            
                        </div>
                        <button id="escaner" class="btn btn-primary" style="width: 100%">Escanear Producto</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-5">
                <div class="card">
                    
                        <div class="card-body">
                            <h6>Detalles de la orden</h6>
                            <hr>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            <hr>
                            <button style="width: 100%;" class="btn btn-primary pagoBtn">Ir al pago</button>
                        </div>
                </div>
            </div>
        </div>
</div> --}}
<div class="container">
    <div class="row">
    <div class="col">
        <div id="productos-container"></div>
        <button id="btnMostrarModal" class="btn btn-primary" style="width:640px">Escanea un producto</button>
    </div>
    <div class="col d-flex flex-column align-items-between">
        <div>
            <p>Total amount</p>
        </div>
        <div>
            <p>Temporary amount</p>
            <p>Shipping</p>
        </div>
        <div>
            <p>Total amount including Vat</p>
        </div>
        <div>
            Go to checkout
        </div>
    </div>
    </div>
</div>


<!-- Modal de escaneo -->
<div id="escanerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="escanerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="escanerModalLabel">Escanear producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="video" style="width: 100%;"></div>
            </div>
        </div>
    </div>
</div>

@endsection()
@section('after_scripts')
<script>
    
    $('#btnMostrarModal').on('click', function () {
        /*
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#video')
            },
            decoder: {
                readers: ["ean_reader"] // Puedes agregar otros tipos de lectores según tus necesidades
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
            var code = result.codeResult.code;
            console.log(code);
            agregarProducto(code);
            Quagga.stop();
            $('#escanerModal').modal('hide');
        });
        */
    agregarProducto(1);

    });
    let productos = [];
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
                console.log(productos);
                actualizarListaProductos(productos);
            },
            error: function (e) {
                console.log(e);
            }
        });
        }

    function actualizarListaProductos(productos) {
            var container = $('#productos-container');
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
                let deleteBtn = $('<button>').addClass('btn btn-danger mb-3 mr-3').append($('<i>').addClass('fa fa-trash'));


                imageCol.append(image);
                contentCol.append(cardBody.append(cardTitle, cardText));
                ctaSection.append(price, deleteBtn)
                row.append(imageCol, contentCol, ctaSection);
                card.append(row);
                container.append(card);
            });
        }
    $('#productos-container').on('click', '.btn-danger', function () {
        let productId = $(this).closest('.card').attr('id');
        console.log(productId);
    // Buscar el índice del producto en el array
        let productIndex = productos.findIndex(function (producto) {
            productos.forEach(function(producto){
                if(producto.id === productId){
                    return 1;
                }
            });
            return -1;
        });
            console.log(productIndex);
    
    // Verificar si se encontró el índice y eliminar el producto del array
        if (productIndex !== -1) {
            productos.splice(productIndex, 1);
        }
    
        // Eliminar el elemento de la vista
        $(this).closest('.card').remove();
        console.log(productos);
    });
</script>

@endsection()