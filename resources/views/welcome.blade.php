<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles/Scripts/Fonts -->
        <title>{{ config('app.name', 'OC') }}</title>
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body class="antialiased">
        <div id="app">
        </div>
        <!-- Task 1 - Complete -->
        <div class="fixed right-0 bottom-0 text-sm text-gray-500">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
    </body>
</html>
