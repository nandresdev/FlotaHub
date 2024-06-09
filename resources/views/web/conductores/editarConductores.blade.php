@extends('adminlte::page')
@section('plugins.Sweetalert2', true)

@section('title', 'Intranet | Editar Conductor')

@section('content_header')
    <h1>Editar Conductor</h1>
@stop

@section('content')
    <div class="card-header">
    </div>

    <form id="formularioDeConductor">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="nombre_completo">Nombre Completo</label>
                <input type="text" class="form-control" id="campoNombreCompleto" placeholder="Nombre Completo"
                    name="nombre_completo" value="{{ $conductor->nombre_completo }}">
                <div class="invalid-feedback" id="inputValidacionNombreCompleto">
                </div>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="campoFechaNacimiento" placeholder="Marca"
                    name="fecha_nacimiento" value="{{ $conductor->fecha_nacimiento }}">
                <div class="invalid-feedback" id="inputValidacionFechaNacimiento">
                </div>
            </div>
            <div class="form-group">
                <label for="modelo">Teléfono</label>
                <input type="text" class="form-control" id="campoTelefono" placeholder="Teléfono" name="telefono"
                    value="{{ $conductor->telefono }}" onkeypress="return isNumberKey(event)"
                    oninput="validateNumberInput(this)">
                <div class="invalid-feedback" id="inputValidacionTelefono">
                </div>
            </div>
            <div class="form-group">
                <label for="modelo">Nacionalidad</label>
                <input type="text" class="form-control" id="campoNacionalidad" placeholder="Nacionalidad"
                    name="nacionalidad" value="{{ $conductor->nacionalidad }}">
                <div class="invalid-feedback" id="inputValidacionNacionalidad">
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="button" class="btn btn-primary" id="botonDeEditar" onclick="editarConductor()"><i
                    class="fas fa-plus-circle" style="margin-right: 2px;"></i> Editar Conductor </button>
            <a href="{{ route('conductor.index') }}" role="button" class="btn btn-secondary"><i
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
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function validateNumberInput(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }

        function validarCampos(data) {
            if (typeof data.responseJSON.errors.nombre_completo !== 'undefined') {
                document.getElementById("campoNombreCompleto").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionNombreCompleto").innerHTML = data.responseJSON.errors
                    .nombre_completo;
            } else {
                document.getElementById("campoNombreCompleto").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionNombreCompleto").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.fecha_nacimiento !== 'undefined') {
                document.getElementById("campoFechaNacimiento").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionFechaNacimiento").innerHTML = data.responseJSON.errors
                    .fecha_nacimiento;
            } else {
                document.getElementById("campoFechaNacimiento").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionFechaNacimiento").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.telefono !== 'undefined') {
                document.getElementById("campoTelefono").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionTelefono").innerHTML = data.responseJSON.errors.telefono;
            } else {
                document.getElementById("campoTelefono").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionTelefono").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.nacionalidad !== 'undefined') {
                document.getElementById("campoNacionalidad").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionNacionalidad").innerHTML = data.responseJSON.errors.nacionalidad;
            } else {
                document.getElementById("campoNacionalidad").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionNacionalidad").innerHTML = "";
            }
        }

        function editarConductor() {
            document.getElementById("botonDeEditar").removeAttribute("disabled");
            const datosFormulario = $("#formularioDeConductor").serialize();
            $.ajax({
                type: 'PUT',
                dataType: 'json',
                url: '{{ route('conductor.update', ['conductor' => $conductor->id]) }}',
                data: datosFormulario,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Modificado!',
                        text: 'El conductor ' + data.nombre_completo + ' se modificó con éxito',
                        confirmButtonColor: "#448aff",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route('conductor.index') }}';
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
