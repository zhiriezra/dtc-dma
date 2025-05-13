<!-- resources/views/livewire/digital-maturity-assessment.blade.php -->
<div class="max-w-4xl mx-auto p-6">
    <!-- Loading Overlay -->
    <div wire:loading wire:target="saveAssessment" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-xl text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-green-600 mx-auto mb-4"></div>
            <p class="text-lg font-medium">Saving your assessment and generating results...</p>
            <p class="text-sm text-gray-600 mt-2">Please wait while we process your responses and prepare your report.</p>
        </div>
    </div>

    @if($currentSection < 0)
        <!-- Personal Information Section -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-bold mb-6 text-green-600">Personal Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2">Respondent Name *</label>
                    <input type="text" wire:model="personalInfo.respondent_name" class="w-full border rounded p-2">
                    @error('personalInfo.respondent_name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Gender *</label>
                    <select wire:model="personalInfo.gender" class="w-full border rounded p-2">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    @error('personalInfo.gender') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Phone Number 1 *</label>
                    <input type="tel" wire:model="personalInfo.phone_number_1" class="w-full border rounded p-2">
                    @error('personalInfo.phone_number_1') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Phone Number 2 *</label>
                    <input type="tel" wire:model="personalInfo.phone_number_2" class="w-full border rounded p-2">
                    @error('personalInfo.phone_number_2') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Email *</label>
                    <input type="email" wire:model="personalInfo.email" class="w-full border rounded p-2">
                    @error('personalInfo.email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">State *</label>
                    <select wire:model="personalInfo.state" class="w-full border rounded p-2">
                        <option value="">Select State</option>
                        @foreach($states as $state)
                            <option value="{{ $state }}">{{ $state }}</option>
                        @endforeach
                    </select>
                    @error('personalInfo.state') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Digital Advisor</label>
                    <input type="text" 
                           wire:model="digitalAdvisorName" 
                           class="w-full border rounded p-2" 
                           readonly>
                    <input type="hidden" wire:model="personalInfo.digital_advisor">
                </div>

                <div class="col-span-2">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="personalInfo.has_disability">
                        <span>Do you have any disability?</span>
                    </label>
                </div>

                <div class="col-span-2">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="personalInfo.consent_given">
                        <span>I consent to participate in this assessment *</span>
                    </label>
                    @error('personalInfo.consent_given') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Business Information Section -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-bold mb-6 text-green-600">Business Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2">Business Name *</label>
                    <input type="text" wire:model="businessInfo.business_name" class="w-full border rounded p-2">
                    @error('businessInfo.business_name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Business Phone Number *</label>
                    <input type="tel" wire:model="businessInfo.business_phone_number" class="w-full border rounded p-2">
                    @error('businessInfo.business_phone_number') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Business Email *</label>
                    <input type="email" wire:model="businessInfo.business_email" class="w-full border rounded p-2">
                    @error('businessInfo.business_email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Business State *</label>
                    <select wire:model="businessInfo.business_state" class="w-full border rounded p-2">
                        <option value="">Select State</option>
                        @foreach($states as $state)
                            <option value="{{ $state }}">{{ $state }}</option>
                        @endforeach
                    </select>
                    @error('businessInfo.business_state') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Business City *</label>
                    <input type="text" wire:model="businessInfo.business_city" class="w-full border rounded p-2">
                    @error('businessInfo.business_city') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Business Sector *</label>
                    <select wire:model="businessInfo.business_sector" class="w-full border rounded p-2">
                        <option value="">Select Sector</option>
                        @foreach($businessSectors as $sector)
                            <option value="{{ $sector }}">{{ $sector }}</option>
                        @endforeach
                    </select>
                    @error('businessInfo.business_sector') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Business Type *</label>
                    <input type="text" wire:model="businessInfo.business_type" class="w-full border rounded p-2">
                    @error('businessInfo.business_type') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Business Role *</label>
                    <input type="text" wire:model="businessInfo.business_role" class="w-full border rounded p-2">
                    @error('businessInfo.business_role') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Years in Business *</label>
                    <input type="number" wire:model="businessInfo.years_in_business" class="w-full border rounded p-2">
                    @error('businessInfo.years_in_business') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Staff Size *</label>
                    <select wire:model="businessInfo.staff_size" class="w-full border rounded p-2">
                        <option value="">Select Staff Size</option>
                        <option value="1-9">Micro (1–9 employees)</option>
                        <option value="10-49">Small (10–49 employees)</option>
                        <option value="50-249">Medium (50–249 employees)</option>
                    </select>
                    @error('businessInfo.staff_size') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-2">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="businessInfo.multiple_states">
                        <span>Do you operate in multiple states?</span>
                    </label>
                    @if($businessInfo['multiple_states'])
                        <div class="mt-2">
                            <input type="text"
                                   wire:model="businessInfo.operating_states"
                                   placeholder="List the states (comma separated)"
                                   class="w-full border rounded p-2">
                            @error('businessInfo.operating_states') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button wire:click="startAssessment"
                    class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                Start Assessment
            </button>
        </div>
    @else
        <!-- Assessment Progress Bar -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                @foreach($sectionNames as $index => $sectionName)
                    <div class="flex flex-col items-center">
                        <div class="relative">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $index <= $currentSection ? 'bg-green-600 text-white' : 'bg-gray-300 text-gray-600' }}">
                                {{ $index + 1 }}
                            </div>
                            @if($index < count($sectionNames) - 1)
                                <div class="absolute w-full h-1 bg-{{ $index < $currentSection ? 'green' : 'gray' }}-300 top-1/2 left-full"></div>
                            @endif
                        </div>
                        <span class="text-sm mt-2 text-center {{ $index <= $currentSection ? 'text-green-500 font-medium' : 'text-gray-500' }}">
                            @php
                                $words = explode(' ', $sectionName);
                                $truncated = implode(' ', array_slice($words, 0, 3));
                            @endphp
                            {{ $truncated }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        @if(!$showResults)
            <!-- Assessment Questions -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-2 text-green-600">{{ $currentSectionName }}</h2>
                @if(isset($sections[$currentSectionName]['description']))
                    <p class="text-gray-600 mb-4">{{ $sections[$currentSectionName]['description'] }}</p>
                @endif
                <div class="space-y-6">
                    @foreach($sections[$currentSectionName]['questions'] as $question)
                        <div class="bg-white p-6 rounded-lg shadow">
                            <p class="text-lg mb-4 font-semibold">{{ $question['question'] }}
                                @if(isset($question['instruction']))
                                    <small class="text-gray-600">({{ $question['instruction'] }})</small>
                                @endif
                            </p>

                            @if($question['type'] === 'checkbox')
                                <div class="space-y-2">
                                    @foreach($question['options'] as $option)
                                        <label class="flex items-center">
                                            <input type="checkbox"
                                                   wire:model="answers.{{ $question['id'] }}"
                                                   value="{{ $option['text'] }}"
                                                   class="mr-2">
                                            {{ $option['text'] }}
                                        </label>
                                    @endforeach
                                </div>
                            @elseif($question['type'] === 'select')
                                <select wire:model="answers.{{ $question['id'] }}"
                                        class="w-full p-2 border rounded">
                                    <option value="">Select an option</option>
                                    @foreach($question['options'] as $option)
                                        <option value="{{ $option['text'] }}">
                                            {{ $option['text'] }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between mt-8">
                @if($currentSection > 0)
                    <button wire:click="previousSection"
                            class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600"
                            wire:loading.attr="disabled"
                            wire:target="previousSection">
                        Previous Section
                    </button>
                @else
                    <div></div>
                @endif

                @if($currentSection < count($sectionNames) - 1)
                    <button wire:click="nextSection"
                            class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600"
                            wire:loading.attr="disabled"
                            wire:target="nextSection">
                        Next Section
                    </button>
                @else
                    <button wire:click="saveAssessment"
                            class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600"
                            wire:loading.attr="disabled"
                            wire:target="saveAssessment">
                        <span wire:loading.remove wire:target="saveAssessment">Submit Assessment</span>
                        <span wire:loading wire:target="saveAssessment">
                            <span class="inline-block animate-spin mr-2">⟳</span>
                            Submitting...
                        </span>
                    </button>
                @endif
            </div>
        @else
            <!-- Results Section -->
            <div class="space-y-8">
                <h2 class="text-2xl font-bold">Digital Maturity Assessment Results: {{ $businessInfo['business_name'] }}</h2>
                <!-- Overall Score Card -->
                @php
                    $bgColor = match($overallScore['level']) {
                        'Leader/Transformative' => 'bg-green-50 border-green-300',
                        'Advanced/Strategic' => 'bg-green-50 border-green-200',
                        'Competent/Defined' => 'bg-blue-50 border-blue-200',
                        'Developing/Emerging' => 'bg-yellow-50 border-yellow-200',
                        'Novice/Beginner' => 'bg-orange-50 border-orange-200',
                        default => 'bg-red-50 border-red-200'
                    };

                    $textColor = match($overallScore['level']) {
                        'Leader/Transformative' => 'text-green-600',
                        'Advanced/Strategic' => 'text-green-500',
                        'Competent/Defined' => 'text-blue-800',
                        'Developing/Emerging' => 'text-yellow-800',
                        'Novice/Beginner' => 'text-orange-800',
                        default => 'text-red-800'
                    };

                    $progressColor = match($overallScore['level']) {
                        'Leader/Transformative' => 'bg-green-600',
                        'Advanced/Strategic' => 'bg-green-500',
                        'Competent/Defined' => 'bg-blue-600',
                        'Developing/Emerging' => 'bg-yellow-500',
                        'Novice/Beginner' => 'bg-orange-500',
                        default => 'bg-red-500'
                    };
                @endphp

                <div class="p-6 rounded-lg shadow-lg border-2 {{ $bgColor }}">
                    <h3 class="text-2xl font-bold mb-4 {{ $textColor }}">Overall Digital Maturity</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg">Overall Score:</span>
                            <span class="text-2xl font-bold {{ $textColor }}">{{ $overallScore['percentage'] }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="{{ $progressColor }} h-3 rounded-full"
                                style="width: {{ $overallScore['percentage'] }}%"></div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <span class="text-lg">Maturity Level:</span>
                        <span class="text-xl font-bold ml-2 {{ $textColor }}">{{ $overallScore['level'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Section Scores -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                @foreach($scores as $sectionName => $score)
                    @php
                        $level = $this->getMaturityLevel($score['percentage']);
                        $sectionProgressColor = match($level) {
                            'Leader/Transformative' => 'bg-green-600',
                            'Advanced/Strategic' => 'bg-green-500',
                            'Competent/Defined' => 'bg-blue-500',
                            'Developing/Emerging' => 'bg-yellow-500',
                            'Novice/Beginner' => 'bg-orange-500',
                            default => 'bg-red-500'
                        };
                        $sectionTextColor = match($level) {
                            'Leader/Transformative' => 'text-green-600',
                            'Advanced/Strategic' => 'text-green-500',
                            'Competent/Defined' => 'text-blue-500',
                            'Developing/Emerging' => 'text-yellow-500',
                            'Novice/Beginner' => 'text-orange-500',
                            default => 'text-red-500'
                        };
                    @endphp

                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-xl font-semibold mb-4">{{ $sectionName }}</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span>Score: {{ $score['score'] }} / {{ $score['max'] }}</span>
                                <span class="font-bold {{ $sectionTextColor }}">{{ $score['percentage'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="{{ $sectionProgressColor }} h-2.5 rounded-full"
                                    style="width: {{ $score['percentage'] }}%"></div>
                            </div>
                            <div class="flex justify-between items-center text-sm text-gray-600">
                                <span>Section Weight</span>
                                <span>{{ number_format($sections[$sectionName]['weight'] * 100, 0) }}%</span>
                            </div>
                            <div class="flex justify-between items-center text-sm text-gray-600">
                                <span>Contribution to Overall</span>
                                <span>{{ number_format(($score['scaled_percentage'] * $sections[$sectionName]['weight']), 1) }}%</span>
                            </div>
                            <p class="mt-2">
                                Maturity Level:
                                <span class="font-bold {{ $sectionTextColor }}">
                                    {{ $level }}
                                </span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-wrap gap-4">
                <button onclick="window.print()"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Print Results
                </button>
                <button onclick="window.location.reload()"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Start New Assessment
                </button>
            </div>
        @endif
    @endif

    @error('save')
        <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ $message }}
        </div>
    @enderror
</div>
