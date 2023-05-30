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
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Estado:</strong></div>
        <div class="col-md-6">{{ $producto->status == 1 ? 'Visible':'No visible' }}</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Popular:</strong></div>
        <div class="col-md-6">{{ $producto->trending == 1 ? 'Producto Destacado':'No Destacado' }}</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Imagen:</strong></div>
        <div class="col-md-6">
            <img src=" {{Storage::url('uploads/productos/'.$producto->image)}} " width="100" alt="">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-3"><strong>Ingredientes:</strong></div>
        <div class="col-md-3"><strong>Cantidad x u</strong></div>
        <div class="col-md-3"><strong>Cantidad Total</strong></div>
        <div class="col-md-3"><strong>Unidad de medida</strong></div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-3 d-flex flex-column">
            @foreach ($producto->ingredientes as $ing)
            <span>{{ $ing->name }}</span>
            @endforeach
        </div>
        <div class="col-md-3 d-flex flex-column">
            @foreach ($productoIngrediente as $ing)
            <span>{{ $ing->cantidad / 2 }} </span>
            @endforeach
        </div>
        <div class="col-md-3 d-flex flex-column">
            @foreach ($productoIngrediente as $ing)
            <span>{{ $ing->cantidad}} </span>
            @endforeach
        </div>
        <div class="col-md-3 d-flex flex-column">
            @foreach ($producto->ingredientes as $ing)
            <span>{{ $ing->medida }}</span>
            @endforeach
        </div>
    </div>

</div>
