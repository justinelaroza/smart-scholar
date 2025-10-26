@extends('layouts.app')

@section('maincontent')
    
  <div class="flex flex-col justify-center items-center my-8 md:my-20">
        
    <div class="flex flex-col justify-center items-center gap-5 md:gap-8 w-[90%] lg:w-3/4">

      <div class="flex flex-col justify-center gap-2 md:gap-4 w-full">
        <p class="responsive-text-xl font-bold">Find <span class="text-blue-600">Scholarships</span> by Education Level, Availability, or Status</p>
        <p class="responsive-text-medium" >Explore various scholarship opportunities exclusively offered by the Municipality of Padre Garcia, Batangas. Browse the categories below to find the best program that fits your educational goals.</p>
      </div>

      <div class="flex flex-col justify-center gap-2 md:gap-4 w-full">
        <p class="responsive-text-xl font-bold">Browse Scholarships</p>
        <input class="responsive-text-medium w-full p-3 md:p-4 border rounded-2xl" type="text" placeholder="Search scholarships by keyword">
      </div>

      <div class="flex flex-col md:flex-row md:justify-between md:items-center w-full gap-3 md:gap-5 responsive-text-small">

        <div class="flex flex-col md:flex-row gap-3 md:gap-5 w-full md:w-auto">
          <select class="pr-3 md:pr-5 w-auto">
            <option value="Any Education Level">Any Education Level</option>
            <option value="Senior High School">Senior High School</option>
            <option value="College">College</option>
          </select>

          <select class="pr-3 md:pr-5 w-auto">
            <option value="Any Status">Any Status</option>
            <option value="Pending">Pending</option>
            <option value="Accepted">Accepted</option>
            <option value="Denied">Denied</option>
          </select>
        </div>

        <div class="flex w-full md:w-auto">
          <select class="pr-3 md:pr-5 w-full">
            <option value="Available">Available</option>
            <option value="All">All</option>
            <option value="Expired">Expired</option>
          </select>
        </div>

      </div>

      <div class="w-full flex flex-col gap-4 mt-5 md:gap-6 md:mt-8">

        <!-- CARD -->
        <div class="flex flex-col md:flex-row justify-between items-center border p-4 md:p-6 gap-5 md:gap-10">
          
          <!-- Left side-->
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
              <!-- Info -->
              <div class="grid grid-cols-2 md:grid-cols-4 w-full gap-y-2 gap-x-6 mt-4 text-gray-600 responsive-text-small">
                <p class="text-center md:text-start">Education Level<br><span class="font-medium text-black">Any</span></p>
                <p class="text-center md:text-start">Submission Deadline<br><span class="font-medium text-black">12/23/2025</span></p>
                <p class="text-center md:text-start">Amount<br><span class="font-medium text-black">₱ 5,000</span></p>
                <p class="text-center md:text-start">Status<br><span class="font-medium text-white bg-green-500 rounded-2xl px-5 py-1">Success</span></p>
              </div>

            </div>
            
          </div>

          <!-- Right side -->
          <div class="mt-4 w-1/2 md:mt-0 md:w-1/4 flex items-center justify-center md:justify-end">

            <a href="{{ route('scholarship.show') }}" class="bg-[#3B0097] responsive-text-small text-nowrap text-white py-3 w-full rounded-lg hover:bg-[#482DCE] text-center">
              Learn More
            </a>

          </div>

        </div>
        <!--End card-->
      </div>

    </div>

  </div>
    
@endsection