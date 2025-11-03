@extends('layouts.app')

@section('maincontent')

<section class="relative bg-gray-100 min-h-[calc(100vh-80px)] flex flex-col items-center justify-start py-16 px-6 md:px-20">

  <div class="bg-white w-full max-w-5xl rounded-3xl shadow-lg p-8 md:p-10 mb-10">
    <div class="flex flex-col md:flex-row items-center md:items-start gap-6">

      <div class="flex-shrink-0">
        <div class="w-32 h-32 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 responsive-text-2xl font-bold">
          {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) ?? 'U' }}
        </div>
      </div>

      <div class="flex flex-col w-full text-center md:text-left">
        <h2 class="responsive-text-2xl font-bold text-[#282740]">
          {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
        </h2>
        <p class="text-gray-600 mt-1 responsive-text-small">
          Account Code: <span class="text-blue-600 responsive-text-small">{{ Auth::user()->account_code }}</span>
        </p>
        <p class="text-gray-600 responsive-text-small">
          Email: <span class="responsive-text-small">{{ Auth::user()->email }}</span>
        </p>
        <p class="text-gray-600 responsive-text-small">
          Phone: <span class="responsive-text-small">{{ Auth::user()->phone_number }}</span>
        </p>
        <p class="text-gray-600 responsive-text-small">
          Address: <span class="responsive-text-small">{{ Auth::user()->full_address }}</span>
        </p>
        <p class="text-gray-600 responsive-text-small">
          Gender: <span class="responsive-text-small">{{ Auth::user()->gender }}</span>
        </p>
        <p class="text-gray-600 responsive-text-small">
          Birthday: <span class="responsive-text-small">{{ \Carbon\Carbon::parse(Auth::user()->birthday)->format('F d, Y') }}</span>
        </p>
      </div>

    </div>
  </div>

  <div class="w-full max-w-5xl bg-white rounded-3xl shadow-lg p-8 md:p-10">

    <h3 class="responsive-text-large font-bold text-[#282740] mb-6 text-center md:text-left">
      My Scholarship Applications
    </h3>

    <!-- Desktop Table -->
    <div class="hidden md:block overflow-x-auto">
      <table class="min-w-full table-auto border-collapse">
        <thead>
          <tr class="bg-blue-600 text-white text-left">
            <th class="px-6 py-3 rounded-tl-lg responsive-text-small">Scholarship Name</th>
            <th class="px-6 py-3 responsive-text-small">Status</th>
            <th class="px-6 py-3 rounded-tr-lg text-center responsive-text-small">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($applications as $app)
            <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
              <td class="px-6 py-4 font-medium text-gray-800 responsive-text-small">
                {{ $app->scholarship->title }}
              </td>
              <td class="px-6 py-4">
                <span class="{{ 
                  $app->progress === 'Approved' ? 'bg-green-100 text-green-700' : 
                  ($app->progress === 'Rejected' ? 'bg-red-100 text-red-700' : 
                  ($app->progress === 'Requires Revision' ? 'bg-yellow-100 text-yellow-700' : 
                  'bg-blue-100 text-blue-700')) 
                }} px-3 py-1 rounded-full responsive-text-xs font-medium text-nowrap">
                  {{ $app->progress }}
                </span>
              </td>
              <td class="px-6 py-4 text-center">
                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg responsive-text-xs">
                  View
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-center py-6 text-gray-500">
                <img src="{{ asset('assets/images/empty-search.jpg') }}" alt="No scholarships found"
                    class="w-60 h-60 object-contain mx-auto mb-4 max-w-full sm:w-80 sm:h-80">
                <p class="responsive-text-small">No scholarship applications found.</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Mobile Cards -->
    <div class="md:hidden space-y-4">
      @forelse ($applications as $app)
        <div class="border border-gray-200 rounded-xl p-4 shadow-sm">
          <p class="responsive-text-medium font-semibold text-gray-800">{{ $app->scholarship->title ?? 'Unknown' }}</p>
          <p class="responsive-text-small text-gray-600 mt-1">
            Status: <span class="{{ 
              $app->progress === 'Approved' ? 'bg-green-100 text-green-700' : 
              ($app->progress === 'Rejected' ? 'bg-red-100 text-red-700' : 
              ($app->progress === 'Requires Revision' ? 'bg-yellow-100 text-yellow-700' : 
              'bg-blue-100 text-blue-700')) 
            }} px-2 py-0.5 rounded-full responsive-text-xs font-medium text-nowrap">
              {{ $app->progress }}
            </span>
          </p>
          <div class="mt-3 flex justify-end">
            <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg responsive-text-small">View</a>
          </div>
        </div>
      @empty
        <div class="text-center py-10 text-gray-500">
          <img src="{{ asset('assets/images/empty-search.jpg') }}" alt="No scholarships found"
              class="w-48 h-48 object-contain mx-auto mb-4 max-w-full sm:w-64 sm:h-64">
          <p class="responsive-text-small">No scholarship applications yet.</p>
        </div>
      @endforelse
    </div>
  </div>

  <form action="{{ route('logout') }}" method="POST" class="mt-10 w-full max-w-5xl flex justify-center md:justify-end">
    @csrf
    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg responsive-text-small shadow-md transition">
      Logout
    </button>
  </form>

</section>

@endsection
