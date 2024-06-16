@extends('adminlte::page')
@section('plugins.Sweetalert2', true)

@section('title', 'Intranet | Editar Usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    <div class="card-header">
    </div>

    <form id="formularioDeUsuario" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre Completo" name="name"
                    value="{{ $usuario->name }}">
                <div class="invalid-feedback" id="inputValidacionNombre"></div>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="example@gmail.com" name="email"
                    value="{{ $usuario->email }}">
                <div class="invalid-feedback" id="inputValidacionEmail"></div>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="contraseña" placeholder="Contraseña" name="password"
                        value="{{ $usuario->password }}" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye-slash" id="eyeIcon1"></i>
                        </button>
                        <button class="btn btn-outline-secondary" type="button" id="cambiarPassword">Cambiar</button>
                    </div>
                    <div class="invalid-feedback" id="inputValidacionPassword"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="cargo">Cargo</label>
                <input type="text" class="form-control" id="cargo" name="cargo" value="{{ $usuario->cargo }}">
                <div class="invalid-feedback" id="inputValidacionCargo"></div>
            </div>
            <div class="form-group">
                <label for="foto_perfil">Foto Perfil</label>
                @if ($usuario->foto_perfil)
                    <div class="mb-3">
                        <img src="{{ asset($usuario->foto_perfil) }}" alt="Foto de Perfil" class="img-thumbnail"
                            style="width: 150px; height: 150px;">
                    </div>
                    <input type="file" class="form-control-file is-valid" name="foto_perfil"
                        id="campoArchivosSubirDocumento" accept=".jpeg,.jpg,.png">
                    <div class="valid-feedback" id="validacionCampoArchivosSubirDocumentoExito" style="display: block;">El
                        archivo es válido</div>
                @else
                    <input type="file" class="form-control-file" name="foto_perfil" id="campoArchivosSubirDocumento"
                        accept=".jpeg,.jpg,.png">
                    <div class="invalid-feedback" id="validacionCampoArchivosSubirDocumento"></div>
                    <div class="valid-feedback" id="validacionCampoArchivosSubirDocumentoExito">El archivo es válido</div>
                @endif
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <div>
                    <label class="radio-inline">
                        <input type="radio" name="estado" value="OPERATIVO"
                            {{ $usuario->estado == 'OPERATIVO' ? 'checked' : '' }}>
                        <span class="badge badge-success">OPERATIVO</span>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="estado" value="DESACTIVADO"
                            {{ $usuario->estado == 'DESACTIVADO' ? 'checked' : '' }}>
                        <span class="badge badge-danger">DESACTIVADO</span>
                    </label>
                </div>
                <div class="invalid-feedback" id="inputValidacionEstado"></div>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-primary" id="botonDeEditar" onclick="editarUsuario()">
                <i class="fas fa-plus-circle" style="margin-right: 2px;"></i> Editar Usuario
            </button>
            <a href="{{ route('usuario.index') }}" role="button" class="btn btn-secondary">
                <i class="fas fa-arrow-alt-circle-left" style="margin-right: 2px;"></i> Volver
            </a>
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

        cambiarPassword.addEventListener("click", function() {
            passwordField.readOnly = false;
            passwordField.value = "";
            passwordField.focus();
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

            if (typeof data.responseJSON.errors.estado !== 'undefined') {
                document.getElementById("inputValidacionEstado").innerHTML = data.responseJSON.errors.estado;
            } else {
                document.getElementById("inputValidacionEstado").innerHTML = "";
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

        function editarUsuario() {
            document.getElementById("botonDeEditar").setAttribute("disabled", "disabled");

            const formElement = document.getElementById("formularioDeUsuario");
            const formData = new FormData(formElement);

            $.ajax({
                type: 'POST',
                url: '{{ route('usuario.update', ['usuario' => $usuario->id]) }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Modificado!',
                        text: 'El usuario ' + data.name + ' se modificó con éxito',
                        confirmButtonColor: "#448aff",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route('usuario.index') }}';
                        }
                    });
                },
                error: function(data) {
                    console.log(data);
                    validarCampos(data);
                    document.getElementById("botonDeEditar").removeAttribute("disabled");
                }
            });
        }
    </script>
@stop
