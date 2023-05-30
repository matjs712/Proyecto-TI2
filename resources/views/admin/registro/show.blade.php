<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Fecha:</strong></div>
        <div class="col-md-6">{{ $registros->fecha }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Proveedor:</strong></div>
        <div class="col-md-6">{{ $registros->proveedor->name }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Ingrediente:</strong></div>
        <div class="col-md-6">{{ $registros->ingrediente->name }}</div>
    </div>

    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Cantidad:</strong></div>
        <div class="col-md-6">{{ $registros->cantidad }}</div>
    </div>

    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Medida:</strong></div>
        <div class="col-md-6">{{ $registros->medida }}</div>
    </div>

    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Factura:</strong></div>
        <div class="col-md-6">
            @if (pathinfo($registros->factura, PATHINFO_EXTENSION) == 'pdf')
                <iframe style="overflow:hidden" scrolling="no" id="imagen-cargada" width="100"
                    src="{{ Storage::url('uploads/facturas/' . $registros->factura) }}" frameborder="5"></iframe>
            @else
                <img id="imagen-cargada" width="100"
                    src="{{ Storage::url('uploads/facturas/' . $registros->factura) }}" alt="factura-image">
            @endif
        </div>
    </div>

</div>


