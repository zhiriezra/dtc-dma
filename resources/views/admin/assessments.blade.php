@extends('layouts.admin')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Assessments</h1>
        <p class="mt-1 text-sm text-gray-600">View all assessments and questionnaires</p>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <livewire:admin.questionnaires />
    </div>
</div>
@endsection

