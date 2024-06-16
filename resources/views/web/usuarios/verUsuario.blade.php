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
                            <img src="{{ auth()->user()->foto_perfil ? asset(auth()->user()->foto_perfil) : asset('img/avatar_cero.png') }}" 
                                         alt="Foto de Perfil" class="img-thumbnail" style="width: 128px; height: 128px;">
                        </div>
                        <br>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Nombre</b> <p class="float-right text-muted">{{ auth()->user()->name }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>Correo Electrónico</b> <p class="float-right text-muted">{{ auth()->user()->email }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>Estado</b> <p class="float-right badge badge-success">{{ auth()->user()->estado }}</p>
                            </li>
                        </ul>
                        <a href="{{ route('usuario.edit', auth()->user()->id) }}" class="btn btn-dark btn-block"><b>Modificar</b>
                            <i class="fas fa-edit mr-1"></i></a>
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
