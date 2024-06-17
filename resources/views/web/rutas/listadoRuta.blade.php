@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('title', 'Intranet | Registros De Rutas')

@section('content_header')
    <h1>Listado de Rutas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <button class="btn btn-success" data-toggle="modal" data-target="#nuevaRutaModal">
                    Nueva ruta
                </button>
            </div>
            <div class="table-responsive" id="scroll-footer-table" style="margin-bottom: 20px;">
                <table class="table table-striped projects" id="datatableRuta">
                    <thead class="bg-dark">
                        <tr>
                            <th>SERVICIO</th>
                            <th>ORIGEN</th>
                            <th>DESTINO</th>
                            <th></th>
                        </tr>
                        <tr class="filters">
                            <th>
                                <select class="form-control" id="filterServicio">
                                    <option value="">Seleccione Servicio</option>
                                    @foreach ($servicios as $servicio)
                                        <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th><input type="text" class="form-control" placeholder="Origen" /></th>
                            <th><input type="text" class="form-control" placeholder="Destino" /></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rutas as $ruta)
                            <tr>
                                <td>{{ $ruta->servicios->nombre }}</td>
                                <td>{{ $ruta->origen }}</td>
                                <td>{{ $ruta->destino }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('ruta.edit', $ruta->id) }}" class="btn btn-default btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-default btn-sm"
                                            onclick="confirmarEliminacionRuta('{{ $ruta->id }}')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal de Editar -->
                            <div class="modal fade" id="editarRutaModal" tabindex="-1" role="dialog"
                                aria-labelledby="rutaModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form id="formularioDeEditarRuta">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="nombre">Servicio</label>
                                                    <select class="form-control" name="id_servicio"
                                                        id="campoServiciosEditar">
                                                        <option value="">Seleccione Servicio</option>
                                                        @foreach ($servicios as $servicio)
                                                            <option value="{{ $servicio->id }}">{{ $servicio->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback" id="inputValidacionServiciosEditar"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="origen">Ruta de Origen</label>
                                                    <input type="text" class="form-control" id="campoOrigenEditar"
                                                        name="origen" value="">
                                                    <div class="invalid-feedback" id="inputValidacionOrigenEditar"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="destino">Ruta de Destino</label>
                                                    <input type="text" class="form-control" id="campoDestinoEditar"
                                                        name="destino" value="">
                                                    <div class="invalid-feedback" id="inputValidacionDestinoEditar"></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" id="botonDeEdicion"
                                                    onclick="editarRuta()">
                                                    <i class="fas fa-save" style="margin-right: 2px;"></i> Editar Ruta
                                                </button>
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Modal de Registro -->
            <div class="modal fade" id="nuevaRutaModal" tabindex="-1" role="dialog" aria-labelledby="rutaModal"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="formularioDeRuta">
                        @csrf
                        <div class="modal-content">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nombre">Servicio</label>
                                    <select class="form-control" name="id_servicio" id="campoServicios">
                                        <option value="">Seleccione Servicio</option>
                                        @foreach ($servicios as $servicio)
                                            <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="inputValidacionServicios"></div>
                                </div>
                                <div class="form-group">
                                    <label for="origen">Ruta de Origen</label>
                                    <input type="text" class="form-control" id="campoOrigen" name="origen"
                                        value="{{ old('origen') }}">
                                    <div class="invalid-feedback" id="inputValidacionOrigen"></div>
                                </div>
                                <div class="form-group">
                                    <label for="destino">Ruta de Destino</label>
                                    <input type="text" class="form-control" id="campoDestino" name="destino"
                                        value="{{ old('destino') }}">
                                    <div class="invalid-feedback" id="inputValidacionDestino"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="botonDeCreacion"
                                    onclick="registrarRuta()"><i class="fas fa-plus-circle"
                                        style="margin-right: 2px;"></i>
                                    Registrar Ruta</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
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
        $(document).ready(function() {
            const datatable = $("#datatableRuta").DataTable({
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Todos"],
                ],
                language: {
                    processing: "Traitement en cours...",
                    search: "Buscar",
                    lengthMenu: "Mostrar _MENU_ Registros",
                    info: "Mostrar desde _START_ hasta _END_ de _TOTAL_ registros",
                    infoEmpty: "Opción no disponible",
                    infoFiltered: "",
                    infoPostFix: "",
                    loadingRecords: "Cargando registros.",
                    zeroRecords: "No hay datos disponibles en la tabla",
                    emptyTable: "No hay datos disponibles en la tabla",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Último",
                    },
                },
                initComplete: function() {
                    this.api().columns().every(function() {
                        const column = this;
                        $('input', this.header()).on('keyup change', function() {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                    });
                }
            });
        });

        function validarCampos(data) {
            if (typeof data.responseJSON.errors.id_servicio !== 'undefined') {
                document.getElementById("campoServicios").classList.add("is-invalid");
                document.getElementById("inputValidacionServicios").innerHTML = data.responseJSON.errors.id_servicio;
            } else {
                document.getElementById("campoServicios").classList.remove("is-invalid");
                document.getElementById("campoServicios").classList.add("is-valid");
                document.getElementById("inputValidacionServicios").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.origen !== 'undefined') {
                document.getElementById("campoOrigen").classList.add("is-invalid");
                document.getElementById("inputValidacionOrigen").innerHTML = data.responseJSON.errors.origen;
            } else {
                document.getElementById("campoOrigen").classList.remove("is-invalid");
                document.getElementById("campoOrigen").classList.add("is-valid");
                document.getElementById("inputValidacionOrigen").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.destino !== 'undefined') {
                document.getElementById("campoDestino").classList.add("is-invalid");
                document.getElementById("inputValidacionDestino").innerHTML = data.responseJSON.errors.destino;
            } else {
                document.getElementById("campoDestino").classList.remove("is-invalid");
                document.getElementById("campoDestino").classList.add("is-valid");
                document.getElementById("inputValidacionDestino").innerHTML = "";
            }

        }

        function registrarRuta() {
            document.getElementById("botonDeCreacion").setAttribute("disabled", "true");
            const formElement = document.getElementById("formularioDeRuta");
            const formData = new FormData(formElement);

            $.ajax({
                type: 'POST',
                url: '{{ route('ruta.store') }}',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Creado!',
                        text: 'La ruta se creó con éxito',
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
                    document.getElementById("botonDeCreacion").removeAttribute("disabled");
                }
            });
        }

        function confirmarEliminacionRuta(idRuta) {
            Swal.fire({
                title: '¿Está seguro?',
                text: "Esta ruta se eliminará definitivamente de la plataforma",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarRuta(idRuta);
                }
            })
        }

        function eliminarRuta(idRuta) {
            let url = '{{ route('ruta.destroy', [':idRuta']) }}';
            url = url.replace(':idRuta', idRuta);
            const csrf = '{{ csrf_token() }}';

            $.ajax({
                type: 'DELETE',
                datatype: 'json',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                success: function(data) {
                    if (data.estado === "eliminado") {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Eliminado!',
                            text: 'La ruta se eliminó con éxito',
                            confirmButtonColor: "#448aff",
                            confirmButtonText: "Confirmar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route('ruta.index') }}';
                            }
                        });
                    }
                },
                error: function(data) {}
            })
        }
    </script>
@stop
