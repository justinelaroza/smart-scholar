@props([
    'link' => '#', 
    'image' => asset('assets/images/municipality.jpg'), 
    'description' => 'No description available'
])

<a href="{{ $link }}" target="_blank" class="group flex flex-col bg-white rounded-lg shadow hover:shadow-xl transition overflow-hidden w-full h-full">
  
  <div>
    <img src="{{ $image }}" class="w-full h-60 object-cover" />
  </div>

  <div class="flex-grow p-5 text-center bg-[#282740] flex flex-col justify-between">
    <p class="responsive-text-small text-gray-300 line-clamp-2 min-h-[3rem]">
      {{ $description }}
    </p>
  </div>

</a>