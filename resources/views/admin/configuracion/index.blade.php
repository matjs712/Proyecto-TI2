@extends('layouts.admin')
@section('title')
Configuración | {{ $sitio }}
@endsection

@section('content')

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
                                <img id="preview1" width="200" height="200" src="#" alt=" ">
                              </div>
                              <img src="{{ asset($logo) }}" width="200" alt="Logo">
                            </div>
                            <div class="form-group d-flex align-items-center flex-wrap">
                              <div>
                                <label for="logo">Nombre del sitio</label>
                                <input type="text" name="nombreSitio" class="form-control" value="{{ $sitio }}">
                              </div>
                            </div>

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
                            
                            <button type="submit" class="btn btn-primary">Actualizar</button>
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
                                  <img id="preview2" width="200" height="200" src="#" alt=" ">
                                </div>
                                <div class="d-flex justify-content-center m-2">
                                    <img src="{{ asset('users/'.Auth::user()->imagen) }}" width="200" alt="perfil">
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
<script>
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

</script>
@endsection