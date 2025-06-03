<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite('resources/css/app.css')
    @livewireStyles

    <title>{{ $title ?? 'Page Title' }}</title>
</head>
<body class="font-sans flex flex-col min-h-screen bg-softPink dark:bg-gray-600">
<!-- Navigation -->
<div class="h-[56px] md:h-[80px]">
    @include("components.nav.nav")
</div>

<!-- Content -->
<div class="flex-grow">
    {{ $slot }}
</div>

<!-- Footer -->
@include('components.includes.footer')

</body>
</html>
