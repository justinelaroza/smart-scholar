@extends('layouts.app')

@section('maincontent')

<section class="flex flex-col items-center justify-center my-8 md:my-20">
  <div class="w-[90%] lg:w-3/4 flex flex-col gap-6 md:gap-10">

    <!-- Title -->
    <div class="text-center">
      <h1 class="text-2xl md:text-4xl font-bold text-blue-800 mb-2">Support & Frequently Asked Questions</h1>
      <p class="text-gray-600 responsive-text-small">Everything you need to know about SmartScholar</p>
    </div>

    <!-- FAQ Section -->
    <div class="bg-white rounded-xl shadow-md p-6 md:p-10 flex flex-col gap-4 border-t-4 border-blue-600">
      @php
        $faqs = [
          ['question' => 'What type of documents do I need to submit?', 'answer' => "You need to upload the following: school registration form, barangay clearance, certificate of indigency, front and back of your school ID, cedula, and a breakdown of expenses."],
          ['question' => 'Where should I live to be eligible for a scholarship?', 'answer' => "You must be a resident of <strong>Padre Garcia, Batangas</strong>."],
          ['question' => 'Is there an age limit?', 'answer' => "No specific age limit. Any qualified student may apply."],
          ['question' => 'What grade level can apply?', 'answer' => "Any student may apply unless a specific scholarship sets its own grade requirement."],
          ['question' => 'Can I create my general information sheet more than once?', 'answer' => "No, it can only be created once. Please ensure all details are correct before submitting."],
          ['question' => 'Can I edit my general information after submission?', 'answer' => "No, once submitted it cannot be changed. Double-check before finalizing."],
          ['question' => 'What is a breakdown of expenses?', 'answer' => "A detailed list of how you plan to use the scholarship funds. Example: ₱1,000 for transportation, ₱1,000 for food, ₱500 for supplies."],
          ['question' => 'Do I need to have my school registration form certified?', 'answer' => "No, just make sure the image is clear and readable."],
          ['question' => 'When do Barangay Clearance and Certificate of Indigency expire?', 'answer' => "They are valid for <strong>6 months</strong> from the date of issuance."],
          ['question' => 'What kind of ID do I need?', 'answer' => "A valid school ID that includes your signature."],
          ['question' => 'Where can I track my application progress?', 'answer' => "You can view all your scholarships and their statuses in your <strong>Profile</strong> section."],
          ['question' => 'Can I re-upload my documents?', 'answer' => "Yes. If a document requires revision, you’ll see a remark in your Profile where you can re-submit the required files."],
          ['question' => 'If I get rejected, can I apply again?', 'answer' => "You cannot reapply for the same scholarship, but you may apply for other available ones."],
          ['question' => 'Do I need to register before applying?', 'answer' => "Yes. You must have a SmartScholar account to apply for any scholarship."],
          ['question' => 'Can I have multiple accounts?', 'answer' => "No. Each individual may only register once. Duplicate or fraudulent accounts may be warned or removed."],
          ['question' => 'What happens after my application is approved?', 'answer' => "Once approved, go to your Profile → Scholarships → select your approved scholarship. You’ll see a QR code that must be presented at the payout center."],
          ['question' => 'Where is the payout center?', 'answer' => "Once the payout schedule is ready, you’ll receive a text message with the time and location. It’s also displayed next to your QR code."],
          ['question' => 'Who manages SmartScholar?', 'answer' => "SmartScholar is managed and operated by the <strong>Municipality of Padre Garcia, Batangas</strong>, offering transparency and fair access to local scholarship programs."],
        ];
      @endphp

      <div id="faq-list" class="flex flex-col divide-y divide-gray-200 cursor-pointer">
        @foreach ($faqs as $index => $faq)
          <div class="py-4">
            <button 
              class="w-full text-left flex items-center justify-between font-semibold text-blue-800 responsive-text-small focus:outline-none faq-toggle cursor-pointer"
              data-index="{{ $index }}">
              <span>{!! $faq['question'] !!}</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div class="faq-answer hidden mt-2 text-gray-700 responsive-text-xs leading-relaxed">
              {!! $faq['answer'] !!}
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Municipality Section -->
    <div class="flex flex-col md:flex-row gap-6 md:gap-10 items-center bg-white p-6 rounded-xl shadow-inner mt-6 border-t-4 border-blue-600">
      <img src="{{ asset('assets/images/ss-logo.png') }}" alt="Municipality of Padre Garcia" class="w-full md:w-1/2 rounded-lg shadow-md">
      <div class="text-gray-700 flex flex-col gap-3">
        <h2 class="text-xl md:text-2xl font-semibold text-blue-800">Transparency and Service</h2>
        <p class="responsive-text-small leading-relaxed">
          All scholarships under SmartScholar are funded and supervised by the <strong>Municipality of Padre Garcia, Batangas</strong>.
          The system ensures fairness, transparency, and accountability by providing digital access to scholarship progress and remarks.
        </p>
      </div>
    </div>

  </div>
</section>

@endsection

@section('scripts')

  @vite(['resources/js/pages/support.js'])
  
@endsection
