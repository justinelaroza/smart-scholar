@extends('layouts.app')

@section('maincontent')

<section class="flex flex-col items-center justify-center my-8 md:my-20">
  <div class="w-[90%] lg:w-3/4 flex flex-col gap-5 md:gap-10">

    <div class="text-center">
      <h1 class="responsive-text-2xl font-bold text-blue-800 mb-2">About SmartScholar</h1>
      <p class="text-gray-600 responsive-text-small">Empowering students through innovation and accessibility</p>
    </div>

    <div class="flex flex-col md:flex-row gap-5 md:gap-10 items-center">
      <img src="{{ asset('assets/images/ss-logo.png') }}" alt="SmartScholar" class="w-full md:w-1/2 rounded-xl shadow-md border-t-4 border-blue-600">
      <div class="flex flex-col gap-3 text-gray-700">
        <p class="responsive-text-small leading-relaxed">
          <strong>SmartScholar</strong> is a digital platform that streamlines and modernizes the management of municipal scholarship programs.
          It aims to make scholarship applications, tracking, and verification faster, more transparent, and accessible to both students and administrators.
        </p>
        <p class="responsive-text-small leading-relaxed">
          With an easy-to-use interface and secure data management, SmartScholar connects deserving students with educational opportunities,
          supporting the local government’s mission to invest in the youth and their future.
        </p>
      </div>
    </div>

    <div class="grid md:grid-cols-2 gap-8 md:gap-12 mt-8">
      <div class="bg-white shadow-md rounded-xl p-6 md:p-8 border-t-4 border-blue-600">
        <h2 class="responsive-text-large font-semibold text-blue-800 mb-3">Our Mission</h2>
        <p class="responsive-text-small text-gray-700 leading-relaxed">
          To provide an efficient and transparent system that connects deserving students with scholarship opportunities.
          SmartScholar ensures that every applicant is given equal access to educational support through innovation and integrity.
        </p>
      </div>

      <div class="bg-white shadow-md rounded-xl p-6 md:p-8 border-t-4 border-blue-600">
        <h2 class="responsive-text-large font-semibold text-blue-800 mb-3">Our Vision</h2>
        <p class="responsive-text-small text-gray-700 leading-relaxed">
          Our vision is to empower bright students through education and opportunity,
          helping them achieve their full potential for a better and more prosperous future.
        </p>
      </div>
    </div>

    <div class="mt-16 flex flex-col md:flex-row gap-8 md:gap-12 items-center bg-white rounded-xl shadow-md p-6 md:p-10 border-l-4 border-blue-600">
      <img src="{{ asset('assets/images/pg-logo.png') }}" alt="Municipality of Padre Garcia" class="w-full md:w-1/2 rounded-xl shadow-sm">
      <div class="flex flex-col gap-3 text-gray-700">
        <h2 class="responsive-text-large font-semibold text-blue-800 mb-2">Municipality of Padre Garcia, Batangas</h2>
        <p class="responsive-text-small leading-relaxed">
          The <strong>Municipality of Padre Garcia</strong> is the driving force behind SmartScholar, offering this initiative
          as part of its ongoing mission to promote educational development and youth empowerment in the community.
        </p>
        <p class="responsive-text-small leading-relaxed">
          Through SmartScholar, the local government demonstrates its commitment to <strong>transparency, accountability, and opportunity</strong>.
          Every step of the scholarship process — from application to approval — is handled with fairness and efficiency,
          ensuring that qualified students receive the support they truly deserve.
        </p>
        <p class="responsive-text-small leading-relaxed">
          By integrating technology with good governance, Padre Garcia continues to invest in the future of its citizens — one scholar at a time.
        </p>
      </div>
    </div>

    <div class="mt-10 text-center flex flex-col gap-3">
      <h3 class="responsive-text-large font-semibold text-blue-800">Contact Us</h3>
      <div class="text-gray-700 responsive-text-small">
        <p>Poblacion, Padre Garcia, Batangas</p>
        <p>+63 951 965 9541 | +69 993 897 0053</p>
        <p>SmartScholar@gmail.com</p>
      </div>
    </div>

  </div>
</section>

@endsection
