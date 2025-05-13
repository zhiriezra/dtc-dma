@extends('layouts.dsp')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Digital Maturity Assessment</h1>
        <p class="mt-1 text-sm text-gray-600">Assess your MSME</p>
    </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <livewire:digital-maturity-assessment />
        </div>
</div>
@endsection

