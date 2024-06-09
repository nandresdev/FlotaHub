@extends('adminlte::page')
@section('plugins.Sweetalert2', true)

@section('title', 'Intranet | Agregar Usuario')

@section('content_header')
    <h1>Agregar Usuario</h1>
@stop

@section('content')
    <div class="card-header">
    </div>

    <form id="formularioDeUsuario">
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

        function registrarUsuario() {
            document.getElementById("botonDeCreacion").removeAttribute("disabled");
            const datosFormulario = $("#formularioDeUsuario").serialize();
            $.ajax({
                type: 'POST',
                datatype: 'json',
                url: '{{ route('usuario.store') }}',
                data: datosFormulario,
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
                    console.log(data)
                    validarCampos(data)
                    document.getElementById("botonDeCreacion").removeAttribute("disabled");

                }
            })
        }
    </script>
@stop
