@extends('adminlte::page')
@section('plugins.Sweetalert2', true)

@section('title', 'Intranet | Editar Ruta')

@section('content_header')
    <h1>Editar Ruta</h1>
@stop

@section('content')
    <div class="card-header">
    </div>
    <form id="formularioDeRuta">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="id_servicio">Servicio</label>
                <select class="form-control" name="id_servicio" id="id_servicio">
                    <option value="">Seleccione Servicio</option>
                    @foreach ($servicios as $servicio)
                        <option value="{{ $servicio->id }}" {{ $servicio->id == $ruta->id_servicio ? 'selected' : '' }}>
                            {{ $servicio->nombre }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback" id="inputValidacionServicio"></div>
            </div>
            <div class="form-group">
                <label for="origen">Ruta de Origen</label>
                <input type="text" class="form-control" id="campoOrigen" name="origen" value="{{ $ruta->origen }}">
                <div class="invalid-feedback" id="inputValidacionOrigen"></div>
            </div>
            <div class="form-group">
                <label for="destino">Ruta de Destino</label>
                <input type="text" class="form-control" id="campoDestino" name="destino" value="{{ $ruta->destino }}">
                <div class="invalid-feedback" id="inputValidacionDestino"></div>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-primary" id="botonDeEditar" onclick="editarRuta()">
                <i class="fas fa-plus-circle" style="margin-right: 2px;"></i> Editar Servicio
            </button>
            <a href="{{ route('ruta.index') }}" role="button" class="btn btn-secondary">
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
        function validarCampos(data) {
            if (data.responseJSON && data.responseJSON.errors) {
                if (data.responseJSON.errors.id_servicio) {
                    $('#id_servicio').addClass('is-invalid');
                    $('#inputValidacionServicio').text(data.responseJSON.errors.id_servicio);
                } else {
                    $('#id_servicio').removeClass('is-invalid').addClass('is-valid');
                    $('#inputValidacionServicio').text('');
                }

                if (data.responseJSON.errors.origen) {
                    $('#campoOrigen').addClass('is-invalid');
                    $('#inputValidacionOrigen').text(data.responseJSON.errors.origen);
                } else {
                    $('#campoOrigen').removeClass('is-invalid').addClass('is-valid');
                    $('#inputValidacionOrigen').text('');
                }

                if (data.responseJSON.errors.destino) {
                    $('#campoDestino').addClass('is-invalid');
                    $('#inputValidacionDestino').text(data.responseJSON.errors.destino);
                } else {
                    $('#campoDestino').removeClass('is-invalid').addClass('is-valid');
                    $('#inputValidacionDestino').text('');
                }
            }
        }

        function editarRuta() {
            document.getElementById("botonDeEditar").setAttribute("disabled", "true");

            const formElement = document.getElementById("formularioDeRuta");
            const formData = new FormData(formElement);

            $.ajax({
                type: 'POST',
                url: '{{ route('ruta.update', ['ruta' => $ruta->id]) }}',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Modificado!',
                        text: 'La ruta se modificó con éxito',
                        confirmButtonColor: "#448aff",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route('ruta.index') }}';
                        }
                    });
                },
                error: function(data) {
                    console.log(data);
                    validarCampos(data);
                    document.getElementById("botonDeEditar").removeAttribute("disabled");
                },
            });
        }
    </script>
@stop
