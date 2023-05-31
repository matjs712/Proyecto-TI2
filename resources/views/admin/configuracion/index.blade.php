@extends('layouts.admin')
@section('title')
    Configuración | {{ $sitio }}
@endsection

@section('content')
    <div class="card hide2">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap">
            <h2 style="flex:1;">Configuración</h2>
            <div>
                <h6 class="mb-0 d-flex align-items-center justify-content-end">
                    <a href="{{ url('dashboard') }}" class="mr-2">Inicio</a> /
                    <a href="{{ url('configuracion') }}" class="ml-2">Configuración</a>
                </h6>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                            role="tab" aria-controls="v-pills-home" aria-selected="true">General</a>
                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                            role="tab" aria-controls="v-pills-profile" aria-selected="false">Administrador</a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <form action="{{ url('update-general') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group d-flex align-items-center flex-wrap">
                                            <label for="logo">Logo del sitio</label>
                                            <input type="file" id="logoSitio" name="logo" class="form-control">
                                            <img id="preview1" style="width:100%; height:auto !important"
                                                src="{{ asset($logo) }}" alt=" ">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group d-flex align-items-center flex-wrap">
                                            <label for="logo">Nombre del sitio</label>
                                            <input type="text" name="nombreSitio" class="form-control"
                                                value="{{ $sitio }}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h4 for="secciones">Secciones</h4>
                                <div class="form-group d-flex align-items-center flex-wrap">
                                    <div class="row" style="width: 100% !important;">
                                        <div class="md-col-6" style="flex: 1">
                                            <div>
                                                <input type="checkbox" id="productos" name="productos"
                                                    {{ $productos ? 'checked' : '' }} value="productos">
                                                <label for="productos">Productos</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="tecetas" name="recetas"
                                                    {{ $recetas ? 'checked' : '' }} value="recetas">
                                                <label for="recetas">Recetas</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="categorias" name="categorias"
                                                    {{ $categorias ? 'checked' : '' }} value="categorias">
                                                <label for="categorias">Categorías</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="ingredientes" name="ingredientes"
                                                    {{ $ingredientes ? 'checked' : '' }} value="ingredientes">
                                                <label for="ingredientes">Ingredientes</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="proveedores" name="proveedores"
                                                    {{ $proveedores ? 'checked' : '' }} value="proveedores">
                                                <label for="proveedores">Proveedores</label>
                                            </div>
                                        </div>
                                        <div class="md-col-6" style="flex: 1">
                                            <div>
                                                <input type="checkbox" id="registros" name="registros"
                                                    {{ $registros ? 'checked' : '' }} value="registros">
                                                <label for="registros">Registros</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="ordenes" name="ordenes"
                                                    {{ $ordenes ? 'checked' : '' }} value="ordenes">
                                                <label for="ordenes">Ordenes</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="usuarios" name="usuarios"
                                                    {{ $usuarios ? 'checked' : '' }} value="usuarios">
                                                <label for="usuarios">Usuarios</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="roles_permisos" name="roles_permisos"
                                                    {{ $roles_permisos ? 'checked' : '' }} value="roles_permisos">
                                                <label for="roles_permisos">Roles & permisos</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h4>Colores del sitio web</h4>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color de fondo del menu en el inicio de los clientes">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Principal: </label>
                                        <div class="input-group mb-3 my-colorpicker1">
                                            <input type="text" name="color_principal"
                                                value={{ asset($color_principal) }} class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($color_principal) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color de los precios, boton 'Elige tu producto' en el inicio">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Secundario: </label>
                                        <div class="input-group mb-3 my-colorpicker2">
                                            <input type="text" name="color_secundario"
                                                value={{ asset($color_secundario) }} class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($color_secundario) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color de fondo de la barra de busqueda en las vistas de los clientes">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Barra de busqueda: </label>
                                        <div class="input-group mb-3 my-colorpicker8">
                                            <input type="text" name="color_barra_busqueda"
                                                value={{ asset($color_barra_busqueda) }} class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($color_barra_busqueda) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>


                                <h4>Colores botones</h4>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Boton carrito, trending, comprar ahora">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Principal: </label>
                                        <div class="input-group mb-3 my-colorpicker9">
                                            <input type="text" name="boton_principal_busqueda"
                                                value={{ asset($boton_principal_busqueda) }} class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($boton_principal_busqueda) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color del boton de 'calificar' en las vistas del cliente">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Calificación: </label>
                                        <div class="input-group mb-3 my-colorpicker10">
                                            <input type="text" name="boton_calificacion"
                                                value={{ asset($boton_calificacion) }} class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($boton_calificacion) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color del boton de 'añadir review' en las vistas del cliente">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Review: </label>
                                        <div class="input-group mb-3 my-colorpicker11">
                                            <input type="text" name="boton_review" value={{ asset($boton_review) }}
                                                class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($boton_review) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color del boton de añadir a la lista magica o 'wishlist' en las vistas del cliente">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Wishlist: </label>
                                        <div class="input-group mb-3 my-colorpicker12">
                                            <input type="text" name="boton_lista" value={{ asset($boton_lista) }}
                                                class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($boton_lista) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color del boton de añadir al carrito, vista de clientes">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Carrito: </label>
                                        <div class="input-group mb-3 my-colorpicker13">
                                            <input type="text" name="boton_carrito" value={{ asset($boton_carrito) }}
                                                class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($boton_carrito) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color del boton de 'añadir' en las tablas">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Nuevo: </label>
                                        <div class="input-group mb-3 my-colorpicker14">
                                            <input type="text" name="boton_nuevo" value={{ asset($boton_nuevo) }}
                                                class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($boton_nuevo) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color del boton de 'editar' en las tablas">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Editar: </label>
                                        <div class="input-group mb-3 my-colorpicker15">
                                            <input type="text" name="boton_editar" value={{ asset($boton_editar) }}
                                                class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($boton_editar) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color del boton de 'eliminar' en las tablas">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Borrar: </label>
                                        <div class="input-group mb-3 my-colorpicker16">
                                            <input type="text" name="boton_eliminar"
                                                value={{ asset($boton_eliminar) }} class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($boton_eliminar) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color del boton 'ver más' en las tablas">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Ver más: </label>
                                        <div class="input-group mb-3 my-colorpicker17">
                                            <input type="text" name="boton_vermas" value={{ asset($boton_vermas) }}
                                                class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($boton_vermas) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color del boton actualizar (al fondo de esta pagina)">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Actualizar: </label>
                                        <div class="input-group mb-3 my-colorpicker18">
                                            <input type="text" name="boton_actualizar"
                                                value={{ asset($boton_actualizar) }} class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($boton_actualizar) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <h4>Colores del panel de administración</h4>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color de fondo del menu lateral">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Menu lateral: </label>
                                        <div class="input-group mb-3 my-colorpicker3">
                                            <input type="text" name="color_barra_lateral"
                                                value={{ asset($color_barra_lateral) }} class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($color_barra_lateral) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color de fondo del panel de administración">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Fondo: </label>
                                        <div class="input-group mb-3 my-colorpicker4">
                                            <input type="text" name="color_fondo_admin"
                                                value={{ asset($color_fondo_admin) }} class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($color_fondo_admin) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color de fondo del menu superior (horizontal)">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Barra horizontal: </label>
                                        <div class="input-group mb-3 my-colorpicker5">
                                            <input type="text" name="color_barra_horizontal"
                                                value={{ asset($color_barra_horizontal) }} class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($color_barra_horizontal) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color de las letras de la barra del menu de la izquierda">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Letra menu lateral: </label>
                                        <div class="input-group mb-3 my-colorpicker6">
                                            <input type="text" name="color_a_tag_sidebar"
                                                value={{ asset($color_a_tag_sidebar) }} class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($color_a_tag_sidebar) }}"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><button type="button" class="btn p-2" style="border:none"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Color de las letras del menu lateral cuando se posa el mouse sobre ellas">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            </button>Letra bajo mouse: </label>
                                        <div class="input-group mb-3 my-colorpicker7">
                                            <input type="text" name="color_a_tag_hover"
                                                value={{ asset($color_a_tag_hover) }} class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        style="color:{{ asset($color_a_tag_hover) }}"></i></span>
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
                                        <img id="previewBanner" width="200" height="200"
                                            src="{{ asset($banner) }}" alt=" ">
                                    </div>
                                </div>
                                <br>

                                <button onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                    style="background-color: {{ $boton_actualizar }}; color:white;" type="submit"
                                    class="mt-4 btn">Actualizar</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            <form action="{{ url('update-admin') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group d-flex align-items-center flex-wrap">
                                    <div class="mr-2">
                                        <label for="perfil">Foto de perfil</label>
                                        <input type="file" id="perfil" name="perfil" class="form-control">
                                        <img id="preview2" width="200" height="200"
                                            src="{{ Storage::url('users/' . Auth::user()->imagen) }}" alt=" ">
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
                                <button onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                    style="background-color: {{ $boton_actualizar }}; color:white;" type="submit"
                                    class="btn">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script src="{{ asset('admin/dist/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
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


        $('.my-colorpicker9').colorpicker()
        $('.my-colorpicker9').on('colorpickerChange', function(event) {
            $('.my-colorpicker9 .fa-square').css('color', event.color.toString());
        });

        $('.my-colorpicker10').colorpicker()
        $('.my-colorpicker10').on('colorpickerChange', function(event) {
            $('.my-colorpicker10 .fa-square').css('color', event.color.toString());
        });

        $('.my-colorpicker11').colorpicker()
        $('.my-colorpicker11').on('colorpickerChange', function(event) {
            $('.my-colorpicker11 .fa-square').css('color', event.color.toString());
        });

        $('.my-colorpicker12').colorpicker()
        $('.my-colorpicker12').on('colorpickerChange', function(event) {
            $('.my-colorpicker12 .fa-square').css('color', event.color.toString());
        });

        $('.my-colorpicker13').colorpicker()
        $('.my-colorpicker13').on('colorpickerChange', function(event) {
            $('.my-colorpicker13 .fa-square').css('color', event.color.toString());
        });

        $('.my-colorpicker14').colorpicker()
        $('.my-colorpicker14').on('colorpickerChange', function(event) {
            $('.my-colorpicker14 .fa-square').css('color', event.color.toString());
        });

        $('.my-colorpicker15').colorpicker()
        $('.my-colorpicker15').on('colorpickerChange', function(event) {
            $('.my-colorpicker15 .fa-square').css('color', event.color.toString());
        });

        $('.my-colorpicker16').colorpicker()
        $('.my-colorpicker16').on('colorpickerChange', function(event) {
            $('.my-colorpicker16 .fa-square').css('color', event.color.toString());
        });

        $('.my-colorpicker18').colorpicker()
        $('.my-colorpicker18').on('colorpickerChange', function(event) {
            $('.my-colorpicker18 .fa-square').css('color', event.color.toString());
        });

        $('.my-colorpicker17').colorpicker()
        $('.my-colorpicker17').on('colorpickerChange', function(event) {
            $('.my-colorpicker17 .fa-square').css('color', event.color.toString());
        });

        const input = document.querySelector('#logoSitio');
        const preview = document.querySelector('#preview1');
        input.addEventListener('change', () => {
            const file = input.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', () => {
                preview.setAttribute('src', reader.result);
            });
            reader.readAsDataURL(file);
        });

        const input1 = document.querySelector('#perfil');
        const preview1 = document.querySelector('#preview2');

        input1.addEventListener('change', () => {
            const file = input1.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', () => {
                preview1.setAttribute('src', reader.result);
            });
            reader.readAsDataURL(file);
        });

        const input2 = document.querySelector('#banner');
        const preview2 = document.querySelector('#previewBanner');

        input2.addEventListener('change', () => {
            const file = input2.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', () => {
                preview2.setAttribute('src', reader.result);
            });
            reader.readAsDataURL(file);
        });
    </script>
@endsection
