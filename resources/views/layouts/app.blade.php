<!DOCTYPE html>
<html lang="es-UY">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistema Oficinas') }} | @yield('title')</title>
    
    <!-- Favicon (usar el del MI) -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Estilos personalizados -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body class="bg-light">
    <!-- Barra de navegación -->
    @include('layouts.nav')
    
    <!-- Contenido principal -->
    <main class="container py-4">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-dark text-white py-3 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">© {{ date('Y') }} Ministerio del Interior - República Oriental del Uruguay</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Versión {{ config('app.version', '1.0.0') }}</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    @stack('scripts')
</body>
</html>