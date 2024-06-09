@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('title', 'Intranet | Registros De Conductores')

@section('content_header')
    <h1>Listado de Conductores</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <button class="btn btn-primary" onclick="window.location='{{ route('conductor.create') }}'">
                    Nuevo Conductor
                </button>
            </div>
            <div class="table-responsive" id="scroll-footer-table" style="margin-bottom: 20px;">
                <table class="table table-bordered" id="datatableConductores">
                    <thead class="bg-primary">
                        <tr>
                            <th>NOMBRE COMPLETO</th>
                            <th>FECHA DE NACIMIENTO</th>
                            <th>TELÉFONO</th>
                            <th>NACIONALIDAD</th>
                            <th>SERVICIO</th>
                            <th>ACCIÓN</th>
                        </tr>
                        <tr class="filters">
                            <th><input type="text" class="form-control" placeholder="Nombre Completo" /></th>
                            <th><input type="date" class="form-control" placeholder="Fecha Nacimiento" /></th>
                            <th><input type="text" class="form-control" placeholder="Teléfono" /></th>
                            <th><input type="text" class="form-control" placeholder="Nacionalidad" /></th>
                            <th><input type="text" class="form-control" placeholder="Servicio" /></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($conductores as $conductor)
                            <tr>
                                <td>{{ $conductor->nombre_completo }}</td>
                                <td>{{ $conductor->fecha_nacimiento }}</td>
                                <td>{{ $conductor->telefono }}</td>
                                <td>{{ $conductor->nacionalidad }}</td>
                                <td>{{ $conductor->servicios->nombre }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('conductor.edit', $conductor->id) }}"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                            onclick="confirmarEliminacionDelConductor('{{ $conductor->id }}')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
            const datatable = $("#datatableConductores").DataTable({
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

        function confirmarEliminacionDelConductor(idConductor) {
            Swal.fire({
                title: '¿Está seguro?',
                text: "Este conductor se eliminará definitivamente de la plataforma",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarConductor(idConductor);
                }
            })
        }

        function eliminarConductor(idConductor) {
            let url = '{{ route('conductor.destroy', [':idConductor']) }}';
            url = url.replace(':idConductor', idConductor);
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
                            text: 'El conductor ' + data.nombre_completo + ' se eliminó con éxito',
                            confirmButtonColor: "#448aff",
                            confirmButtonText: "Confirmar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route('conductor.index') }}';
                            }
                        });
                    }
                },
                error: function(data) {}
            })
        }
    </script>
@stop
