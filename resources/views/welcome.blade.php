@extends('layouts.app')

@section('content')
<!-- Hero Section (SMEDAN Initiative) -->
<section class="bg-green-900 min-h-[80vh] flex items-center">
  <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 md:px-6 py-10 md:py-16">
    <!-- Left: Text -->
    <div class="md:w-1/2 text-white w-full">
      <div class="text-sm font-semibold mb-2">SMEDAN Initiative</div>
      <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
        Digital Maturity <span class="text-green-400">Assessment for</span><br>MSMEs!
      </h1>
      <p class="text-base sm:text-lg mb-8">Unlock your business potential with our cutting-edge assessment tool.<br>In just 15 minutes, discover where you stand and get a personilized roadmap to digital success.</p>
      <div class="flex flex-col sm:flex-row gap-4 mb-8 w-full">
        <a href="{{ route('dma') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-3 sm:px-8 sm:py-4 rounded-lg text-base sm:text-lg transition flex items-center gap-2 w-full sm:w-auto justify-center">Start Assessment <span>&rarr;</span></a>
        <button class="border border-white text-white font-bold px-6 py-3 sm:px-8 sm:py-4 rounded-lg text-base sm:text-lg transition hover:bg-white hover:text-green-900 w-full sm:w-auto justify-center">Learn More</button>
      </div>
      <div class="flex items-center gap-3 mt-4">
        <!-- Avatars -->
        <div class="flex -space-x-2">
          <img src="{{ asset('images/african-business-man-1.jpg') }}" class="w-8 h-8 rounded-full border-2 border-white" />
          <img src="{{ asset('images/african-business-woman-1.jpg') }}" class="w-8 h-8 rounded-full border-2 border-white" />
          <img src="{{ asset('images/african-business-man-2.jpg') }}" class="w-8 h-8 rounded-full border-2 border-white" />
        </div>
        <span class="text-white text-sm sm:text-base font-semibold ml-2">500+ businesses already assessed</span>
      </div>
    </div>
    <!-- Right: Image Placeholder with badge -->
    <div class="md:w-1/2 flex justify-center mt-12 md:mt-0 relative w-full">
      <div class="bg-gray-100 rounded-xl w-full max-w-[350px] sm:max-w-[420px] md:max-w-[580px] h-[220px] sm:h-[300px] md:h-[400px] flex items-center justify-center overflow-hidden relative">
        <img src="https://images.unsplash.com/photo-1503676382389-4809596d5290?auto=format&fit=crop&w=600&q=80" alt="Assessment" class="object-cover w-full h-full rounded-xl" />
        <span class="absolute top-4 right-4 bg-white text-green-900 font-bold px-4 py-2 rounded-full text-xs sm:text-sm shadow">15-min assessment</span>
      </div>
    </div>
  </div>
</section>

<!-- What is DMA Section -->
<section class="bg-white py-16 md:py-20">
  <div class="container mx-auto px-4 md:px-6">
    <h2 class="text-2xl sm:text-3xl md:text-5xl font-extrabold text-green-900 text-center mb-6">What is a Digital Maturity Assessment?</h2>
    <p class="text-base sm:text-xl text-gray-600 text-center max-w-3xl mx-auto mb-12 md:mb-16">A Digital Maturity Assessment (DMA) is a comprehensive evaluation of an organization's digital capabilities, processes, and culture. It helps identify strengths, weaknesses, and opportunities for digital transformation.</p>
    <div class="flex flex-col md:flex-row items-center justify-center gap-8 md:gap-12 max-w-6xl mx-auto">
      <!-- Left: Image Placeholder -->
      <div class="bg-gray-100 rounded-xl w-full max-w-[420px] h-[180px] sm:h-[240px] flex items-center justify-center mb-8 md:mb-0">
        <span class="text-gray-300 text-4xl">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5" /></svg>
        </span>
      </div>
      <!-- Right: Features List -->
      <div class="flex-1 w-full">
        <ul class="space-y-8">
          <li class="flex items-start gap-4">
            <span class="mt-1 text-green-600">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            </span>
            <div>
              <span class="font-bold text-green-900">Benchmark Your Digital Capabilities</span>
              <p class="text-gray-600">Compare your organization's digital maturity against industry standards and competitors.</p>
            </div>
          </li>
          <li class="flex items-start gap-4">
            <span class="mt-1 text-green-600">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            </span>
            <div>
              <span class="font-bold text-green-900">Identify Improvement Opportunities</span>
              <p class="text-gray-600">Discover areas where digital transformation can drive the most value for your business.</p>
            </div>
          </li>
          <li class="flex items-start gap-4">
            <span class="mt-1 text-green-600">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            </span>
            <div>
              <span class="font-bold text-green-900">Create a Roadmap for Success</span>
              <p class="text-gray-600">Develop a strategic plan to enhance your digital capabilities and drive business growth.</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- 6 Modules of Digital Maturity Section -->
