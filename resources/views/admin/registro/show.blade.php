<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Fecha:</strong></div>
        <div class="col-md-6">{{ $item->fecha }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Proveedor:</strong></div>
        <div class="col-md-6">{{ $item->proveedor->name }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Ingrediente:</strong></div>
        <div class="col-md-6">{{ $item->ingrediente->name }}</div>
    </div>

    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Cantidad:</strong></div>
        <div class="col-md-6">{{ $item->cantidad }}</div>
    </div>

    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Factura:</strong></div>
        <div class="col-md-6">
            <img src="{{ Storage::url('uploads/facturas/' . $item->factura) }}" width="100" alt="">
        </div>
    </div>

</div>
