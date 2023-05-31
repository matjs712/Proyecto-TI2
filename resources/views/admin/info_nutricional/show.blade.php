<div class="row">

    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong> Producto:</strong></div>
        <div class="col-md-6">{{ $nutricional->product->name }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Ingrediente:</strong></div>
        <div class="col-md-6">{{ $nutricional->valor_energetico }}</div>
    </div>

    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Cantidad:</strong></div>
        <div class="col-md-6">{{ $nutricional->grasa_saturada }}</div>
    </div>

    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Medida:</strong></div>
        <div class="col-md-6">{{ $nutricional->grasa_total }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Medida:</strong></div>
        <div class="col-md-6">{{ $nutricional->sal }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Medida:</strong></div>
        <div class="col-md-6">{{ $nutricional->yodo }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Medida:</strong></div>
        <div class="col-md-6">{{ $nutricional->azucar }}</div>
    </div>
    <div class="col-md-12 d-flex">
        <div class="col-md-6"><strong>Medida:</strong></div>
        <div class="col-md-6">{{ $nutricional->proteina }}</div>
    </div>


</div>
