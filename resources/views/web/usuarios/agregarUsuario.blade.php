@extends('adminlte::page')
@section('plugins.Sweetalert2', true)

@section('title', 'Intranet | Agregar Usuario')

@section('content_header')
    <h1>Agregar Usuario</h1>
@stop

@section('content')
    <div class="card-header">
    </div>

    <form id="formularioDeUsuario" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre Completo</label>
                <input type="name" class="form-control" id="nombre" placeholder="Nombre Completo" name="name"
                    value="{{ old('name') }}">
                <div class="invalid-feedback" id="inputValidacionNombre">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="example@gmail.com" name="email"
                    value="{{ old('email') }}">
                <div class="invalid-feedback" id="inputValidacionEmail">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="contraseña" placeholder="Contraseña" name="password"
                        value="{{ old('password') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye-slash" id="eyeIcon1"></i>
                        </button>
                    </div>
                    <div class="invalid-feedback" id="inputValidacionPassword">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputCargo">Cargo</label>
                <div class="invalid-feedback" id="inputValidacionEmail">
                </div>
            </div>
            <div class="form-group">
                <label for="foto_perfil">Foto Perfil</label>
                <input type="file" class="form-control-file" name="foto_perfil" id="campoArchivosSubirDocumento"
                    accept=".jpeg,.jpg,.png">
                <div class="invalid-feedback" id="validacionCampoArchivosSubirDocumento"></div>
                <div class="valid-feedback" id="validacionCampoArchivosSubirDocumentoExito">El archivo es válido</div>
            </div>
        </div>

        <div class="card-footer">
            <button type="button" class="btn btn-primary" id="botonDeCreacion" onclick="registrarUsuario()"><i
                    class="fas fa-plus-circle" style="margin-right: 2px;"></i> Registrar Usuario </button>
            <a href="{{ route('usuario.index') }}" role="button" class="btn btn-secondary"><i
                    class="fas fa-arrow-alt-circle-left" style="margin-right: 2px;"></i> Volver</a>
        </div>
    </form>
@stop

@section('footer')
    <div class="float-right d-none d-sm-inline">
        Intranet
    </div>
    <strong>Copyright © <a class="text-primary">nandresdev</a>.</strong>
@stop

@section('css')

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
           const togglePassword = document.getElementById("togglePassword");
        const cambiarPassword = document.getElementById("cambiarPassword");
        const passwordField = document.getElementById("contraseña");
        const eyeIcon1 = document.getElementById("eyeIcon1");

        togglePassword.addEventListener("click", function() {
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon1.classList.remove("fa-eye-slash");
                eyeIcon1.classList.add("fa-eye");
            } else {
                passwordField.type = "password";
                eyeIcon1.classList.remove("fa-eye");
                eyeIcon1.classList.add("fa-eye-slash");
            }
        });

        function validarCampos(data) {
            if (typeof data.responseJSON.errors.name !== 'undefined') {
                document.getElementById("nombre").classList.add("is-invalid");
                document.getElementById("inputValidacionNombre").innerHTML = data.responseJSON.errors.name;
            } else {
                document.getElementById("nombre").classList.remove("is-invalid");
                document.getElementById("nombre").classList.add("is-valid");
                document.getElementById("inputValidacionNombre").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.email !== 'undefined') {
                document.getElementById("email").classList.add("is-invalid");
                document.getElementById("inputValidacionEmail").innerHTML = data.responseJSON.errors.email;
            } else {
                document.getElementById("email").classList.remove("is-invalid");
                document.getElementById("email").classList.add("is-valid");
                document.getElementById("inputValidacionEmail").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.password !== 'undefined') {
                document.getElementById("contraseña").classList.add("is-invalid");
                document.getElementById("inputValidacionPassword").innerHTML = data.responseJSON.errors.password;
            } else {
                document.getElementById("contraseña").classList.remove("is-invalid");
                document.getElementById("contraseña").classList.add("is-valid");
                document.getElementById("inputValidacionPassword").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.foto_perfil !== 'undefined') {
                document.getElementById("campoArchivosSubirDocumento").classList.add("is-invalid");
                document.getElementById("validacionCampoArchivosSubirDocumento").innerHTML = data.responseJSON.errors
                    .foto_perfil;
                document.getElementById("validacionCampoArchivosSubirDocumento").style.display = "block";
                document.getElementById("validacionCampoArchivosSubirDocumentoExito").style.display = "none";
            } else {
                document.getElementById("campoArchivosSubirDocumento").classList.remove("is-invalid");
                document.getElementById("campoArchivosSubirDocumento").classList.add("is-valid");
                document.getElementById("validacionCampoArchivosSubirDocumento").innerHTML = "";
                document.getElementById("validacionCampoArchivosSubirDocumento").style.display = "none";
                document.getElementById("validacionCampoArchivosSubirDocumentoExito").style.display = "block";
            }
        }

        function registrarUsuario() {
            document.getElementById("botonDeCreacion").setAttribute("disabled", "disabled");

            const formElement = document.getElementById("formularioDeUsuario");
            const formData = new FormData(formElement);

            $.ajax({
                type: 'POST',
                url: '{{ route('usuario.store') }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Creado!',
                        text: 'El usuario ' + data.name + ' se creó con éxito',
                        confirmButtonColor: "#448aff",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route('usuario.index') }}';
                        }
                    });
                },
                error: function(data) {
                    validarCampos(data);
                    document.getElementById("botonDeCreacion").removeAttribute("disabled");
                }
            });
        }
    </script>
@stop
