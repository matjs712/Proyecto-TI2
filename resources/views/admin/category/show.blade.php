<div class="row">
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Nombre:</strong></div>
        <div class="col-md-6">{{ $categoria->name }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Slug:</strong></div>
        <div class="col-md-6">{{ $categoria->slug }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Descripción:</strong></div>
        <div class="col-md-6">{{ $categoria->description }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Estado:</strong></div>
        <div class="col-md-6">{{ $categoria->status == 1 ? 'Visible':'No visible' }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Popular:</strong></div>
        <div class="col-md-6">{{ $categoria->popular == 1 ? 'Categoria Destacada':'No Destacada' }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Imagen:</strong></div>
        <div class="col-md-6">
            <img src="{{ Storage::url('uploads/categorias/'.$categoria->image) }}" width="100" alt="">
        </div>
    </div>

</div>
