 <!-- About Start -->
 <div class="container-fluid pt-5" style="position: relative">
     <div
         style="padding-top:30px;position: absolute; top:20%;left:0;width:250px;height:300px;background: rgba(151, 229, 233, 0.104)">
         <svg class="svg-background" width="344" height="384" fill="none" viewBox="0 0 404 784" aria-hidden="true"
             class="hidden lg:block absolute left-full transform -translate-x-1/2 -translate-y-1/4">
             <defs>
                 <pattern id="b1e6e422-73f8-40a6-b5d9-c8586e37e0e7" x="0" y="0" width="20"
                     height="20" patternUnits="userSpaceOnUse">
                     <rect x="0" y="0" width="4" height="4" fill="currentColor"
                         class="text-primario_azul-200"></rect>
                 </pattern>
             </defs>
             <rect width="404" height="784" fill="url(#b1e6e422-73f8-40a6-b5d9-c8586e37e0e7)"></rect>
         </svg>
     </div>
     <div class="container">
         <div class="section-title position-relative text-center mx-auto mb-5 pb-3 hide" style="max-width: 600px;">
             <h2 class="font-secondary" style="color:{{ $boton_nuevo }}">Sobre nosotros</h2>
             <h1 class="display-4 text-uppercase">{{ $titulo_sobre_nosotros }}</h1>
         </div>
         <div class="row gx-5 hide2">
             <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 400px;">
                 <div class="position-relative h-100">
                     <img class="position-absolute w-100 h-100"
                         src="{{ asset($imagen_sobre_nosotros) }}" style="object-fit: cover;">
                 </div>
             </div>
             <div class="col-lg-6 pb-5">
                 <h4 class="mb-4">{{ $texto_1_sobre_nosotros }}</h4>
                 <p class="mb-5">{{ $texto_2_sobre_nosotros }}</p>
                 <div class="row g-5">
                     <div class="col-sm-6">
                         <div class="d-flex align-items-center justify-content-center border-inner mb-4"
                             style="width: 90px; height: 90px; background-color:{{ $boton_nuevo }}">
                             <i class="fa fa-heartbeat fa-2x text-white"></i>
                         </div>
                         <h4 class="text-uppercase">{{ $titulo_texto_3_sobre_nosotros }}</h4>
                         <p class="mb-0">{{$texto_3_sobre_nosotros}}</p>
                     </div>
                     <div class="col-sm-6">
                         <div class="d-flex align-items-center justify-content-center border-inner mb-4"
                             style="width: 90px; height: 90px; background-color:{{ $boton_nuevo }}">
                             <i class="fa fa-award fa-2x text-white"></i>
                         </div>
                         <h4 class="text-uppercase">{{ $titulo_texto_4_sobre_nosotros }}</h4>
                         <p class="mb-0">{{ $texto_4_sobre_nosotros }}</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- About End -->
