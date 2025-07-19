<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo-minterior.png') }}" alt="Logo Ministerio" height="40">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Menú izquierdo -->
            <ul class="navbar-nav me-auto">
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-th-large me-1"></i> Módulos
                    </a>
                    <ul class="dropdown-menu">
                        @if(auth()->user()->hasRole('administrador')) 
                        <li><a class="dropdown-item" href="{{ route('sistema.dashboard') }}">
                            <i class="fas fa-cogs me-2"></i>Sistema
                        </a></li>
                        @endif
                        
                        @if(auth()->user()->tieneAccesoModulo('ASES.CONTAB.'))
                        <li><a class="dropdown-item" href="{{ route('contabilidad.dashboard') }}">
                            <i class="fas fa-calculator me-2"></i>Asesoría Contable
                        </a></li>
                        @endif
                        
                        @if(auth()->user()->tieneAccesoModulo('TESORERIA'))
                        <li><a class="dropdown-item" href="{{ route('tesoreria.dashboard') }}">
                            <i class="fas fa-money-bill-wave me-2"></i>Tesorería
                        </a></li>
                        @endif
                    </ul>
                </li>
                @endauth
            </ul>
            
            <!-- Menú derecho -->
            <ul class="navbar-nav ms-auto">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ingresar') }}">
                        <i class="fas fa-sign-in-alt me-1"></i>Ingresar
                    </a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i>
                        {{ auth()->user()->nombre_completo }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('perfil') }}">
                            <i class="fas fa-user me-2"></i>Mi Perfil
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('cerrar-sesion') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>