<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smart Scholar</title>
  <script src="https://kit.fontawesome.com/729ccf9ac8.js" crossorigin="anonymous"></script>
  <link rel="icon" type="image/png" href="{{ asset('assets/icons/favicon-icon.png') }}">
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/components/navbar.js'])
</head>
<body>

  <x-header />

  <main>
    @if(session('success'))
      <div class="bg-green-100 text-green-700 px-4 py-2 rounded text-center">
        {{ session('success') }}
      </div>
    @endif
    @if(session('error'))
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded text-center">
        {{ session('error') }}
      </div>
    @endif
    @if ($errors->any())
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded text-center">
        <ul class="list-inside list-none">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @yield('maincontent')
  </main>

  <x-footer />

  @yield('scripts')

</body>
</html>