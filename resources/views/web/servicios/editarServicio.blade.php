@extends('adminlte::page')
@section('plugins.Sweetalert2', true)

@section('title', 'Intranet | Editar Servicio')

@section('content_header')
    <h1>Editar Servicio</h1>
@stop

@section('content')
    <div class="card-header">
    </div>

    <form id="formularioDeServicio" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre"
                    value="{{ $servicio->nombre }}">
                <div class="invalid-feedback" id="inputValidacionNombre"></div>
            </div>
            <div class="form-group">
                <label for="fechaInicio">Fecha Inicio</label>
                <input type="date" class="form-control" id="fechaInicio" name="fecha_inicio"
                    value="{{ $servicio->fecha_inicio->format('Y-m-d') }}">
                <div class="invalid-feedback" id="inputValidacionFechaInicio"></div>
            </div>
            <div class="form-group">
                <label for="fechaFin">Fecha Fin</label>
                <input type="date" class="form-control" id="fechaFin" name="fecha_fin"
                    value="{{ $servicio->fecha_fin->format('Y-m-d') }}">
                <div class="invalid-feedback" id="inputValidacionFechaFin"></div>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion">{{ $servicio->descripcion }}</textarea>
                <div class="invalid-feedback" id="inputValidacionDescripcion"></div>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                @if ($servicio->foto)
                    <div class="mb-3">
                        <img src="{{ asset($servicio->foto) }}" alt="Foto" class="img-thumbnail"
                            style="width: 150px; height: 150px;">
                    </div>
                    <input type="file" class="form-control-file is-valid" name="foto" id="campoArchivosSubirDocumento"
                        accept=".jpeg,.jpg,.png">
                    <div class="valid-feedback" id="validacionCampoArchivosSubirDocumentoExito" style="display: block;">El
                        archivo es válido</div>
                @else
                    <input type="file" class="form-control-file" name="foto" id="campoArchivosSubirDocumento"
                        accept=".jpeg,.jpg,.png">
                    <div class="invalid-feedback" id="validacionCampoArchivosSubirDocumento"></div>
                    <div class="valid-feedback" id="validacionCampoArchivosSubirDocumentoExito">El archivo es válido</div>
                @endif
            </div>
        </div>

        <div class="card-footer">
            <button type="button" class="btn btn-primary" id="botonDeEditar" onclick="editarServicio()"><i
                    class="fas fa-plus-circle" style="margin-right: 2px;"></i> Editar Servicio</button>
            <a href="{{ route('servicio.index') }}" role="button" class="btn btn-secondary"><i
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
        function validarCampos(data) {
            if (typeof data.responseJSON.errors.nombre !== 'undefined') {
                document.getElementById("nombre").classList.add("is-invalid");
                document.getElementById("inputValidacionNombre").innerHTML = data.responseJSON.errors.nombre;
            } else {
                document.getElementById("nombre").classList.remove("is-invalid");
                document.getElementById("nombre").classList.add("is-valid");
                document.getElementById("inputValidacionNombre").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.fecha_inicio !== 'undefined') {
                document.getElementById("fechaInicio").classList.add("is-invalid");
                document.getElementById("inputValidacionFechaInicio").innerHTML = data.responseJSON.errors.fecha_inicio;
            } else {
                document.getElementById("fechaInicio").classList.remove("is-invalid");
                document.getElementById("fechaInicio").classList.add("is-valid");
                document.getElementById("inputValidacionFechaInicio").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.fecha_fin !== 'undefined') {
                document.getElementById("fechaFin").classList.add("is-invalid");
                document.getElementById("inputValidacionFechaFin").innerHTML = data.responseJSON.errors.fecha_fin;
            } else {
                document.getElementById("fechaFin").classList.remove("is-invalid");
                document.getElementById("fechaFin").classList.add("is-valid");
                document.getElementById("inputValidacionFechaFin").innerHTML = "";
            }

            if (data.responseJSON && data.responseJSON.errors && data.responseJSON.errors.foto) {
                document.getElementById("campoArchivosSubirDocumento").classList.add("is-invalid");
                document.getElementById("validacionCampoArchivosSubirDocumento").innerHTML = data.responseJSON.errors.foto;
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

        function editarServicio() {
            document.getElementById("botonDeEditar");

            const formElement = document.getElementById("formularioDeServicio");
            const formData = new FormData(formElement);

            $.ajax({
                type: 'POST',
                url: '{{ route('servicio.update', ['servicio' => $servicio->id]) }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Modificado!',
                        text: 'El servicio ' + data.nombre + ' se modificó con éxito',
                        confirmButtonColor: "#448aff",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route('servicio.index') }}';
                        }
                    });
                },
                error: function(data) {
                    console.log(data);
                    validarCampos(data);
                },
            });
        }
    </script>
@stop
