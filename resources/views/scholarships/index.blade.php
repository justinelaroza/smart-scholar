@extends('layouts.app')

@section('maincontent')
    
  <div class="flex flex-col justify-center items-center my-8 md:my-20">
        
    <div class="flex flex-col justify-center items-center gap-5 md:gap-8 w-[90%] lg:w-3/4">

      <div class="flex flex-col justify-center gap-2 md:gap-4 w-full">
        <p class="responsive-text-xl font-bold">Find <span class="text-blue-600">Scholarships</span> by Keyword, Education Level, or Status</p>
        <p class="responsive-text-medium" >Explore various scholarship opportunities exclusively offered by the Municipality of Padre Garcia, Batangas. Browse the categories below to find the best program that fits your educational goals.</p>
      </div>

      <div class="w-full">
        <p class="responsive-text-xl font-bold">Browse Scholarships</p>
      </div>

      <form method="GET" action="{{ route('scholarship') }}" class="flex flex-col w-full gap-3 md:gap-5 responsive-text-small">

        <div class="flex w-full gap-2">

          <input type="text" name="search" value="{{ request('search') }}" placeholder="Search scholarships by keyword" class="responsive-text-medium w-full p-3 md:p-4 border rounded-2xl">

          <button type="submit" class="bg-[#3B0097] text-white px-6 md:px-8 rounded-2xl hover:bg-[#482DCE] transition cursor-pointer">
            Search
          </button>
        </div>

        <div class="flex flex-col md:flex-row md:justify-between md:items-center w-full gap-1">

          <div class="flex items-center gap-5">
            <label for="educational_level" class="text-nowrap">Education Level:</label>
            <select name="education_level" onchange="this.form.submit()" class="w-full md:w-auto px-3 py-2 text-gray-700 border-b border-gray-300">
              <option value="">All</option>
              <option value="Senior High" {{ request('education_level') == 'Senior High' ? 'selected' : '' }}>Senior High School</option>
              <option value="College" {{ request('education_level') == 'College' ? 'selected' : '' }}>College</option>
              <option value="Any" {{ request('education_level') == 'Any' ? 'selected' : '' }}>Any</option>
            </select>
          </div>
          
          <div class="flex items-center gap-5">
            <label for="status" class="text-nowrap">Scholarship Status:</label>
            <select name="status" onchange="this.form.submit()" class="w-full md:w-auto px-3 py-2 text-gray-700 border-b border-gray-300">
              <option value="">All</option>
              <option value="Open" {{ request('status') == 'Open' ? 'selected' : '' }}>Open</option>
              <option value="Close" {{ request('status') == 'Close' ? 'selected' : '' }}>Close</option>
            </select>
          </div>

        </div>

      </form>


      <!-- Scholarships List -->
      <div class="w-full flex flex-col gap-4 mt-5 md:gap-6 md:mt-8">

          @forelse ($scholarships as $scholarship)

            <div class="flex flex-col md:flex-row justify-between items-center border p-4 md:p-6 gap-5 md:gap-10 bg-white rounded-lg shadow-sm">
            
              <div class="flex flex-col items-center md:items-start gap-4 w-full">

                <div class="flex flex-row gap-4 w-full items-start">

                  <div class="w-[100px] min-w-[100px] h-[100px] bg-gray-100 flex md:min-w-[170px] md:w-[170px] md:h-[170px] border rounded-md md:rounded-lg overflow-hidden">
                    <img src="data:image/jpeg;base64,{{ base64_encode($scholarship->image) }}" 
        alt="Scholarship image" class="w-full h-full object-cover">
                  </div>

                  <div class="flex flex-col gap-6 md:gap-8 lg:gap-10">
                    <div>
                      <p class="font-semibold responsive-text-medium line-clamp-2">{{ $scholarship->title }}</p>
                      <p class="text-gray-500 responsive-text-small line-clamp-1">Funded by <span class="font-medium">@ {{ $scholarship->funder }}</span></p>
                    </div>
                    <div>
                      <p class="text-gray-600 responsive-text-small line-clamp-2">{{ $scholarship->description }}</p>
                    </div>
                  </div>

                </div>

                <div class="flex w-full">
                  <div class="grid grid-cols-2 md:grid-cols-4 w-full gap-y-2 gap-x-6 mt-4 text-gray-600 responsive-text-small">
                    <p class="text-center md:text-start">Education Level<br><span class="font-medium text-black">{{ $scholarship->education_level }}</span></p>
                    <p class="text-center md:text-start">Submission Deadline<br><span class="font-medium text-black">{{ \Carbon\Carbon::parse($scholarship->submission_deadline)->format('m/d/Y') }}</span></p>
                    <p class="text-center md:text-start">Scholarship Status<br>
                      <span class="font-medium text-white rounded-2xl px-5 py-1
                        {{ $scholarship->status === 'Open' ? 'bg-green-500' : 'bg-red-500' }}">
                        {{ $scholarship->status }}
                      </span>
                    </p>
                    @auth
                      <p class="text-center md:text-start">Application Status<br>
                        <span class="font-medium text-white rounded-2xl px-5 py-1
                          {{ $scholarship->has_applied ? 'bg-green-500' : 'bg-red-500' }}">
                          {{ $scholarship->has_applied ? 'Applied' : 'Not Applied' }}
                        </span>
                      </p>
                      @else
                        <p class="text-center md:text-start">
                          Application Status<br>
                          <a href="{{ route('login') }}" class="inline-block font-medium text-white rounded-2xl px-5 py-1 bg-gray-500 hover:bg-gray-600 transition responsive-text-xs text-nowrap">
                            Login First
                          </a>
                        </p>
                    @endauth
                  </div>
                </div>
                
              </div>

              <div class="mt-4 w-1/2 md:mt-0 md:w-1/4 flex items-center justify-center md:justify-end">
                <a href="{{ route('scholarship.show', $scholarship->id) }}" 
                  class="bg-[#3B0097] responsive-text-small text-nowrap text-white py-3 w-full rounded-lg hover:bg-[#482DCE] text-center">
                  Learn More
                </a>
              </div>

            </div>

            @empty

            <div class="flex flex-col items-center justify-center text-center py-16 px-6 bg-white rounded-xl shadow-sm border w-full">
              <img src="{{ asset('assets/images/empty-search.jpg') }}" alt="No scholarships found" class="w-56 h-56 md:w-72 md:h-72 object-contain mb-6 opacity-90 mx-auto transition-transform duration-300 hover:scale-105">
              <h2 class="text-xl md:text-2xl font-semibold text-gray-700 mb-2">No Scholarships Found</h2>
              <p class="text-gray-500 max-w-md">We couldn't find any scholarships that match your search or filter criteria. Try adjusting your filters or keywords.</p>
            </div>

          @endforelse

      </div>

      <div class="mt-10 w-full [&>nav]:w-full [&>nav]:flex [&>nav]:justify-center">
        {{ $scholarships->appends(request()->query())->links() }}
      </div>

    </div>

  </div>
    
@endsection