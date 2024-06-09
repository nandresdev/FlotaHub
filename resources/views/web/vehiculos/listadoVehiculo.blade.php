@extends('adminlte::page')

@section('title', 'Intranet | Registros De Vehiculos')

@section('content_header')
    <h1>Listado de Vehiculos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <button class="btn btn-success" onclick="window.location=''">
                    Exportar a Excel
                </button>
                <button class="btn btn-danger" onclick="window.location=''">
                    Exportar a PDF
                </button>
                <button class="btn btn-primary" onclick="window.location='{{ route('vehiculo.create') }}'">
                    Nuevo Vehiculo
                </button>
            </div>
            <div class="table-responsive" id="scroll-footer-table" style="margin-bottom: 20px;">
                <table class="table table-bordered" id="datatableVehiculo">
                    <thead class="bg-primary">
                        <tr>
                            <th>TIPO DE VEHICULO</th>
                            <th>PATENTE</th>
                            <th>MARCA</th>
                            <th>MODELO</th>
                            <th>COMBUSTIBLE</th>
                            <th>AÑO</th>
                            <th>COLOR</th>
                            <th>TRACCIÓN</th>
                            <th>NRO DE MOTOR</th>
                            <th>NRO DE CHASIS</th>
                            <th>KILOMETRAJE</th>
                            <th>ACCIÓN</th>
                        </tr>
                        <tr class="filters">
                            <th><input type="text" class="form-control" placeholder="Tipo de Vehiculo" /></th>
                            <th><input type="text" class="form-control" placeholder="Patente" /></th>
                            <th><input type="text" class="form-control" placeholder="Marca" /></th>
                            <th><input type="text" class="form-control" placeholder="Modelo" /></th>
                            <th><input type="text" class="form-control" placeholder="Combustible" /></th>
                            <th><input type="text" class="form-control" placeholder="Año" /></th>
                            <th><input type="text" class="form-control" placeholder="Color" /></th>
                            <th><input type="text" class="form-control" placeholder="Tracción" /></th>
                            <th><input type="text" class="form-control" placeholder="Nro de Motor" /></th>
                            <th><input type="text" class="form-control" placeholder="Nro de Chasis" /></th>
                            <th><input type="text" class="form-control" placeholder="Kilometraje" /></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehiculos as $vehiculo)
                            <tr>
                                <td>{{ $vehiculo->tipo_vehiculo }}</td>
                                <td>{{ $vehiculo->patente }}</td>
                                <td>{{ $vehiculo->marca }}</td>
                                <td>{{ $vehiculo->modelo }}</td>
                                <td>{{ $vehiculo->combustible }}</td>
                                <td>{{ $vehiculo->ano }}</td>
                                <td>{{ $vehiculo->traccion }}</td>
                                <td>{{ $vehiculo->color }}</td>
                                <td>{{ $vehiculo->numero_motor }}</td>
                                <td>{{ $vehiculo->numero_chasis }}</td>
                                <td>{{ $vehiculo->kilometraje }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('vehiculo.edit', $vehiculo->id) }}"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                            onclick="confirmarEliminacionDelVehiculo('{{ $vehiculo->id }}')">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            const datatable = $("#datatableVehiculo").DataTable({
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

        function confirmarEliminacionDelVehiculo(idVehiculo) {
            Swal.fire({
                title: '¿Está seguro?',
                text: "Este vehiculo se eliminará definitivamente de la plataforma",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarVehiculo(idVehiculo);
                }
            })
        }

        function eliminarVehiculo(idVehiculo) {
            let url = '{{ route('vehiculo.destroy', [':idVehiculo']) }}';
            url = url.replace(':idVehiculo', idVehiculo);
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
                            text: 'El vehiculo ' + data.patente + ' se eliminó con éxito',
                            confirmButtonColor: "#448aff",
                            confirmButtonText: "Confirmar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route('vehiculo.index') }}';
                            }
                        });
                    }
                },
                error: function(data) {}
            })
        }
    </script>
@stop
