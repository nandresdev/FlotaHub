@extends('adminlte::page')
@section('plugins.Sweetalert2', true)

@section('title', 'Intranet | Editar Usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    <div class="card-header">
    </div>

    <form id="formularioDeUsuario">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre Completo" name="name"
                    value="{{ $usuario->name }}">
                <div class="invalid-feedback" id="inputValidacionNombre">
                </div>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="example@gmail.com" name="email"
                    value="{{ $usuario->email }}">
                <div class="invalid-feedback" id="inputValidacionEmail">
                </div>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="contraseña" placeholder="Contraseña" name="password">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye-slash" id="eyeIcon1"></i>
                        </button>
                    </div>
                    <div class="invalid-feedback" id="inputValidacionPassword">
                    </div>
                </div>
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
        const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
        const eyeIcon1 = document.getElementById("eyeIcon1");
        const eyeIcon2 = document.getElementById("eyeIcon2");

        togglePassword.addEventListener("click", function() {
            const passwordField = document.getElementById("inputClave");
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
                document.getElementById("nombre").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionNombre").innerHTML = data.responseJSON.errors.name;
            } else {
                document.getElementById("nombre").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionNombre").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.email !== 'undefined') {
                document.getElementById("email").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionEmail").innerHTML = data.responseJSON.errors.email;
            } else {
                document.getElementById("email").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionEmail").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.password !== 'undefined') {
                document.getElementById("contraseña").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionPassword").innerHTML = data.responseJSON.errors.password;
            } else {
                document.getElementById("contraseña").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionPassword").innerHTML = "";
            }
        }

        function editarUsuario() {
            document.getElementById("botonDeEditar").removeAttribute("disabled");
            const datosFormulario = $("#formularioDeUsuario").serialize();
            $.ajax({
                type: 'PUT',
                dataType: 'json',
                url: '{{ route('usuario.update', ['usuario' => $usuario->id]) }}',
                data: datosFormulario,
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
                    console.log(data)
                    validarCampos(data)
                    document.getElementById("botonDeEditar").removeAttribute("disabled");
                }
            });
        }
    </script>
@stop