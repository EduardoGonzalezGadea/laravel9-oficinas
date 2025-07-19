@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-white">
                <h3 class="text-center text-primary">
                    <i class="fas fa-landmark me-2"></i>Sistema de Gestión Institucional
                </h3>
            </div>
            <div class="card-body text-center">
                <img src="{{ asset('images/escudo-uruguay.png') }}" alt="Escudo Uruguay" class="img-fluid mb-4" style="max-height: 200px;">
                
                <h4 class="mb-4">Ministerio del Interior - República Oriental del Uruguay</h4>
                
                <div class="d-grid gap-2 col-md-6 mx-auto">
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i>Ingresar al Sistema
                    </a>
                    @else
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-tachometer-alt me-2"></i>Ir al Panel
                    </a>
                    @endguest
                </div>
            </div>
            <div class="card-footer bg-white text-muted text-center">
                <small>Sistema desarrollado por la División Informática - Departamento de Montevideo</small>
            </div>
        </div>
    </div>
</div>
@endsection