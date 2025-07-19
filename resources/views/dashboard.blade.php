@extends('layouts.app')

@section('title', 'Panel Principal')

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-primary shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-user-circle me-2"></i>Información del Usuario
                </h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <img src="{{ asset('images/user-default.png') }}" alt="Foto Perfil" class="rounded-circle" width="100">
                </div>
                
                <h5 class="text-center">{{ auth()->user()->nombre_completo }}</h5>
                <p class="text-muted text-center mb-4">{{ auth()->user()->email }}</p>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Rol
                        <span class="badge bg-primary rounded-pill">
                            {{ auth()->user()->getRoleNames()->first() }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Módulos
                        <span class="badge bg-success rounded-pill">
                            {{ auth()->user()->modulos->count() }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Último acceso
                        <span class="text-muted">
                            {{ auth()->user()->last_login_at?->format('d/m/Y H:i') ?? 'Nunca' }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="fas fa-tachometer-alt me-2"></i>Accesos Rápidos
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @if(auth()->user()->hasRole('administrador'))
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-primary w-100 h-100 py-4">
                            <i class="fas fa-users fa-3x mb-2"></i><br>
                            Gestión de Usuarios
                        </a>
                    </div>
                    @endif
                    
                    @if(auth()->user()->tieneAccesoModulo('ASES.CONTAB.'))
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('contabilidad.reportes') }}" class="btn btn-outline-success w-100 h-100 py-4">
                            <i class="fas fa-file-invoice-dollar fa-3x mb-2"></i><br>
                            Reportes Contables
                        </a>
                    </div>
                    @endif
                    
                    @if(auth()->user()->tieneAccesoModulo('TESORERIA'))
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('tesoreria.transacciones') }}" class="btn btn-outline-info w-100 h-100 py-4">
                            <i class="fas fa-money-bill-transfer fa-3x mb-2"></i><br>
                            Transacciones
                        </a>
                    </div>
                    @endif
                    
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('perfil') }}" class="btn btn-outline-secondary w-100 h-100 py-4">
                            <i class="fas fa-user-edit fa-3x mb-2"></i><br>
                            Mi Perfil
                        </a>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <a href="#" class="btn btn-outline-dark w-100 h-100 py-4">
                            <i class="fas fa-question-circle fa-3x mb-2"></i><br>
                            Ayuda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection