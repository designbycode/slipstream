<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ??= config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800,900" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/ts/app.ts'])
    @livewireStyles
</head>
<body class="h-full antialiased text-gray-700 bg-gray-100">


<main id="main" class="max-w-md mx-auto my-20">
    {{ $slot }}
</main>

@livewireScripts
@livewire('wire-elements-modal')

</body>
</html>
