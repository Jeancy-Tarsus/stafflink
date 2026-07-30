<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="icon" href="">

    {{-- CSS classique --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    {{-- sweetalert2 --}}
   <link rel="stylesheet" href="{{ asset('sweetalert/dist/sweetalert2.min.css') }}">


    {{-- Librairies externes --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Laravel Vite (tailwind, app.js, etc.) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body>
    {{-- Navbar Jetstream (désactivée pour l’instant) --}}
    @include('navigation-menu')

    <div class="container custom-container">
        @yield('content')
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}

    <script src="{{ asset('sweetalert/dist/sweetalert2.all.min.js') }}"></script>

     @if(session('success'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Succès',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
    </script>
    @endif

    @if(session('error'))
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: '{{ session('error') }}',
        timer: 3000,
        showConfirmButton: false
    });
    </script>
    @endif

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
