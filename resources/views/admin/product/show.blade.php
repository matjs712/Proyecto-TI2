{{-- <div class="row">
    <div class="col-md-6"><strong>ID:</strong></div>
    <div class="col-md-6">{{ $producto->id }}</div>
</div> --}}
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Nombre:</strong></div>
        <div class="col-md-6">{{ $producto->name }}</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Categoria:</strong></div>
        <div class="col-md-6">{{ $producto->category->name }}</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Cantidad:</strong></div>
        <div class="col-md-6">{{ $producto->qty }}</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Slug:</strong></div>
        <div class="col-md-6">{{ $producto->slug }}</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Descripción:</strong></div>
        <div class="col-md-6">{{ $producto->description }}</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Descripción corta:</strong></div>
        <div class="col-md-6">{{ $producto->small_description }}</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Precio:</strong></div>
        <div class="col-md-6">{{ $producto->original_price }}</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Precio en oferta:</strong></div>
        <div class="col-md-6">{{ $producto->selling_price }}</div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-4"><strong>Ingredientes:</strong></div>
        <div class="col-md-4"><strong>Cantidad x u</strong></div>
        <div class="col-md-4"><strong>Cantidad Total</strong></div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-4 d-flex flex-column">
            @foreach ($producto->ingredientes as $ing)
            <span>{{ $ing->name }}</span>
            @endforeach
        </div>
        <div class="col-md-4 d-flex flex-column">
            @foreach ($productoIngrediente as $ing)
            <span>{{ $ing->cantidad / 2 }} gr</span>
            @endforeach
        </div>
        <div class="col-md-4 d-flex flex-column">
            @foreach ($productoIngrediente as $ing)
            <span>{{ $ing->cantidad}} gr</span>
            @endforeach
        </div>
    </div>

</div>
