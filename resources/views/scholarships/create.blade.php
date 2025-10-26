@extends('layouts.app')

@section('maincontent')

<div class="flex flex-col justify-center items-center my-8 md:my-20">

  <div class="w-[90%] lg:w-3/4">

    <div class="flex items-start mb-4">
      <a href="{{ route('scholarship.show') }}" class="cursor-pointer border border-gray-300 responsive-text-xs text-gray-600 hover:text-black py-1 px-2">
        ← Back
      </a>
    </div>
    
    <h1 class="responsive-text-xl font-bold text-center mb-3">General Intake Sheet</h1>

    <!-- I. Client’s Identifying Information -->
    <section class="border rounded-xl p-6">
      <h2 class="responsive-text-medium font-semibold mb-4">I. Client’s Identifying Information</h2>

      <!-- Row 1 -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
          <label class="block font-medium responsive-text-small">Client’s Name</label>
          <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" placeholder="Last, First, Middle" />
        </div>
        <div>
          <label class="block font-medium responsive-text-small">Sex</label>
          <select class="mt-1 w-full border rounded-lg p-2 responsive-text-xs">
            <option>Select</option>
            <option>Male</option>
            <option>Female</option>
          </select>
        </div>
        <div>
          <label class="block font-medium responsive-text-small">Age</label>
          <input type="number" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
      </div>

      <!-- Row 2 -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
          <label class="block font-medium responsive-text-small">Date of Birth</label>
          <input type="date" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
        <div>
          <label class="block font-medium responsive-text-small">Civil Status</label>
          <select class="mt-1 w-full border rounded-lg p-2 responsive-text-xs">
            <option>Select</option>
            <option>Single</option>
            <option>Married</option>
            <option>Others</option>
          </select>
        </div>
        <div>
          <label class="block font-medium responsive-text-small">Place of Birth</label>
          <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
      </div>

      <!-- Row 3 -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block font-medium responsive-text-small">Present Address</label>
          <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
        <div>
          <label class="block font-medium responsive-text-small">Contact Number</label>
          <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
      </div>

      <!-- Row 4 -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
          <label class="block font-medium responsive-text-small">Relationship to Beneficiary</label>
          <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
        <div>
          <label class="block font-medium responsive-text-small">Religion</label>
          <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
        <div>
          <label class="block font-medium responsive-text-small">Nationality</label>
          <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
      </div>

      <!-- Row 5 -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block font-medium responsive-text-small">Highest Educational Attainment</label>
          <select class="mt-1 w-full border rounded-lg p-2 responsive-text-xs">
            <option>Select</option>
            <option>Elementary</option>
            <option>High School</option>
            <option>Senior High School</option>
            <option>College Undergraduate</option>
            <option>College Graduate</option>
          </select>
        </div>
        <div>
          <label class="block font-medium responsive-text-small">PhilHealth No.</label>
          <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
      </div>

      <!-- Row 6 -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block font-medium responsive-text-small">Skill / Occupation</label>
          <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
        <div>
          <label class="block font-medium responsive-text-small">Estimated Monthly Income</label>
          <select class="mt-1 w-full border rounded-lg p-2 responsive-text-xs">
            <option>Select</option>
            <option>Less than ₱10,000</option>
            <option>₱10,001 - ₱20,000</option>
            <option>₱20,001 - ₱50,000</option>
            <option>₱50,001 - ₱100,000</option>
            <option>Above ₱100,000</option>
          </select>
        </div>
      </div>

      <!-- Row 7 -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block font-medium responsive-text-small">Mode of Admission</label>
          <select class="mt-1 w-full border rounded-lg p-2 responsive-text-xs">
            <option>Select</option>
            <option>Walk-in</option>
            <option>Referral</option>
            <option>4Ps Beneficiary</option>
          </select>
        </div>
        <div>
          <label class="block font-medium responsive-text-small">Referring Party</label>
          <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
      </div>

      <!-- Row 8 -->
      <div class="mb-4">
        <label class="block font-medium responsive-text-small">Address / Contact # of Referring Party</label>
        <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
      </div>
    </section>

    <!-- II. Beneficiary Identifying Information -->
    <section class="mt-10 border rounded-xl p-6">
      <h2 class="responsive-text-medium font-semibold mb-4">II. Beneficiary Identifying Information</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block font-medium responsive-text-small">Category</label>
          <select class="mt-1 w-full border rounded-lg p-2 responsive-text-xs">
            <option>Select</option>
            <option>NHTS-PR</option>
            <option>ISF</option>
            <option>Disadvantaged Individual</option>
            <option>Indigenous People</option>
            <option>Pantawid Beneficiary</option>
          </select>
        </div>
        <div>
          <label class="block font-medium responsive-text-small">ID No.</label>
          <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
          <label class="block font-medium responsive-text-small">Beneficiary’s Name</label>
          <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" placeholder="Last, First, Middle" />
        </div>
        <div>
          <label class="block font-medium responsive-text-small">Sex</label>
          <select class="mt-1 w-full border rounded-lg p-2 responsive-text-xs">
            <option>Select</option>
            <option>Male</option>
            <option>Female</option>
          </select>
        </div>
        <div>
          <label class="block font-medium responsive-text-small">Date of Birth</label>
          <input type="date" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
          <label class="block font-medium responsive-text-small">Present Address</label>
          <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
        <div>
          <label class="block font-medium responsive-text-small">Place of Birth</label>
          <input type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" />
        </div>
        <div>
          <label class="block font-medium responsive-text-small">Civil Status</label>
          <select class="mt-1 w-full border rounded-lg p-2 responsive-text-xs">
            <option>Select</option>
            <option>Single</option>
            <option>Married</option>
            <option>Others</option>
          </select>
        </div>
      </div>
    </section>

    <!-- III. Family Composition -->
    <section class="mt-10 border rounded-xl p-6">
      <h2 class="responsive-text-medium font-semibold mb-4">III. Beneficiary’s Family Composition</h2>

      <div class="overflow-x-auto mb-4">
        <table class="min-w-full border text-center responsive-text-xs">
          <thead class="bg-gray-100">
            <tr>
              <th class="border px-2 py-1">Last Name</th>
              <th class="border px-2 py-1">First Name</th>
              <th class="border px-2 py-1">Middle Name</th>
              <th class="border px-2 py-1">Sex</th>
              <th class="border px-2 py-1">Birthday</th>
              <th class="border px-2 py-1">Civil Status</th>
              <th class="border px-2 py-1">Relationship</th>
              <th class="border px-2 py-1">Highest Educational Attainment</th>
              <th class="border px-2 py-1">Skill / Occupation</th>
              <th class="border px-2 py-1">Estimated Monthly Income</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="border px-2 py-1"><input type="text" class="w-full responsive-text-xs" /></td>
              <td class="border px-2 py-1"><input type="text" class="w-full responsive-text-xs" /></td>
              <td class="border px-2 py-1"><input type="text" class="w-full responsive-text-xs" /></td>
              <td class="border px-2 py-1">
                <select class="w-full responsive-text-xs">
                  <option>Male</option>
                  <option>Female</option>
                </select>
              </td>
              <td class="border px-2 py-1"><input type="date" class="w-full responsive-text-xs" /></td>
              <td class="border px-2 py-1">
                <select class="w-full responsive-text-xs">
                  <option>Single</option>
                  <option>Married</option>
                  <option>Others</option>
                </select>
              </td>
              <td class="border px-2 py-1"><input type="text" class="w-full responsive-text-xs" /></td>
              <td class="border px-2 py-1">
                <select class="w-full responsive-text-xs">
                  <option>Elementary</option>
                  <option>High School</option>
                  <option>Senior High School</option>
                  <option>College Undergraduate</option>
                  <option>College Graduate</option>
                </select>
              </td>
              <td class="border px-2 py-1"><input type="text" class="w-full responsive-text-xs" /></td>
              <td class="border px-2 py-1">
                <select class="w-full responsive-text-xs">
                  <option>Less than ₱10,000</option>
                  <option>₱10,001 - ₱20,000</option>
                  <option>₱20,001 - ₱50,000</option>
                  <option>₱50,001 - ₱100,000</option>
                  <option>Above ₱100,000</option>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 responsive-text-small">+ Add Family Member</button>
    </section>

    <!-- Submit -->
    <div class="mt-10 text-right">
      <a href="{{ route('scholarship.upload') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 responsive-text-small cursor-pointer inline-block">Next</a>
    </div>
  </div>
</div>

@endsection
