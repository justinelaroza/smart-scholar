<div class="flex flex-col md:flex-row justify-between items-center border p-4 md:p-6 gap-5 md:gap-10">
      
  <div class="flex flex-col items-center md:items-start gap-4 w-full">

    <div class="flex flex-row gap-4 w-full items-start">

      <div class="w-[100px] min-w-[100px] h-[100px] bg-gray-100 flex md:min-w-[170px] md:w-[170px] md:h-[170px] border rounded-md md:rounded-lg">
        <img src="{{ asset('assets/icons/profile-icon.png') }}" alt="Scholarship image" class="w-full h-full object-contain">
      </div>

      <div class="flex flex-col gap-6 md:gap-8 lg:gap-10">

        <div>
          <p class="font-semibold responsive-text-medium line-clamp-2">Educational Assistance Scholarship</p>
          <p class="text-gray-500 responsive-text-small line-clamp-1">Funded by <span class="font-medium">@ MayorIsky</span></p>
        </div>
        <div>
          <p class="text-gray-600 responsive-text-small line-clamp-2">
          This scholarship aims to aid award every semester. Every semester will have a different submission of documents.
          </p>
        </div>
        
      </div>

    </div>

    <div class="flex w-full">

      <div class="grid grid-cols-2 md:grid-cols-4 w-full gap-y-2 gap-x-6 mt-4 text-gray-600 responsive-text-small">
        <p class="text-center md:text-start">Education Level<br><span class="font-medium text-black">Any</span></p>
        <p class="text-center md:text-start">Submission Deadline<br><span class="font-medium text-black">12/23/2025</span></p>
        <p class="text-center md:text-start">Amount<br><span class="font-medium text-black">₱ 5,000</span></p>
        <p class="text-center md:text-start">Status<br><span class="font-medium text-white bg-green-500 rounded-2xl px-5 py-1">Success</span></p>
      </div>

    </div>
    
  </div>

  <div class="mt-4 w-1/2 md:mt-0 md:w-1/4 flex items-center justify-center md:justify-end">

    <a href="{{ route('scholarship.show') }}" class="bg-[#3B0097] responsive-text-small text-nowrap text-white py-3 w-full rounded-lg hover:bg-[#482DCE] text-center">
      Learn More
    </a>

  </div>

</div>