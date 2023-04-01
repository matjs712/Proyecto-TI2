<!-- Footer -->
<footer class="text-center text-lg-start text-muted" style="background: #a7c5bd">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom" style="position: relative;">
        <!-- Left -->
      <div class="me-5 d-none d-lg-block text-white">
        <span>Contactate con nosotros a travez de nuestras redes sociales   :</span>
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
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo officiis eius iure consectetur voluptatum dolorum odio soluta, nostrum commodi error.
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4 text-white">
              Categorías
            </h6>
            @foreach ($categorias as $cat)
                <p class="text-white">
                    <a href="{{ url('ver-categoria/'.$cat->slug) }}" class="text-reset">{{ $cat->name }}</a>
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