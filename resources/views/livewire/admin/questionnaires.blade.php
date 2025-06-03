<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-900">Questionnaires</h2>
        <div class="flex space-x-4">
            <button wire:click="exportQuestionnaires" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export
            </button>
            <button onclick="window.print()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print
            </button>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Business Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Respondent</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">State</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($questionnaires as $questionnaire)
                    <tr class="hover:bg-gray-50 cursor-pointer" wire:click="viewDetails({{ $questionnaire->id }})">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $questionnaire->business_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $questionnaire->respondent_name }}</div>
                            <div class="text-sm text-gray-500">{{ $questionnaire->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $questionnaire->state }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $questionnaire->overall_score }}%</div>
                            <div class="text-sm text-gray-500">{{ $questionnaire->maturity_level }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $questionnaire->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <button class="text-green-600 hover:text-green-900">View Details</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $questionnaires->links() }}
    </div>

    @if($showDetails && $selectedQuestionnaire)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4 z-50" wire:click="closeDetails">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto relative" wire:click.stop>
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-semibold text-gray-900">Questionnaire Details</h3>
                        <button wire:click="closeDetails" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Business Information</h4>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Business Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedQuestionnaire->business_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Business Sector</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedQuestionnaire->business_sector }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Employee Count</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedQuestionnaire->employee_count }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Years in Business</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedQuestionnaire->years_in_business }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Respondent Information</h4>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedQuestionnaire->respondent_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedQuestionnaire->email }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedQuestionnaire->phone_number }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Role</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedQuestionnaire->role }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Assessment Results</h4>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Overall Score</dt>
                                    <dd class="mt-1 text-2xl font-semibold text-gray-900">{{ $selectedQuestionnaire->overall_score }}%</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Maturity Level</dt>
                                    <dd class="mt-1 text-2xl font-semibold text-gray-900">{{ $selectedQuestionnaire->maturity_level }}</dd>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Section Scores</h4>
                        <div class="space-y-4">
                            @foreach($selectedQuestionnaire->section_scores as $section => $score)
                                @php
                                    $level = match(true) {
                                        $score['percentage'] >= 81 && $score['percentage'] <= 100 => 'Leader/Transformative',
                                        $score['percentage'] >= 61 && $score['percentage'] <= 80 => 'Advanced/Strategic',
                                        $score['percentage'] >= 41 && $score['percentage'] <= 60 => 'Competent/Defined',
                                        $score['percentage'] >= 21 && $score['percentage'] <= 40 => 'Developing/Emerging',
                                        $score['percentage'] >= 0 && $score['percentage'] <= 20 => 'Novice/Beginner',
                                        default => 'Novice/Beginner'
                                    };

                                    $bgColor = match($level) {
                                        'Leader/Transformative' => 'bg-green-50 border-green-300',
                                        'Advanced/Strategic' => 'bg-green-50 border-green-200',
                                        'Competent/Defined' => 'bg-blue-50 border-blue-200',
                                        'Developing/Emerging' => 'bg-yellow-50 border-yellow-200',
                                        'Novice/Beginner' => 'bg-orange-50 border-orange-200',
                                        default => 'bg-red-50 border-red-200'
                                    };

                                    $textColor = match($level) {
                                        'Leader/Transformative' => 'text-green-600',
                                        'Advanced/Strategic' => 'text-green-500',
                                        'Competent/Defined' => 'text-blue-800',
                                        'Developing/Emerging' => 'text-yellow-800',
                                        'Novice/Beginner' => 'text-orange-800',
                                        default => 'text-red-800'
                                    };

                                    $progressColor = match($level) {
                                        'Leader/Transformative' => 'bg-green-600',
                                        'Advanced/Strategic' => 'bg-green-500',
                                        'Competent/Defined' => 'bg-blue-600',
                                        'Developing/Emerging' => 'bg-yellow-500',
                                        'Novice/Beginner' => 'bg-orange-500',
                                        default => 'bg-red-500'
                                    };
                                @endphp
                                <div class="bg-white rounded-lg shadow p-4 border-2 {{ $bgColor }}">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h5 class="text-sm font-medium text-gray-900">{{ $section }}</h5>
                                            <p class="text-sm {{ $textColor }}">Score: {{ $score['percentage'] }}%</p>
                                            <p class="text-sm font-medium {{ $textColor }}">{{ $level }}</p>
                                        </div>
                                        <div class="w-32 bg-gray-200 rounded-full h-2.5">
                                            <div class="{{ $progressColor }} h-2.5 rounded-full" style="width: {{ $score['percentage'] }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div> 