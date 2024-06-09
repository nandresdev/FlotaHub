@extends('adminlte::page')

@section('title', 'Intranet | Editar Vehiculo')

@section('content_header')
    <h1>Editar Vehiculo</h1>
@stop

@section('content')
    <div class="card-header">
    </div>

    <form id="formularioDeVehiculo">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="tipo_vehiculo">Tipo de Vehículo</label>
                <select class="form-control" id="campoTipoVehiculo" name="tipo_vehiculo">
                    <option value="" {{ old('tipo_vehiculo', $vehiculo) == '' ? 'selected' : '' }}>Selecciona un tipo
                        de vehículo</option>
                    <option value="Automovil" {{ old('tipo_vehiculo', $vehiculo) == 'Automovil' ? 'selected' : '' }}>
                        Automóvil</option>
                    <option value="Motocicleta" {{ old('tipo_vehiculo', $vehiculo) == 'Motocicleta' ? 'selected' : '' }}>
                        Motocicleta</option>
                    <option value="Camioneta" {{ old('tipo_vehiculo', $vehiculo) == 'Camioneta' ? 'selected' : '' }}>
                        Camioneta</option>
                    <option value="Camion" {{ old('tipo_vehiculo', $vehiculo) == 'Camion' ? 'selected' : '' }}>Camión
                    </option>
                    <option value="Autobus" {{ old('tipo_vehiculo', $vehiculo) == 'Autobus' ? 'selected' : '' }}>Autobús
                    </option>
                    <option value="Furgoneta" {{ old('tipo_vehiculo', $vehiculo) == 'Furgoneta' ? 'selected' : '' }}>
                        Furgoneta</option>
                    <option value="Suv" {{ old('tipo_vehiculo', $vehiculo) == 'Suv' ? 'selected' : '' }}>SUV</option>
                </select>
                <div class="invalid-feedback" id="inputValidacionTipoVehiculo">
                </div>
            </div>

            <div class="form-group">
                <label for="patente">Patente</label>
                <input type="text" class="form-control" id="campoPatente" placeholder="Patente" name="patente"
                    value="{{ $vehiculo->patente }}">
                <div class="invalid-feedback" id="inputValidacionPatente">
                </div>
            </div>
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" class="form-control" id="campoMarca" placeholder="Marca" name="marca"
                    value="{{ $vehiculo->marca }}">
                <div class="invalid-feedback" id="inputValidacionMarca">
                </div>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" id="campoModelo" placeholder="Modelo" name="modelo"
                    value="{{ $vehiculo->modelo }}">
                <div class="invalid-feedback" id="inputValidacionModelo">
                </div>
            </div>
            <div class="form-group">
                <label for="combustible">Combustible</label>
                <input type="text" class="form-control" id="campoCombustible" placeholder="Combustible"
                    name="combustible" value="{{ $vehiculo->combustible }}">
                <div class="invalid-feedback" id="inputValidacionCombustible">
                </div>
            </div>
            <div class="form-group">
                <label for="ano">Año</label>
                <input type="text" class="form-control" id="campoAno" placeholder="Año" name="ano"
                    value="{{ $vehiculo->ano }}" onkeypress="return isNumberKey(event)"
                    oninput="validateNumberInput(this)">
                <div class="invalid-feedback" id="inputValidacionAno">
                </div>
            </div>
            <div class="form-group">
                <label for="traccion">Tracción</label>
                <input type="text" class="form-control" id="campoTraccion" placeholder="Tracción" name="traccion"
                    value="{{ $vehiculo->traccion }}">
                <div class="invalid-feedback" id="inputValidacionTraccion">
                </div>
            </div>
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" class="form-control" id="campoColor" placeholder="Color" name="color"
                    value="{{ $vehiculo->color }}">

                <div class="invalid-feedback" id="inputValidacionColor">
                </div>
            </div>
            <div class="form-group">
                <label for="numero_motor">Numero de Motor</label>
                <input type="text" class="form-control" id="campoMotor" placeholder="Numero de Motor" name="numero_motor"
                    value="{{ $vehiculo->numero_motor }}">
                <div class="invalid-feedback" id="inputValidacionNumeroMotor">
                </div>
            </div>
            <div class="form-group">
                <label for="numero_chasis">Numero de Chasis</label>
                <input type="text" class="form-control" id="campoChasis" placeholder="Numero de Chasis"
                    name="numero_chasis" value="{{ $vehiculo->numero_chasis }}">
                <div class="invalid-feedback" id="inputValidacionNumeroChasis">
                </div>
            </div>
            <div class="form-group">
                <label for="kilometraje">Kilometraje</label>
                <input type="text" class="form-control" id="campoKilometraje" placeholder="Kilometraje"
                    name="kilometraje" value="{{ $vehiculo->kilometraje }}" onkeypress="return isNumberKey(event)"
                    oninput="validateNumberInput(this)">
                <div class="invalid-feedback" id="inputValidacionNumeroKilometraje">
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="button" class="btn btn-primary" id="botonDeEditar" onclick="editarVehiculo()"><i
                    class="fas fa-plus-circle" style="margin-right: 2px;"></i> Editar Vehiculo </button>
            <a href="{{ route('vehiculo.index') }}" role="button" class="btn btn-secondary"><i
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
            if (typeof data.responseJSON.errors.tipo_vehiculo !== 'undefined') {
                document.getElementById("campoTipoVehiculo").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionTipoVehiculo").innerHTML = data.responseJSON.errors.tipo_vehiculo;
            } else {
                document.getElementById("campoTipoVehiculo").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionTipoVehiculo").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.patente !== 'undefined') {
                document.getElementById("campoPatente").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionPatente").innerHTML = data.responseJSON.errors.patente;
            } else {
                document.getElementById("campoPatente").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionPatente").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.marca !== 'undefined') {
                document.getElementById("campoMarca").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionMarca").innerHTML = data.responseJSON.errors.marca;
            } else {
                document.getElementById("campoMarca").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionMarca").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.modelo !== 'undefined') {
                document.getElementById("campoModelo").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionModelo").innerHTML = data.responseJSON.errors.modelo;
            } else {
                document.getElementById("campoModelo").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionModelo").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.combustible !== 'undefined') {
                document.getElementById("campoCombustible").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionCombustible").innerHTML = data.responseJSON.errors.combustible;
            } else {
                document.getElementById("campoCombustible").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionCombustible").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.ano !== 'undefined') {
                document.getElementById("campoAno").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionAno").innerHTML = data.responseJSON.errors.ano;
            } else {
                document.getElementById("campoAno").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionAno").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.traccion !== 'undefined') {
                document.getElementById("campoTraccion").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionTraccion").innerHTML = data.responseJSON.errors.traccion;
            } else {
                document.getElementById("campoTraccion").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionTraccion").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.color !== 'undefined') {
                document.getElementById("campoColor").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionColor").innerHTML = data.responseJSON.errors.color;
            } else {
                document.getElementById("campoColor").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionColor").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.numero_motor !== 'undefined') {
                document.getElementById("campoMotor").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionNumeroMotor").innerHTML = data.responseJSON.errors.numero_motor;
            } else {
                document.getElementById("campoMotor").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionNumeroMotor").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.numero_chasis !== 'undefined') {
                document.getElementById("campoChasis").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionNumeroChasis").innerHTML = data.responseJSON.errors.numero_chasis;
            } else {
                document.getElementById("campoChasis").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionNumeroChasis").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.kilometraje !== 'undefined') {
                document.getElementById("campoKilometraje").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionNumeroKilometraje").innerHTML = data.responseJSON.errors
                    .kilometraje;
            } else {
                document.getElementById("campoKilometraje").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionNumeroKilometraje").innerHTML = "";
            }
        }

        function editarVehiculo() {
            document.getElementById("botonDeEditar").removeAttribute("disabled");
            const datosFormulario = $("#formularioDeVehiculo").serialize();
            $.ajax({
                type: 'PUT',
                dataType: 'json',
                url: '{{ route('vehiculo.update', ['vehiculo' => $vehiculo->id]) }}',
                data: datosFormulario,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Modificado!',
                        text: 'El vehiculo ' + data.patente + ' se modificó con éxito',
                        confirmButtonColor: "#448aff",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route('vehiculo.index') }}';
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
