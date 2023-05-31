<br><br><br><br>

<div style="position: relative">
    <div class="custom-shape-divider-bottom-1680362032">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path
                d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                opacity=".25" class="shape-fill"></path>
            <path
                d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                opacity=".5" class="shape-fill"></path>
            <path
                d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
                class="shape-fill"></path>
        </svg>
    </div>

</div>
<!-- Footer -->
<footer class="text-center text-lg-start text-muted" style="background: #a7c5bd">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
        style="position: relative;">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block text-white">
            <span>Contactate con nosotros a travez de nuestras redes sociales :</span>
        </div>
        <div>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-google"></i>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-github"></i>
            </a>
        </div>
        <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4 text-white">
                        <i class="fas fa-gem me-3"></i>De Sabelle
                    </h6>
                    <p class="text-white">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo officiis eius iure consectetur
                        voluptatum dolorum odio soluta, nostrum commodi error.
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4 text-white">
                        Categorías
                    </h6>
                    @php
                        $categorias2 = \App\Models\Category::take(4)->get();
                    @endphp
                    @foreach ($categorias2 as $cat)
                        <p class="text-white">
                            <a href="{{ url('ver-categoria/' . $cat->slug) }}"
                                class="text-reset">{{ $cat->name }}</a>
                        </p>
                    @endforeach
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 text-white">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Useful links
                    </h6>
                    <p class="text-white">
                        <a href="#!" class="text-reset">Pricing</a>
                    </p>
                    <p class="text-white">
                        <a href="#!" class="text-reset">Settings</a>
                    </p>
                    <p class="text-white">
                        <a href="#!" class="text-reset">Orders</a>
                    </p>
                    <p class="text-white">
                        <a href="#!" class="text-reset">Help</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4 text-white">Contact</h6>
                    <p class="text-white"><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                    <p class="text-white">
                        <i class="fas fa-envelope me-3"></i>
                        info@example.com
                    </p>
                    <p class="text-white"><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                    <p class="text-white"><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2023 Copyright:
        <a class="text-reset fw-bold" href="#">GrupoDos</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
