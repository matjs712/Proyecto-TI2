@extends('layouts.admin')
@section('title')
Usuarios | {{ $sitio }}
@endsection

@section('content')
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
                            <button style="width: 100%;" class="btn btn-primary pagoBtn">Ir al pago</button>
                        </div>
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
                console.log(productos);
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
    }
    $('#productos-container').on('click', '.btn-danger', function () {
        let productId = $(this).closest('.card').attr('id');
        console.log(productId);
    // Buscar el índice del producto en el array
        let productIndex = productos.findIndex(function (producto) {
            return producto.id == productId;
        });
            console.log(productIndex);
    
    // Verificar si se encontró el índice y eliminar el producto del array
        if (productIndex !== -1) {
            precio -= parseInt(productos[productIndex].selling_price);
            productos.splice(productIndex, 1);
        }
        
        // Eliminar el elemento de la vista
        $(this).closest('.card').remove();
        console.log(productos);
        $('#precio').html('$ ' + precio);
    });
</script>

@endsection()