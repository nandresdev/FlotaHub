@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('title', 'Intranet | Registros De Documentos')

@section('content_header')
    <h1>Listado de Documentos Conductores</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <button class="btn btn-primary" data-toggle="modal" data-target="#nuevoDocumentoModal">
                    Nuevo Documento
                </button>
            </div>
            <div class="table-responsive" id="scroll-footer-table" style="margin-bottom: 20px;">
                <table class="table table-bordered" id="datatableUsuario">
                    <thead class="bg-primary">
                        <tr>
                            <th>SERVICIOS</th>
                            <th>TIPO</th>
                            <th>NOMBRE</th>
                            <th>ACCIÓN</th>
                        </tr>
                        <tr class="filters">
                            <th><input type="text" class="form-control" placeholder="Servicio" /></th>
                            <th><input type="text" class="form-control" placeholder="Tipo" /></th>
                            <th><input type="text" class="form-control" placeholder="Nombre" /></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doucmentosServicios as $doucmentosServicio)
                            <tr>
                                <td>{{ $doucmentosServicio->tipo }}</td>
                                <td>{{ $doucmentosServicio->tipo }}</td>
                                <td>{{ $doucmentosServicio->nombre }}</td>
                                <td></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('doucmentosServicios.edit', $doucmentosServicio->id) }}"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                            onclick="confirmarEliminacionDelUsuario('{{ $doucmentosServicio->id }}')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="modal fade" id="nuevoDocumentoModal" tabindex="-1" role="dialog"
                    aria-labelledby="servicioModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="formularioDeDocumento">
                            @csrf
                            <div class="modal-content">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre"
                                            placeholder="Nombre Servicio" name="nombre" value="{{ old('nombre') }}">
                                        <div class="invalid-feedback" id="inputValidacionNombre"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="botonDeCreacion"
                                        onclick="registrarServicio()">Registrar Documento</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
            const datatable = $("#datatableUsuario").DataTable({
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

        function confirmarEliminacionDelUsuario(idUsuario) {
            Swal.fire({
                title: '¿Está seguro?',
                text: "Este usuario se eliminará definitivamente de la plataforma",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarUsuario(idUsuario);
                }
            })
        }

        function eliminarUsuario(idUsuario) {
            let url = '{{ route('usuario.destroy', [':idUsuario']) }}';
            url = url.replace(':idUsuario', idUsuario);
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
                            text: 'El usuario ' + data.nombre + ' se eliminó con éxito',
                            confirmButtonColor: "#448aff",
                            confirmButtonText: "Confirmar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route('usuario.index') }}';
                            }
                        });
                    }
                },
                error: function(data) {}
            })
        }
    </script>
@stop
