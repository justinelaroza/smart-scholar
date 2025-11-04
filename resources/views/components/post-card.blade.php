@props([
    'link' => '#', 
    'image' => asset('assets/images/municipality.jpg'), 
    'description' => 'No description available'
])

<a href="{{ $link }}" target="_blank" class="group flex flex-col bg-[#f8f8fb] border border-black rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden w-full">

  <div class="overflow-hidden">
    <img src="{{ $image }}" class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-500" />
  </div>

  <div class="flex-grow p-5 text-center flex flex-col justify-between border-t">

    <p class="responsive-text-small text-gray-800 line-clamp-2 min-h-[3rem]">
      {{ $description }}
    </p>

    <span class="mt-4 inline-block text-[#4f46e5] group-hover:text-[#3730a3] font-semibold transition">
      Learn More →
    </span>
    
  </div>

</a>