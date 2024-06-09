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
                <button class="btn btn-primary" data-toggle="modal" data-target="#nuevoServicioModal">
                    Nuevo Servicio
                </button>
            </div>
            <div class="table-responsive" id="scroll-footer-table" style="margin-bottom: 20px;">
                <table class="table table-bordered" id="datatableServicio">
                    <thead class="bg-primary">
                        <tr>
                            <th>NOMBRE</th>
                            <th>ACCIÓN</th>
                        </tr>
                        <tr class="filters">
                            <th><input type="text" class="form-control" placeholder="Nombre" /></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servicios as $servicio)
                            <tr>
                                <td>{{ $servicio->nombre }}</td>
                                <td>
                                    <div class="btn-group">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton{{ $servicio->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $servicio->id }}">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarServicioModal{{ $servicio->id }}">
                                                    <i class="fas fa-edit"></i> Editar Servicio
                                                </a>
                                                <a class="dropdown-item" href="#" onclick="confirmarEliminacionDelServicio('{{ $servicio->id }}')">
                                                    <i class="fas fa-trash-alt"></i> Eliminar Servicio
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fas fa-address-card"></i> Ver Conductores
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fas fa fa-truck"></i> Ver Vehiculos
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fas fa fa-file"></i> Documentos Conductores
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fas fa fa-file"></i> Documentos Vehiculos
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal de Modificar -->
                            <div class="modal fade" id="editarServicioModal{{ $servicio->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="servicioModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form id="formularioDeEditiarServicio{{ $servicio->id }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="nombre{{ $servicio->id }}">Nombre</label>
                                                    <input type="text" class="form-control"
                                                        id="nombre{{ $servicio->id }}" placeholder="Nombre Servicio"
                                                        name="nombre" value="{{ $servicio->nombre }}">
                                                    <div class="invalid-feedback"
                                                        id="inputValidacionNombre{{ $servicio->id }}"></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    id="botonDeEditar{{ $servicio->id }}"
                                                    onclick="editarServicio({{ $servicio->id }})">Editar Servicio</button>
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
            <div class="modal fade" id="nuevoServicioModal" tabindex="-1" role="dialog" aria-labelledby="servicioModal"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="formularioDeServicio">
                        @csrf
                        <div class="modal-content">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" placeholder="Nombre Servicio"
                                        name="nombre" value="{{ old('nombre') }}">
                                    <div class="invalid-feedback" id="inputValidacionNombre"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="botonDeCreacion"
                                    onclick="registrarServicio()">Registrar Servicio</button>
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
            if (data.responseJSON && data.responseJSON.errors && data.responseJSON.errors.nombre) {
                document.getElementById("nombre").classList.add("is-invalid");
                document.getElementById("inputValidacionNombre").innerHTML = data.responseJSON.errors.nombre;
            } else {
                document.getElementById("nombre").classList.remove("is-invalid");
                document.getElementById("inputValidacionNombre").innerHTML = "";
            }
        }

        function registrarServicio() {
            document.getElementById("botonDeCreacion").setAttribute("disabled", "true");
            const datosFormulario = $("#formularioDeServicio").serialize();
            $.ajax({
                type: 'POST',
                datatype: 'json',
                url: '{{ route('servicio.store') }}',
                data: datosFormulario,
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
                    document.getElementById("botonDeCreacion").removeAttribute("disabled");
                }
            });
        }

        function editarServicio(id) {
            document.getElementById("botonDeEditar" + id).setAttribute("disabled", "true");
            const datosFormulario = $("#formularioDeEditiarServicio" + id).serialize();
            $.ajax({
                type: 'PUT',
                dataType: 'json',
                url: '{{ url('servicios') }}/' + id,
                data: datosFormulario,
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
                    validarCampos(data, id);
                    document.getElementById("botonDeEditar" + id).removeAttribute("disabled");
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
