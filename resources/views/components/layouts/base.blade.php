<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <title>{{ $title ?? 'Lacomp' }}</title>
</head>
<style>
  body { font-family: 'Inter', -apple-system, sans-serif; }
  .fade-up { opacity:0; transform:translateY(24px); transition:opacity .6s ease,transform .6s ease; }
  .fade-up.visible { opacity:1; transform:translateY(0); }
</style>
<body class="font-sans flex flex-col min-h-screen bg-slate-50 antialiased">
<!-- Navigation -->
@include("components.nav.nav")
<div class="h-[72px]"></div>

<!-- Content -->
<div class="flex-grow">
    {{ $slot }}
</div>

<!-- Footer -->
@include('components.includes.footer')

</body>
</html>
