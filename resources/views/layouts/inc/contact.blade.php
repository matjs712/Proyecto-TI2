    <!-- Offer Start -->
    <div class="container-fluid"
        style="background: linear-gradient(rgba(43, 40, 37, .9), rgba(43, 40, 37, .9)), url('{{ Storage::url('home-cut-section/sal-cut-2.jpg') }}') center center no-repeat;
    background-size: cover; margin-bottom:0px !important">
        <div class="container py-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title position-relative text-center mx-auto mb-4 pb-3" style="max-width: 600px;">
                        <h2 class="text-white font-secondary hide">Sacos de 20 kg de sal</h2>
                        <h1 class="display-4 text-uppercase text-white hide">Sin retocar</h1>
                    </div>
                    <p class="text-white mb-4 hide2">Eirmod sed tempor lorem ut dolores sit kasd ipsum. Dolor ea et
                        dolore et
                        at sea ea at dolor justo ipsum duo rebum sea. Eos vero eos vero ea et dolore eirmod et. Dolores
                        diam duo lorem. Elitr ut dolores magna sit. Sea dolore sed et.</p>
                    <a href="{{ url('ver-categoria/sacos') }}" class="btn border-inner py-3 px-5 me-3"
                        style="background-color: {{ $boton_principal_busqueda }}; color:white">Compralo ahora <i
                            class="fas fa-arrow-right    "></i></a>
                    {{-- <a href="" class="btn btn-dark border-inner py-3 px-5">Read More</a> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->
    <div class="testimonials-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center hide">Comentarios</h2>
                <p class="text-center hide2">Nuestros clientes aman nuestras sales! Lee lo que tienen para decir, aqui
                    abajo !
                    <i class="fas fa-arrow-alt-circle-down    "></i>
                </p>
            </div>
            <div class="row people hide2">
                @if ($comentarios)
                    @foreach ($comentarios as $comentario)
                        <div class="col-md-6 col-lg-4 item">
                            <div class="box">
                                <p class="description">{{ $comentario->user_review }}</p>
                            </div>
                            <div class="author"><img class="rounded-circle" src="assets/img/1.jpg">
                                <h5 class="name">{{ $comentario->user->name }}</h5>
                                <p class="title">Producto: {{ $comentario->products->name }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
