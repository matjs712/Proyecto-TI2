@extends('layouts.admin')
@section('title')
    Perfil | {{ $sitio }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex aling-items-center flex-wrap">
            <h4>Perfil</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                            role="tab" aria-controls="v-pills-home" aria-selected="true">General</a>
                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                            role="tab" aria-controls="v-pills-profile" aria-selected="false">Credenciales</a>
                        {{-- <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"></a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a> --}}
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <form action="{{ url('update-perfil-general/' . Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group d-flex align-items-center flex-wrap">
                                    <div class="form-group d-flex align-items-center flex-wrap">
                                        <div class="mr-2">
                                            <label for="perfil">Foto de perfil</label>
                                            <input type="file" id="perfil" name="perfil" class="form-control">
                                            <img id="preview2" width="200" height="200" src="#" alt=" ">
                                        </div>
                                        <div class="d-flex justify-content-center m-2">
                                            <img src="{{ Storage::url('users/' . Auth::user()->imagen) }}" width="200"
                                                alt="perfil">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center flex-wrap">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nombre" class="form-control"
                                        value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group d-flex align-items-center flex-wrap">
                                    <label for="correo">Correo</label>
                                    <input type="text" name="correo" class="form-control"
                                        value="{{ Auth::user()->email }}">
                                </div>
                                <div class="form-group d-flex align-items-center flex-wrap">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" name="telefono" class="form-control"
                                        value="{{ Auth::user()->telefono }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            <form action="{{ url('update-credenciales-perfil/' . Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
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
