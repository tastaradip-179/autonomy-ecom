<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/js/app.js'])
    <style>
        .multiselect-dropdown .btn-group{
            display: flex !important;
        }
    </style>
</head>
<body>
    <!-- Page Content -->
    <main>
        @yield('content')
    </main>
</body>
</html>