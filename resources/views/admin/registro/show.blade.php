<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Fecha:</strong></div>
        <div class="col-md-6">{{ $registros->fecha }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Proveedor:</strong></div>
        <div class="col-md-6">{{ $registros->id_proveedor }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Ingrediente:</strong></div>
        <div class="col-md-6">{{ $registros->id_ingrediente }}</div>
    </div>

    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Cantidad:</strong></div>
        <div class="col-md-6">{{ $registros->cantidad }}</div>
    </div>

    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Factura:</strong></div>
        <div class="col-md-6">
            <img src="{{ Storage::url('uploads/facturas/' . $registros->factura) }}" width="100" alt="">
        </div>
    </div>

</div>
