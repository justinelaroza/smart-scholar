@props([
    'link' => '#', 
    'image' => asset('assets/images/municipality.jpg'), 
    'description' => 'No description available'
])

<a href="{{ $link }}" target="_blank" class="group flex flex-col bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden w-full">

  <div class="relative overflow-hidden">
    <img src="{{ $image }}" class="w-full h-60 object-cover group-hover:scale-110 transition-transform duration-700 ease-out" />
    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

    <div class="absolute top-4 left-4 bg-[#4f46e5]/90 text-white px-3 py-1 rounded-full shadow-md text-xs md:text-sm font-medium">
      Padre Garcia
    </div>

    <div class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm p-1.5 rounded-full shadow-md">
      <img src="{{ asset('assets/images/ss-logo.png') }}" alt="SmartScholar Logo" class="w-8 h-8 object-contain opacity-90 group-hover:opacity-100 transition-opacity duration-300">
    </div>
  </div>

  <div class="flex-grow p-6 flex flex-col justify-between text-center bg-gradient-to-b from-white to-gray-50">
    <p class="responsive-text-small text-gray-700 leading-relaxed line-clamp-2 min-h-[3rem]">
      {{ $description }}
    </p>

    <div class="mt-6">
      <span class="inline-flex items-center justify-center gap-1 text-[#4f46e5] group-hover:text-[#3730a3] font-semibold transition">
        Learn More 
      </span>
    </div>
  </div>

</a>

