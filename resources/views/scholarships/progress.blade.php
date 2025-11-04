@extends('layouts.app')

@section('maincontent')
<div class="bg-white flex items-center justify-center my-8 md:my-20">
  <div class="w-[90%] lg:w-3/4">

    <div class="flex items-start mb-4">
      <a href="{{ route('profile') }}" class="cursor-pointer border border-gray-300 responsive-text-xs text-gray-600 hover:text-black py-1 px-2">← Back</a>
    </div>

    <div class="bg-white shadow-lg rounded-2xl p-6 md:p-10">
      <h1 class="responsive-text-large font-bold mb-6 text-gray-800">Scholarship Progress — {{ $scholarship->title }}</h1>

      {{-- Progress Bar --}}
      @php
        $statuses = ['Under Review', 'Requires Revision', 'Approved', 'Rejected'];
        $current = $fileUpload->progress;
        $progressPercent = (array_search($current, $statuses) + 1) / count($statuses) * 100;
      @endphp

      <div class="w-full mb-10">
        <div class="h-2 bg-gray-200 rounded-full">
          <div class="h-2 {{ $current === 'Rejected' ? 'bg-red-500' : 'bg-green-500' }} rounded-full transition-all duration-500" style="width: {{ $progressPercent }}%"></div>
        </div>
        <div class="flex justify-between mt-2">
          @foreach ($statuses as $status)
            <span class="responsive-text-xxs font-medium {{ $status == $current ? 'text-blue-500' : 'text-gray-500' }}">{{ $status }}</span>
          @endforeach
        </div>
      </div>

      {{-- Document Table --}}
      <form action="{{ route('fileupload.resubmit', ['id' => $fileUpload->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="overflow-x-auto mt-6">
          <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 responsive-text-xs w-1/3">Document</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 responsive-text-xs w-1/3">Current File</th>

                @if ($fileUpload->progress === 'Requires Revision' || $fileUpload->progress === 'Approved' || $fileUpload->progress === 'Rejected')
                  <th class="px-4 py-3 text-left font-semibold text-gray-700 responsive-text-xs w-1/3">Remarks / Action</th>
                @endif
              </tr>
            </thead>

            <tbody>
              @php
                $documents = [
                  'school_registration_form' => 'School Registration Form',
                  'barangay_clearance' => 'Barangay Clearance',
                  'certificate_of_indigency' => 'Certificate of Indigency',
                  'school_id_front' => 'School ID (Front)',
                  'school_id_back' => 'School ID (Back)',
                  'cedula' => 'Cedula',
                  'breakdown_of_expenses' => 'Breakdown of Expenses',
                ];
              @endphp

              @foreach ($documents as $field => $label)
                @php
                  $remarkField = 'remarks_' . $field;
                  $remark = $fileUpload->$remarkField;
                @endphp

                <tr class="border-t hover:bg-gray-50 transition">
                  {{-- Document name --}}
                  <td class="px-4 py-3 responsive-text-xs text-gray-800 font-medium">{{ $label }}</td>

                  {{-- File view --}}
                  <td class="px-4 py-3">
                    <a href="{{ asset('storage/' . $fileUpload->$field) }}" target="_blank" class="text-blue-600 hover:underline responsive-text-xs">
                      View File
                    </a>
                  </td>

                  {{-- Remarks or upload input --}}
                  @if ($fileUpload->progress === 'Requires Revision')
                    <td class="px-4 py-3">
                      @if ($remark !== 'No Remarks')
                        <div class="flex flex-col gap-2">
                          <span class="text-red-500 responsive-text-xs font-medium">{{ $remark }}</span>
                          <input type="file" name="{{ $field }}" accept=".pdf,.jpg,.png,.jpeg" class="border border-gray-300 rounded px-2 py-1 text-xs w-full sm:w-3/4" required>
                        </div>
                      @else
                        <span class="text-green-600 responsive-text-xs font-medium">✅ Done</span>
                      @endif
                    </td>
                  @elseif(in_array($fileUpload->progress, ['Approved', 'Rejected']))
                    <td class="px-4 py-3">
                      <span class="responsive-text-xs font-medium {{ $remark !== 'No Remarks' ? 'text-gray-700' : 'text-green-600' }}">
                        {{ $remark }}
                      </span>
                    </td>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        @if ($fileUpload->progress === 'Requires Revision')
          <div class="mt-8 text-center">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg responsive-text-small transition">
              Resubmit All
            </button>
          </div>
        @endif
      </form>
    </div>
  </div>
</div>
@endsection
