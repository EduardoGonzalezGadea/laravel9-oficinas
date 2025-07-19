@extends('layouts.app')

@section('title', 'Ingreso al Sistema')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-white">
                <h3 class="text-center text-primary">
                    <i class="fas fa-user-lock me-2"></i>Autenticación de Usuario
                </h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">
                            <i class="fas fa-user me-1"></i>Nombre de Usuario
                        </label>
                        <input id="username" type="text" 
                               class="form-control @error('username') is-invalid @enderror" 
                               name="username" value="{{ old('username') }}" 
                               required autocomplete="username" autofocus>
                        
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-key me-1"></i>Contraseña
                        </label>
                        <input id="password" type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" required autocomplete="current-password">
                        
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Mantener sesión activa
                        </label>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-1"></i>Ingresar
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-white text-center">
                <small class="text-muted">Si tiene problemas para acceder, contacte al Departamento de Sistemas</small>
            </div>
        </div>
    </div>
</div>
@endsection