<section class="bg-green-50 py-16 md:py-20">
  <div class="container mx-auto px-4 md:px-6">
    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-green-900 text-center mb-6">6 Modules of Digital Maturity</h2>
    <p class="text-base sm:text-lg text-gray-600 text-center max-w-4xl mx-auto mb-12 md:mb-16">Our comprehensive assessment evaluates your organisation across these six critical dimensions of digital maturity.</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 max-w-6xl mx-auto">
      <!-- Module 1 -->
      <div class="bg-white rounded-xl border border-green-100 p-6 md:p-8 shadow-sm">
        <div class="flex flex-col items-start mb-3">
          <span class="text-green-600 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v2m0 16v2m8-8h2M2 12H4m15.364-7.364l1.414 1.414M4.222 19.778l1.414-1.414M19.778 19.778l-1.414-1.414M4.222 4.222l1.414 1.414"/></svg>
          </span>
          <span class="font-bold text-lg md:text-xl text-green-900">Internet Access, Technology Use and Digital Readiness</span>
        </div>
        <p class="text-gray-600 text-sm md:text-base">Assess your organization's connectivity infrastructure, technology adoption levels, and overall preparedness for digital initiatives.</p>
      </div>
      <!-- Module 2 -->
      <div class="bg-white rounded-xl border border-green-100 p-6 md:p-8 shadow-sm">
        <div class="flex flex-col items-start mb-3">
          <span class="text-green-600 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5"/><circle cx="12" cy="7" r="4"/></svg>
          </span>
          <span class="font-bold text-lg md:text-xl text-green-900">Digitalisation of Business Processes, People and Skills</span>
        </div>
        <p class="text-gray-600 text-sm md:text-base">Evaluate how effectively your organization has digitized workflows, developed talent, and built digital competencies across teams.</p>
      </div>
      <!-- Module 3 -->
      <div class="bg-white rounded-xl border border-green-100 p-6 md:p-8 shadow-sm">
        <div class="flex flex-col items-start mb-3">
          <span class="text-green-600 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </span>
          <span class="font-bold text-lg md:text-xl text-green-900">Digital Presence &amp; Data Management</span>
        </div>
        <p class="text-gray-600 text-sm md:text-base">Measure your organization's online visibility, brand consistency across digital channels, and capabilities for collecting and utilizing data effectively.</p>
      </div>
      <!-- Module 4 -->
      <div class="bg-white rounded-xl border border-green-100 p-6 md:p-8 shadow-sm">
        <div class="flex flex-col items-start mb-3">
          <span class="text-green-600 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18"/><rect x="7" y="13" width="2" height="5" rx="1"/><rect x="11" y="9" width="2" height="9" rx="1"/><rect x="15" y="5" width="2" height="13" rx="1"/></svg>
          </span>
          <span class="font-bold text-lg md:text-xl text-green-900">Digital Transactions, Cybersecurity, Automation &amp; Emerging Technologies</span>
        </div>
        <p class="text-gray-600 text-sm md:text-base">Assess your digital payment systems, security protocols, process automation maturity, and adoption of cutting-edge technologies.</p>
      </div>
      <!-- Module 5 -->
      <div class="bg-white rounded-xl border border-green-100 p-6 md:p-8 shadow-sm">
        <div class="flex flex-col items-start mb-3">
          <span class="text-green-600 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5"/><circle cx="12" cy="7" r="4"/></svg>
          </span>
          <span class="font-bold text-lg md:text-xl text-green-900">Green Digitalisation &amp; Readiness for Digital Transformation</span>
        </div>
        <p class="text-gray-600 text-sm md:text-base">Evaluate your sustainable digital practices and overall organizational preparedness to embrace and implement digital transformation initiatives.</p>
      </div>
      <!-- Module 6 -->
      <div class="bg-white rounded-xl border border-green-100 p-6 md:p-8 shadow-sm">
        <div class="flex flex-col items-start mb-3">
          <span class="text-green-600 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
          </span>
          <span class="font-bold text-lg md:text-xl text-green-900">Validation Section</span>
        </div>
        <p class="text-gray-600 text-sm md:text-base">Confirm assessment accuracy through cross-verification of responses, ensuring a reliable foundation for your digital transformation roadmap.</p>
      </div>
    </div>
  </div>
</section>

<!-- Our Partners Section -->
<section class="bg-white py-16 md:py-20">
  <div class="container mx-auto px-4 md:px-6">
    <h2 class="text-2xl sm:text-3xl md:text-5xl font-extrabold text-green-900 text-center mb-6">Our Partners</h2>
    <p class="text-base sm:text-xl text-gray-500 text-center max-w-4xl mx-auto mb-12 md:mb-16">We collaborate with leading organizations to deliver comprehensive digital maturity assessments and transformation strategies.</p>
    <div class="flex justify-center">
      <div class="max-w-4xl mx-auto">
        <img src="{{ asset('images/partners/partner-logos.png') }}" alt="Logo" class="w-full">
      </div>
    </div>
  </div>
</section>

<!-- Ready to Assess Section -->
<section class="bg-green-900 py-16 md:py-24 flex items-center justify-center">
  <div class="w-full flex flex-col items-center px-4 md:px-0">
    <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white text-center mb-6">Ready to Assess Your Digital Maturity?</h2>
    <p class="text-lg sm:text-2xl text-gray-100 text-center mb-8 md:mb-12 max-w-3xl">Take the first step towards digital transformation by understanding where you stand today.</p>
    <div class="flex flex-col md:flex-row gap-4 justify-center items-center w-full max-w-xl">
      <button class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-3 sm:px-8 sm:py-4 rounded-lg text-base sm:text-lg transition w-full md:w-auto">Start Your Assessment</button>
    </div>
  </div>
</section>

<!-- EU Disclaimer Section -->
<div class="flex items-center gap-4 mt-8 mb-4 px-4">
  <img src="https://upload.wikimedia.org/wikipedia/commons/b/b7/Flag_of_Europe.svg" alt="EU Logo" class="w-12 h-8 object-contain" />
  <span class="text-[#205493] text-base">
    This publication was co-funded by the European Union. Its contents are the sole responsibility of GIZ Nigeria and can in no way be taken to reflect the views of the European Union.
  </span>
</div>

@endsection

@push('scripts')
<script>
  // Simple mobile menu toggle
  document.addEventListener('DOMContentLoaded', function() {
    var toggle = document.getElementById('mobile-menu-toggle');
    var menu = document.getElementById('mobile-menu');
    if (toggle && menu) {
      toggle.addEventListener('click', function() {
        menu.classList.toggle('hidden');
      });
    }
  });
</script>
@endpush


