@extends('adminlte::page')

@section('title', 'Intranet | Editar Usuario')

@section('content_header')
    <h3 class="profile-username text-center">Información del Usuario</h3>

@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                        </div>
                        <strong><i class="fas fa-id-card-alt mr-1"></i> Nombre</strong>
                        <p class="text-muted">
                            {{ auth()->user()->name }}
                        </p>
                        <hr>
                        <strong><i class="fas fa-id-card-alt mr-1"></i> Cargo</strong>
                        <p class="text-muted">
                            {{ auth()->user()->cargo }}
                        </p>
                        <hr>
                        <strong><i class="fas fa-at mr-1"></i> Correo</strong>
                        <p class="text-muted">{{ auth()->user()->email }}</p>
                        <hr>
                        <div class="text-center">
                            <a href="{{ route('usuario.edit', auth()->user()->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit mr-1"></i> Modificar
                            </a>
                        </div>
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
@stop
