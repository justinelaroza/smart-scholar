@extends('layouts.app')

@section('maincontent')

<div class="flex flex-col justify-center items-center my-8 md:my-20">

  <div class="w-[90%] lg:w-3/4">
    
    <div class="flex items-start mb-4">
      <a href="{{ route('scholarship.show', ['id' => $scholarship->id]) }}" class="cursor-pointer border border-gray-300 responsive-text-xs text-gray-600 hover:text-black py-1 px-2">
        ← Back
      </a>
    </div>

    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 mb-6 rounded-md">
      <p class="responsive-text-small">
        ⚠️ <strong>Important Notice:</strong> You are only allowed to fill out this General Intake Sheet <strong>once</strong>.
        Please review all information carefully before submitting. If a particular field or detail does not apply to you,
        kindly enter <strong>N/A</strong> instead of leaving it blank.
      </p>
    </div>
    
    <h1 class="responsive-text-xl font-bold text-center mb-3">General Intake Sheet</h1>

    <form action="{{ route('scholarship.generalinfo', ['id' => $scholarship->id]) }}" method="POST">
      @csrf
      <!-- I. Client’s Identifying Information -->
      <section class="border rounded-xl p-6">
        <h2 class="responsive-text-medium font-semibold mb-4">I. Client’s Identifying Information</h2>

        <!-- Row 1 -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
          <div>
            <label class="block font-medium responsive-text-small">Client’s Name</label>
            <input name="client_name" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" placeholder="Last, First, Middle" required />
          </div>
          <div>
            <label class="block font-medium responsive-text-small">Sex</label>
            <select name="client_sex" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div>
            <label class="block font-medium responsive-text-small">Age</label>
            <input name="client_age" type="number" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required />
          </div>
        </div>

        <!-- Row 2 -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
          <div>
            <label class="block font-medium responsive-text-small">Date of Birth</label>
            <input name="client_birthdate" type="date" class="datepicker mt-1 w-full border rounded-lg p-2 responsive-text-xs" placeholder="Birthday" required />
          </div>
          <div>
            <label class="block font-medium responsive-text-small">Civil Status</label>
            <select name="client_civil_status" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required>
              <option value="Single">Single</option>
              <option value="Married">Married</option>
              <option value="Others">Others</option>
            </select>
          </div>
          <div>
            <label class="block font-medium responsive-text-small">Place of Birth</label>
            <input name="client_birthplace" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required />
          </div>
        </div>

        <!-- Row 3 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div>
            <label class="block font-medium responsive-text-small">Present Address</label>
            <input name="client_address" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required />
          </div>
          <div>
            <label class="block font-medium responsive-text-small">Contact Number</label>
            <input name="client_contact" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required />
          </div>
        </div>

        <!-- Row 4 -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
          <div>
            <label class="block font-medium responsive-text-small">Relationship to Beneficiary</label>
            <input name="client_relationship" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required />
          </div>
          <div>
            <label class="block font-medium responsive-text-small">Religion</label>
            <input name="client_religion" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required />
          </div>
          <div>
            <label class="block font-medium responsive-text-small">Nationality</label>
            <input name="client_nationality" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required />
          </div>
        </div>

        <!-- Row 5 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div>
            <label class="block font-medium responsive-text-small">Highest Educational Attainment</label>
            <select name="client_education" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required>
              <option value="Elementary">Elementary</option>
              <option value="High School">High School</option>
              <option value="Senior High School">Senior High School</option>
              <option value="College Undergraduate">College Undergraduate</option>
              <option value="College Graduate">College Graduate</option>
            </select>
          </div>
          <div>
            <label class="block font-medium responsive-text-small">PhilHealth No.</label>
            <input name="client_philhealth" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required />
          </div>
        </div>

        <!-- Row 6 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div>
            <label class="block font-medium responsive-text-small">Skill / Occupation</label>
            <input name="client_occupation" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required />
          </div>
          <div>
            <label class="block font-medium responsive-text-small">Estimated Monthly Income</label>
            <select name="client_income" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required>
              <option value="less_10k">Less than ₱10,000</option>
              <option value="10k_20k">₱10,001 - ₱20,000</option>
              <option value="20k_50k">₱20,001 - ₱50,000</option>
              <option value="50k_100k">₱50,001 - ₱100,000</option>
              <option value="above_100k">Above ₱100,000</option>
            </select>
          </div>
        </div>

        <!-- Row 7 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div>
            <label class="block font-medium responsive-text-small">Mode of Admission</label>
            <select name="client_admission_mode" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required>
              <option value="Walk-in">Walk-in</option>
              <option value="Referral">Referral</option>
              <option value="4Ps Beneficiary">4Ps Beneficiary</option>
            </select>
          </div>
          <div>
            <label class="block font-medium responsive-text-small">Referring Party</label>
            <input name="client_referring_party" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required />
          </div>
        </div>

        <div class="mb-4">
          <label class="block font-medium responsive-text-small">Address / Contact # of Referring Party</label>
          <input name="client_referring_contact" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required />
        </div>
      </section>

      <!-- II. Beneficiary Identifying Information -->
      <section class="mt-10 border rounded-xl p-6">
        <h2 class="responsive-text-medium font-semibold mb-4">II. Beneficiary Identifying Information</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div>
            <label class="block font-medium responsive-text-small">Category</label>
            <select name="beneficiary_category" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required>
              <option value="NHTS-PR">NHTS-PR</option>
              <option value="ISF">ISF</option>
              <option value="Disadvantaged Individual">Disadvantaged Individual</option>
              <option value="Indigenous People">Indigenous People</option>
              <option value="Pantawid Beneficiary">Pantawid Beneficiary</option>
            </select>
          </div>
          <div>
            <label class="block font-medium responsive-text-small">ID No.</label>
            <input name="beneficiary_id_no" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required />
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
          <div>
            <label class="block font-medium responsive-text-small">Beneficiary’s Name</label>
            <input name="beneficiary_name" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" placeholder="Last, First, Middle" required />
          </div>
          <div>
            <label class="block font-medium responsive-text-small">Sex</label>
            <select name="beneficiary_sex" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div>
            <label class="block font-medium responsive-text-small">Date of Birth</label>
            <input name="beneficiary_birthdate" type="date" class="datepicker mt-1 w-full border rounded-lg p-2 responsive-text-xs" placeholder="Birthday" required />
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
          <div>
            <label class="block font-medium responsive-text-small">Present Address</label>
            <input name="beneficiary_address" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required />
          </div>
          <div>
            <label class="block font-medium responsive-text-small">Place of Birth</label>
            <input name="beneficiary_birthplace" type="text" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required />
          </div>
          <div>
            <label class="block font-medium responsive-text-small">Civil Status</label>
            <select name="beneficiary_civil_status" class="mt-1 w-full border rounded-lg p-2 responsive-text-xs" required>
              <option value="Single">Single</option>
              <option value="Married">Married</option>
              <option value="Others">Others</option>
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
                <th class="border px-2 py-1">Action</th>
              </tr>
            </thead>
            <tbody id="family-table-body">
              <tr>
                <td class="border px-2 py-1"><input name="family_members[0][last_name]" type="text" class="w-full responsive-text-xs" required /></td>
                <td class="border px-2 py-1"><input name="family_members[0][first_name]" type="text" class="w-full responsive-text-xs" required /></td>
                <td class="border px-2 py-1"><input name="family_members[0][middle_name]" type="text" class="w-full responsive-text-xs" required /></td>
                <td class="border px-2 py-1">
                  <select name="family_members[0][sex]" class="w-full responsive-text-xs" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </td>
                <td class="border px-2 py-1"><input name="family_members[0][birthdate]" type="date" class="w-full responsive-text-xs" required /></td>
                <td class="border px-2 py-1">
                  <select name="family_members[0][civil_status]" class="w-full responsive-text-xs" required>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Others">Others</option>
                  </select>
                </td>
                <td class="border px-2 py-1"><input name="family_members[0][relationship]" type="text" class="w-full responsive-text-xs" required /></td>
                <td class="border px-2 py-1">
                  <select name="family_members[0][education]" class="w-full responsive-text-xs" required>
                    <option value="Elementary">Elementary</option>
                    <option value="High School">High School</option>
                    <option value="Senior High School">Senior High School</option>
                    <option value="College Undergraduate">College Undergraduate</option>
                    <option value="College Graduate">College Graduate</option>
                  </select>
                </td>
                <td class="border px-2 py-1"><input name="family_members[0][occupation]" type="text" class="w-full responsive-text-xs" required /></td>
                <td class="border px-2 py-1">
                  <select name="family_members[0][income]" class="w-full responsive-text-xs" required>
                    <option value="less_10k">Less than ₱10,000</option>
                    <option value="10k_20k">₱10,001 - ₱20,000</option>
                    <option value="20k_50k">₱20,001 - ₱50,000</option>
                    <option value="50k_100k">₱50,001 - ₱100,000</option>
                    <option value="above_100k">Above ₱100,000</option>
                  </select>
                </td>
                <td class="border px-2 py-1">
                  <button type="button" class="remove-row text-red-500 hover:text-red-700 text-sm cursor-pointer">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <button type="button" id="add-family-row" class="mt-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 responsive-text-small cursor-pointer">
          + Add Family Member
        </button>
      </section>

      <!-- Submit -->
      <div class="mt-10 text-right">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 responsive-text-small cursor-pointer inline-block">Submit</button>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
  @vite(['resources/js/pages/scholarship.js'])
@endsection
