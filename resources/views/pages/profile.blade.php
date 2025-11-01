@extends('layouts.app')

@section('maincontent')

<section class="relative bg-gray-100 min-h-[calc(100vh-80px)] flex flex-col items-center justify-start py-16 px-6 md:px-20">

  <div class="bg-white w-full max-w-5xl rounded-3xl shadow-lg p-8 md:p-10 mb-10">
    <div class="flex flex-col md:flex-row items-center md:items-start gap-6">

      <div class="flex-shrink-0">

        <div class="w-32 h-32 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-4xl font-bold">
          {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) ?? 'U' }}
        </div>
        
      </div>

      <div class="flex flex-col w-full text-center md:text-left">

        <h2 class="responsive-text-2xl font-extrabold text-[#282740]"> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
        <p class="text-gray-600 mt-1 responsive-text-small">Account Code: <span class="font-medium text-blue-600">{{ Auth::user()->account_code }}</span></p>
        <p class="text-gray-600 responsive-text-small">Email: <span class="font-medium">{{ Auth::user()->email }}</span></p>
        <p class="text-gray-600 responsive-text-small">Phone: <span class="font-medium">{{ Auth::user()->phone_number }}</span></p>
        <p class="text-gray-600 responsive-text-small">Address: <span class="font-medium">{{ Auth::user()->full_address }}</span></p>
        <p class="text-gray-600 responsive-text-small">Gender: <span class="font-medium">{{ Auth::user()->gender }}</span></p>
        <p class="text-gray-600 responsive-text-small">Birthday: <span class="font-medium">{{ \Carbon\Carbon::parse(Auth::user()->birthday)->format('F d, Y') }}</span> </p>

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
          <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
            <td class="px-6 py-4 font-medium text-gray-800 responsive-text-small">Padre Garcia Academic Excellence</td>
            <td class="px-6 py-4">
              <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">Approved</span>
            </td>
            <td class="px-6 py-4 text-center">
              <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">View</a>
            </td>
          </tr>
          <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
            <td class="px-6 py-4 font-medium text-gray-800 responsive-text-small">Municipal Leadership Grant</td>
            <td class="px-6 py-4">
              <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">Pending</span>
            </td>
            <td class="px-6 py-4 text-center">
              <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">View</a>
            </td>
          </tr>
        </tbody>

      </table>

    </div>

    <!-- Mobile Cards -->
    <div class="md:hidden space-y-4">

      <div class="border border-gray-200 rounded-xl p-4 shadow-sm">
        <p class="responsive-text-small font-semibold text-gray-800">Padre Garcia Academic Excellence</p>
        <p class="responsive-text-xs text-gray-600 mt-1">
          Status: <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-medium">Approved</span>
        </p>
        <div class="mt-3 flex justify-end">
          <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg responsive-text-xs">View</a>
        </div>
      </div>

      <div class="border border-gray-200 rounded-xl p-4 shadow-sm">
        <p class="responsive-text-small font-semibold text-gray-800">Municipal Leadership Grant</p>
        <p class="responsive-text-xs text-gray-600 mt-1">
          Status: <span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full text-xs font-medium">Pending</span>
        </p>
        <div class="mt-3 flex justify-end">
          <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg responsive-text-xs">View</a>
        </div>
      </div>
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
