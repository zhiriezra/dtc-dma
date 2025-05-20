@extends('layouts.app')

@section('content')
<section class="bg-white py-16 md:py-20">
    <div class="container mx-auto px-4 md:px-6">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-green-900 text-center mb-8">Digital Maturity Assessment Terms</h1>
        <p class="text-base sm:text-lg text-gray-600 text-center max-w-3xl mx-auto mb-12">Understanding the key terms and concepts used in our Digital Maturity Assessment.</p>

        <div class="max-w-4xl mx-auto space-y-8">
            <!-- Digital Maturity -->
            <div class="bg-white rounded-xl border border-green-100 p-6 shadow-sm">
                <h2 class="text-xl font-bold text-green-900 mb-3">Digital Maturity</h2>
                <p class="text-gray-600">The level of an organisation's readiness and capability to leverage digital technologies and processes to achieve its business objectives. It encompasses technology adoption, digital skills, and organisational culture.</p>
            </div>

            <!-- MSME -->
            <div class="bg-white rounded-xl border border-green-100 p-6 shadow-sm">
                <h2 class="text-xl font-bold text-green-900 mb-3">MSME (Micro, Small, and Medium Enterprises)</h2>
                <p class="text-gray-600">Businesses that fall within specific size criteria based on their number of employees, annual turnover, or total assets. These enterprises form the backbone of many economies and are crucial for economic development.</p>
            </div>

            <!-- Digital Transformation -->
            <div class="bg-white rounded-xl border border-green-100 p-6 shadow-sm">
                <h2 class="text-xl font-bold text-green-900 mb-3">Digital Transformation</h2>
                <p class="text-gray-600">The process of using digital technologies to create new or modify existing business processes, culture, and customer experiences to meet changing business and market requirements.</p>
            </div>

            <!-- Digital Readiness -->
            <div class="bg-white rounded-xl border border-green-100 p-6 shadow-sm">
                <h2 class="text-xl font-bold text-green-900 mb-3">Digital Readiness</h2>
                <p class="text-gray-600">An organisation's preparedness to adopt and implement digital technologies, including having the necessary infrastructure, skills, and cultural mindset.</p>
            </div>

            <!-- Digital Capabilities -->
            <div class="bg-white rounded-xl border border-green-100 p-6 shadow-sm">
                <h2 class="text-xl font-bold text-green-900 mb-3">Digital Capabilities</h2>
                <p class="text-gray-600">The combination of technology, skills, and processes that enable an organisation to operate effectively in a digital environment.</p>
            </div>

            <!-- Green Digitalisation -->
            <div class="bg-white rounded-xl border border-green-100 p-6 shadow-sm">
                <h2 class="text-xl font-bold text-green-900 mb-3">Green Digitalisation</h2>
                <p class="text-gray-600">The practice of implementing digital technologies and processes in an environmentally sustainable way, minimising carbon footprint and promoting eco-friendly business practices.</p>
            </div>

            <!-- Digital Presence -->
            <div class="bg-white rounded-xl border border-green-100 p-6 shadow-sm">
                <h2 class="text-xl font-bold text-green-900 mb-3">Digital Presence</h2>
                <p class="text-gray-600">An organisation's visibility and engagement across digital channels, including websites, social media, and online marketplaces.</p>
            </div>

            <!-- Cybersecurity -->
            <div class="bg-white rounded-xl border border-green-100 p-6 shadow-sm">
                <h2 class="text-xl font-bold text-green-900 mb-3">Cybersecurity</h2>
                <p class="text-gray-600">The practice of protecting systems, networks, and programmes from digital attacks, unauthorised access, and data breaches.</p>
            </div>
        </div>

        <!-- Back to Assessment Button -->
        <div class="flex justify-center mt-12">
            <a href="{{ route('dma') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-lg text-base transition">
                Start Your Assessment
            </a>
        </div>
    </div>
</section>
@endsection 