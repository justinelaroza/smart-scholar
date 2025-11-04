<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

  <main>
    @if(session('success'))
      <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 text-center">
        {{ session('success') }}
      </div>
    @endif
    @if(session('error'))
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-center">
        {{ session('error') }}
      </div>
    @endif
    @if ($errors->any())
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-center">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @yield('maincontent')
  </main>

  @yield('scripts')

</body>
</html>