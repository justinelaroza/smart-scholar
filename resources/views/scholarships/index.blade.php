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

      </div>

    </div>

  </div>
    
@endsection