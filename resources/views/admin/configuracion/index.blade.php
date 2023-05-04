@extends('layouts.admin')
@section('title')
Configuración | {{ $sitio }}
@endsection

@section('content')

<div class="py-3 mb-1 border-bottom border-top">
    <div class="container ml-3">
        <h6 class="mb-0">
            <a href="{{ url('dashboard') }}">Inicio</a> / 
            <a href="{{ url('configuracion') }}">Configuración</a> 
        </h6>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex aling-items-center flex-wrap">
        <h4>Configuración</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">General</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Administrador</a>
                    {{-- <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"></a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a> --}}
                  </div>
            </div>
            <div class="col-md-10">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <form  action="{{ url('update-general') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group d-flex align-items-center flex-wrap">
                              <div>
                                <label for="logo">Logo del sitio</label>
                                <input type="file" id="logoSitio" name="logo" class="form-control">
                                <img id="preview1" width="200" height="200" src="{{asset($logo)}}" alt=" ">
                              </div>
                            </div>
                            <hr>
                            <div class="form-group d-flex align-items-center flex-wrap">
                              <div>
                                <label for="logo">Nombre del sitio</label>
                                <input type="text" name="nombreSitio" class="form-control" value="{{ $sitio }}">
                              </div>
                            </div>
                            <hr>
                            <div class="form-group d-flex align-items-center flex-wrap">
                              <div>
                                <label for="secciones">Secciones</label>
                                <div>
                                  <input type="checkbox" id="productos" name="productos" {{ $productos ? 'checked':'' }} value="productos">
                                  <label for="productos">Productos</label>
                                </div>
                                <div>
                                  <input type="checkbox" id="categorias" name="categorias" {{ $categorias ? 'checked':'' }} value="categorias">
                                  <label for="categorias">Categorías</label>
                                </div>
                                <div>
                                  <input type="checkbox" id="ingredientes" name="ingredientes" {{ $ingredientes ? 'checked':'' }} value="ingredientes">
                                  <label for="ingredientes">Ingredientes</label>
                                </div>
                                <div>
                                  <input type="checkbox" id="proveedores" name="proveedores" {{ $proveedores ? 'checked':'' }} value="proveedores">
                                  <label for="proveedores">Proveedores</label>
                                </div>
                                <div>
                                  <input type="checkbox" id="registros" name="registros" {{ $registros ? 'checked':'' }} value="registros">
                                  <label for="registros">Registros</label>
                                </div>
                                <div>
                                  <input type="checkbox" id="ordenes" name="ordenes" {{ $ordenes ? 'checked':'' }} value="ordenes">
                                  <label for="ordenes">Ordenes</label>
                                </div>
                                <div>
                                  <input type="checkbox" id="usuarios" name="usuarios" {{ $usuarios ? 'checked':'' }} value="usuarios">
                                  <label for="usuarios">Usuarios</label>
                                </div>
                                <div>
                                  <input type="checkbox" id="roles_permisos" name="roles_permisos" {{ $roles_permisos ? 'checked':'' }} value="roles_permisos">
                                  <label for="roles_permisos">Roles & permisos</label>
                                </div>
                              </div>
                            </div>
                            <hr>
                            <h4>Colores del sitio web</h4>
                            <br>
                            <div class="row">
                              <div class="col-md-3">
                                  <label>Color principal:</label>
                                  <div class="input-group my-colorpicker1">
                                    <input type="text" name="color_principal" value={{ asset($color_principal) }} class="form-control">
                                    <div class="input-group-append">
                                      <span class="input-group-text"><i class="fas fa-square" style="color:{{ asset($color_principal) }}"></i></span>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                <label>Color secundario:</label>
                                <div class="input-group my-colorpicker2">
                                  <input type="text" name="color_secundario" value={{ asset($color_secundario) }} class="form-control">
                                  <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-square" style="color:{{ asset($color_secundario) }}"></i></span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <label>Color barra de busqueda:</label>
                                <div class="input-group my-colorpicker8">
                                  <input type="text" name="color_barra_busqueda" value={{ asset($color_barra_busqueda) }} class="form-control">
                                  <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-square" style="color:{{ asset($color_barra_busqueda) }}"></i></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <br>
                            <h4>Colores del panel de administración</h4>
                            <br>
                            <div class="row">
                              <div class="col-md-3">
                                  <label>Barra lateral:</label>
                                  <div class="input-group my-colorpicker3">
                                    <input type="text" name="color_barra_lateral" value={{ asset($color_barra_lateral) }} class="form-control">
                                    <div class="input-group-append">
                                      <span class="input-group-text"><i class="fas fa-square" style="color:{{ asset($color_barra_lateral) }}"></i></span>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                <label>Color de fondo:</label>
                                <div class="input-group my-colorpicker4">
                                  <input type="text" name="color_fondo_admin" value={{ asset($color_fondo_admin) }} class="form-control">
                                  <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-square" style="color:{{ asset($color_fondo_admin) }}"></i></span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <label>Color barra horizontal:</label>
                                <div class="input-group my-colorpicker5">
                                  <input type="text" name="color_barra_horizontal" value={{ asset($color_barra_horizontal) }} class="form-control">
                                  <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-square" style="color:{{ asset($color_barra_horizontal) }}"></i></span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <label>Color letra barra lateral:</label>
                                <div class="input-group my-colorpicker6">
                                  <input type="text" name="color_a_tag_sidebar" value={{ asset($color_a_tag_sidebar) }} class="form-control">
                                  <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-square" style="color:{{ asset($color_a_tag_sidebar) }}"></i></span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <label>Color letra al posar el mouse:</label>
                                <div class="input-group my-colorpicker7">
                                  <input type="text" name="color_a_tag_hover" value={{ asset($color_a_tag_hover) }} class="form-control">
                                  <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-square" style="color:{{ asset($color_a_tag_hover) }}"></i></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <hr>
                            <h4>Textos principales</h4>
                            <br>
                            <div class="row">
                              <div class="col-md-3">
                                  <label>Texto corto 1:</label>
                                  <div class="input-group">
                                    <textarea name="texto_banner_1" class="form-control" style="resize:none;" cols="20" rows="5">{{ $texto_1 }}</textarea>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <label>Texto corto 2:</label>
                                  <div class="input-group">
                                    <textarea name="texto_banner_2" class="form-control" style="resize:none;" cols="20" rows="5">{{ $texto_2 }}</textarea>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <label>Texto largo 1:</label>
                                  <div class="input-group">
                                    <textarea name="texto_banner_3" class="form-control" style="resize:none;" cols="20" rows="5">{{ $texto_3 }}</textarea>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <label>Texto largo 2:</label>
                                  <div class="input-group">
                                    <textarea name="texto_banner_4" class="form-control" style="resize:none;" cols="20" rows="5">{{ $texto_4 }}</textarea>
                                  </div>
                              </div>
                            </div>
                            <hr>
                            <h4>Imagen principal</h4>
                            <div class="row">
                              <div class="col-md-6">
                                  <input type="file" id="banner" name="banner" class="form-control">
                                  <img id="previewBanner" width="200" height="200" src="#" alt=" ">
                                <img src="{{ asset($banner) }}" width="200" alt="banner">
                              </div>  
                            </div>
                            <br>

                            <button type="submit" class="mt-4 btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <form action="{{ url('update-admin') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group d-flex align-items-center flex-wrap">
                                <div class="mr-2">
                                  <label for="perfil">Foto de perfil</label>
                                  <input type="file" id="perfil" name="perfil" class="form-control">
                                  <img id="preview2" width="200" height="200" src="{{ Storage::url('users/'.Auth::user()->imagen) }}" alt=" ">
                                </div>
                                <div class="d-flex justify-content-center m-2">
                                </div>
                              </div>
                            <div class="form-group">
                                <label for="logo">Contraseña actual</label>
                                <input type="password" name="passActual" class="form-control">
                            </div>

                            <div class="form-group">
                              <label for="logo">Nueva contraseña</label>
                              <input type="password" name="pass" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="logo">Verificar contraseña</label>
                              <input type="password" name="passConf" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                    {{-- <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div> --}}
                  </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('after_scripts')
<script src="{{ asset('admin/dist/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script>
  $('.my-colorpicker1').colorpicker()

$('.my-colorpicker1').on('colorpickerChange', function(event) {
  $('.my-colorpicker1 .fa-square').css('color', event.color.toString());
});
  $('.my-colorpicker2').colorpicker()

$('.my-colorpicker2').on('colorpickerChange', function(event) {
  $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
});
  $('.my-colorpicker3').colorpicker()

$('.my-colorpicker3').on('colorpickerChange', function(event) {
  $('.my-colorpicker3 .fa-square').css('color', event.color.toString());
});
  $('.my-colorpicker4').colorpicker()

$('.my-colorpicker4').on('colorpickerChange', function(event) {
  $('.my-colorpicker4 .fa-square').css('color', event.color.toString());
});
  $('.my-colorpicker5').colorpicker()

$('.my-colorpicker5').on('colorpickerChange', function(event) {
  $('.my-colorpicker5 .fa-square').css('color', event.color.toString());
});
  $('.my-colorpicker6').colorpicker()

$('.my-colorpicker6').on('colorpickerChange', function(event) {
  $('.my-colorpicker6 .fa-square').css('color', event.color.toString());
});
  $('.my-colorpicker7').colorpicker()

$('.my-colorpicker7').on('colorpickerChange', function(event) {
  $('.my-colorpicker7 .fa-square').css('color', event.color.toString());
});
  $('.my-colorpicker8').colorpicker()

$('.my-colorpicker8').on('colorpickerChange', function(event) {
  $('.my-colorpicker8 .fa-square').css('color', event.color.toString());
});
  const logoSitio = document.querySelector('#logoSitio');
  const previewLogo = document.querySelector('#preview1');

  logoSitio.addEventListener('change', () => {
    var file = logoSitio.files[0];
    var reader = new FileReader();

    reader.addEventListener('load', () => {
      previewLogo.setAttribute('src', reader.result);
    });

    reader.readAsDataURL(file);
  });

  var input = document.querySelector('#perfil');
  var preview = document.querySelector('#preview2');

  input.addEventListener('change', () => {
    var file = input.files[0];
    var reader = new FileReader();

    reader.addEventListener('load', () => {
      preview.setAttribute('src', reader.result);
    });

    reader.readAsDataURL(file);
  });

  const banner = document.querySelector('#banner');
  const previewBanner = document.querySelector('#previewBanner');

  banner.addEventListener('change', () => {
    var file = banner.files[0];
    var reader = new FileReader();

    reader.addEventListener('load', () => {
      previewBanner.setAttribute('src', reader.result);
    });

    reader.readAsDataURL(file);
  });

</script>

@endsection