<nav class="z-40 bg-[#282740] sticky top-0 flex justify-between items-center md:grid md:grid-cols-[1fr_1.7fr_1fr] h-20 px-7 md:px-5 gap-10">
  
  <div class="flex md:justify-start lg:justify-center items-center">
    <img src="{{ asset('assets/images/pg-logo.png') }}" class="h-14" alt="Padre Garcia Logo">
  </div>
  
  <ul class="hidden responsive-text-xs md:flex md:justify-between md:items-center md:min-w-md list-none text-white">
    <li><a href="{{ route('home') }}">HOME</a></li>
    <li><a href="{{ route('scholarship') }}">SCHOLARSHIP</a></li>
    <li><a href="{{ route('about') }}">ABOUT</a></li>
    <li><a href="{{ route('support') }}">SUPPORT</a></li>
  </ul>

  <div class="flex md:justify-end lg:justify-center items-center gap-3">

    @guest
      <a href="{{ route('login') }}" class="hidden md:inline-block bg-white text-[#282740] hover:bg-white/80 px-5 py-2 rounded-lg transition">
        Login
      </a>
    @endguest

    @auth
      <a href="{{ route('profile') }}" class="hidden md:block relative group">
        <div class="p-[3px] rounded-full bg-gradient-to-tr from-[#4f46e5] via-[#6366f1] to-[#a5b4fc] group-hover:from-[#818cf8] group-hover:to-[#c7d2fe] transition-all duration-500">
          <img src="{{ asset('assets/images/ss-logo.png') }}" alt="Profile" class="h-14 w-14 bg-white rounded-full shadow-md cursor-pointer" />
        </div>
      </a>
    @endauth

    <button id="menu-btn" class="block md:hidden">
      <img src="{{ asset('assets/icons/burger-menu-icon.png') }}" alt="Burger menu" class="h-12 cursor-pointer">
    </button>

  </div>

  <!-- Sidebar -->
  <div id="mobile-sidebar" class="z-50 fixed top-0 right-0 h-screen w-2/3 bg-[#282740] text-white flex flex-col items-start p-8 gap-3 transform translate-x-full transition-transform duration-300">

    <button id="close-btn" class="self-end mb-4 cursor-pointer text-3xl">✕</button>

    <div class="flex flex-col gap-4 w-full">

      <a href="{{ route('home') }}" class="responsive-text-medium text-left p-5 active:bg-white/20 block transition-all duration-200">HOME</a>
      <a href="{{ route('scholarship') }}" class="responsive-text-medium text-left p-5 active:bg-white/20 block transition-all duration-200">SCHOLARSHIP</a>
      <a href="{{ route('about') }}" class="responsive-text-medium text-left p-5 active:bg-white/20 block transition-all duration-200">ABOUT</a>
      <a href="{{ route('support') }}" class="responsive-text-medium text-left p-5 active:bg-white/20 block transition-all duration-200">SUPPORT</a>

      @guest
        <a href="{{ route('login') }}" class="responsive-text-medium text-left p-5 active:bg-white/20 block transition-all duration-200">LOGIN</a>
      @endguest

      @auth
        <a href="{{ route('profile') }}" class="responsive-text-medium text-left p-5 active:bg-white/20 block transition-all duration-200">PROFILE</a>
      @endauth

    </div>

  </div>
  
</nav>