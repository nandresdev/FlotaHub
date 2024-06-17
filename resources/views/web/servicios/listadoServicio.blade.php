@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('title', 'Intranet | Registros De Servicios')

@section('content_header')
    <h1>Listado de Servicios</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <button class="btn btn-success" data-toggle="modal" data-target="#nuevoServicioModal">
                    Nuevo Servicio
                </button>
            </div>
            <div class="table-responsive" id="scroll-footer-table" style="margin-bottom: 20px;">
                <table class="table table-striped projects" id="datatableServicio">
                    <thead class="bg-dark">
                        <tr>
                            <th></th>
                            <th>NOMBRE</th>
                            <th>FECHA INICIO</th>
                            <th>FECHA FIN</th>
                            <th>ESTADO</th>
                            <th></th>
                        </tr>
                        <tr class="filters">
                            <th></th>
                            <th><input type="text" class="form-control" placeholder="Nombre" /></th>
                            <th><input type="date" class="form-control" /></th>
                            <th><input type="date" class="form-control" /></th>
                            <th>
                                <select class="form-control">
                                    <option value="">Seleccione Estado</option>
                                    <option value="OPERATIVO">OPERATIVO</option>
                                    <option value="DESACTIVADO">DESACTIVADO</option>
                                </select>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servicios as $servicio)
                            <tr>
                                <td>
                                    <img src="{{ $servicio->foto ? asset($servicio->foto) : asset('img/logo_empresa.png') }}"
                                        alt="Foto de Perfil" class="img-thumbnail" style="width: 130px; height: 130px;">
                                </td>
                                <td>{{ $servicio->nombre }}</td>
                                <td>{{ \Carbon\Carbon::parse($servicio->fecha_inicio)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($servicio->fecha_fin)->format('d/m/Y') }}</td>
                                <td>
                                    @if (\Carbon\Carbon::now()->lt(\Carbon\Carbon::parse($servicio->fecha_fin)))
                                        <span class="badge badge-success">DISPONIBLE</span>
                                    @else
                                        <span class="badge badge-danger">NO DISPONIBLE</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                                id="dropdownMenuButton{{ $servicio->id }}" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Opciones
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('servicio.edit', $servicio->id) }}">
                                                    <i class="fas fa-edit"></i> Editar Servicio
                                                </a>
                                                <a class="dropdown-item" href="#"
                                                    onclick="confirmarEliminacionDelServicio('{{ $servicio->id }}')">
                                                    <i class="fas fa-trash-alt"></i> Eliminar Servicio
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('servicio.obtenerConductores', $servicio->id) }}">
                                                    <i class="fas fa-user"></i> Ver Conductores
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('servicio.obtenerVehiculos', $servicio->id) }}">
                                                    <i class="fas fa-car"></i> Ver Vehículos
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('servicio.obtenerVehiculos', $servicio->id) }}">
                                                    <i class="fas fa-arrow-right"></i> Ver Rutas
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Modal de Registro -->
            <div class="modal fade" id="nuevoServicioModal" tabindex="-1" role="dialog" aria-labelledby="servicioModal"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="formularioDeServicio" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" placeholder="Nombre Servicio"
                                        name="nombre" value="{{ old('nombre') }}">
                                    <div class="invalid-feedback" id="inputValidacionNombre"></div>
                                </div>
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="campoFechaInicio" name="fecha_inicio"
                                        value="{{ old('fecha_inicio') }}">
                                    <div class="invalid-feedback" id="inputValidacionFechaInicio"></div>
                                </div>
                                <div class="form-group">
                                    <label for="fecha_fin">Fecha Fin</label>
                                    <input type="date" class="form-control" id="campoFechaFin" name="fecha_fin"
                                        value="{{ old('fecha_fin') }}">
                                    <div class="invalid-feedback" id="inputValidacionFechaFin"></div>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control-file" name="foto"
                                        id="campoArchivosSubirDocumento" accept=".jpeg,.jpg,.png">
                                    <div class="invalid-feedback" id="validacionCampoArchivosSubirDocumento"></div>
                                    <div class="valid-feedback" id="validacionCampoArchivosSubirDocumentoExito">El archivo
                                        es válido</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="botonDeCreacion"
                                    onclick="registrarServicio()"><i class="fas fa-plus-circle"
                                        style="margin-right: 2px;"></i> Registrar Servicio </button>
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
            const datatable = $("#datatableServicio").DataTable({
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
            if (typeof data.responseJSON.errors.nombre !== 'undefined') {
                document.getElementById("nombre").classList.add("is-invalid");
                document.getElementById("inputValidacionNombre").innerHTML = data.responseJSON.errors.nombre;
            } else {
                document.getElementById("nombre").classList.remove("is-invalid");
                document.getElementById("nombre").classList.add("is-valid");
                document.getElementById("inputValidacionNombre").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.fecha_inicio !== 'undefined') {
                document.getElementById("campoFechaInicio").classList.add("is-invalid");
                document.getElementById("inputValidacionFechaInicio").innerHTML = data.responseJSON.errors.fecha_inicio;
            } else {
                document.getElementById("campoFechaInicio").classList.remove("is-invalid");
                document.getElementById("campoFechaInicio").classList.add("is-valid");
                document.getElementById("inputValidacionFechaInicio").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.fecha_fin !== 'undefined') {
                document.getElementById("campoFechaFin").classList.add("is-invalid");
                document.getElementById("inputValidacionFechaFin").innerHTML = data.responseJSON.errors.fecha_fin;
            } else {
                document.getElementById("campoFechaFin").classList.remove("is-invalid");
                document.getElementById("campoFechaFin").classList.add("is-valid");
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

        function registrarServicio() {
            document.getElementById("botonDeCreacion").setAttribute("disabled", "true");

            const formElement = document.getElementById("formularioDeServicio");
            const formData = new FormData(formElement);

            $.ajax({
                type: 'POST',
                url: '{{ route('servicio.store') }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Creado!',
                        text: 'El servicio ' + data.nombre + ' se creó con éxito',
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
                }
            });
        }

        function confirmarEliminacionDelServicio(idServicio) {
            Swal.fire({
                title: '¿Está seguro?',
                text: "Este servicio se eliminará definitivamente de la plataforma",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarServicio(idServicio);
                }
            })
        }

        function eliminarServicio(idServicio) {
            let url = '{{ route('servicio.destroy', [':idServicio']) }}';
            url = url.replace(':idServicio', idServicio);
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
                            text: 'El servicio ' + data.nombre + ' se eliminó con éxito',
                            confirmButtonColor: "#448aff",
                            confirmButtonText: "Confirmar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route('servicio.index') }}';
                            }
                        });
                    }
                },
                error: function(data) {}
            })
        }
    </script>
@stop
