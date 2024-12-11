<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Styles -->
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @else
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
  @endif
</head>

<body class="font-sans antialiased bg-gradient-to-b from-gray-100 via-white to-gray-200 min-h-screen">

  <!-- Header fijo -->
  <header class="fixed top-0 left-0 right-0 bg-white shadow-md z-50">
    <div class="container mx-auto flex justify-between items-center p-4">
      <a href="/" class="text-lg font-semibold text-gray-700">Fraschina SRL</a>
      <div>
        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
          Login
        </a>
      </div>
    </div>
  </header>

  <!-- Contenido principal con imagen de fondo -->
  <main class="pt-20 min-h-screen bg-cover bg-center flex flex-col items-center justify-between"
    style="background-image: url('{{ asset('assets/img/CENTRO-DISTRIBUCION-1920x1181.jpg') }}');">
    <!-- Título superior -->
    <div class=" mt-48 text-center">
      <h1 class="text-3xl font-bold text-black">
        Bienvenido a Fraschina SRL
      </h1>
    </div>

    <!-- Texto antes del footer -->
    <div class="flex-grow"></div>
    <div class="max-w-2xl mx-auto p-6 bg-white bg-opacity-80 rounded-lg shadow mb-16">
      <p class="text-center text-gray-600">
        Accede al sistema usando el botón de login en el menú.
      </p>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-4 fixed bottom-0 w-full">
    <div class="container mx-auto text-center">
      &copy; {{ date('Y') }} Fraschina SRL. Todos los derechos reservados.
    </div>
  </footer>

</body>

</html>