<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $configItems['site_name']->value ?? 'Nama Website' }} - @stack('title', 'Halaman')</title>
    @if ($configItems['favicon']->value && Storage::disk('public')->exists($configItems['favicon']->value))
        <link rel="shortcut icon" type="image/x-icon" href="{{ Storage::url($configItems['favicon']->value) }}" rel="shortcut icon">
    @else
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}assets/images/favicon.png">
    @endif

    @stack('styles')
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body>
    @yield('content')

    @stack('scripts')
</body>

</html>
