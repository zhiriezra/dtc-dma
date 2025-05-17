<!-- resources/views/livewire/digital-maturity-assessment.blade.php -->
<div class="max-w-4xl mx-auto p-4 sm:p-6">
    <!-- Loading Overlay -->
    <div wire:loading wire:target="saveAssessment" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white p-4 sm:p-8 rounded-lg shadow-xl text-center mx-4">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-green-600 mx-auto mb-4"></div>
            <p class="text-base sm:text-lg font-medium">Saving your assessment and generating results...</p>
            <p class="text-xs sm:text-sm text-gray-600 mt-2">Please wait while we process your responses and prepare your report.</p>
        </div>
    </div>

    @if($currentSection < 0)
        <!-- Personal Information Section -->
        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-lg mb-6 sm:mb-8">
            <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-green-600">Personal Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Respondent Name *</label>
                    <input type="text" wire:model="personalInfo.respondent_name" class="w-full border rounded-lg p-3 text-base">
                    @error('personalInfo.respondent_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Gender *</label>
                    <select wire:model="personalInfo.gender" class="w-full border rounded-lg p-3 text-base">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    @error('personalInfo.gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Phone Number 1 *</label>
                    <input type="tel" wire:model="personalInfo.phone_number_1" class="w-full border rounded-lg p-3 text-base">
                    @error('personalInfo.phone_number_1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Phone Number 2 *</label>
                    <input type="tel" wire:model="personalInfo.phone_number_2" class="w-full border rounded-lg p-3 text-base">
                    @error('personalInfo.phone_number_2') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Email *</label>
                    <input type="email" wire:model="personalInfo.email" class="w-full border rounded-lg p-3 text-base">
                    @error('personalInfo.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">State *</label>
                    <select wire:model="personalInfo.state" class="w-full border rounded-lg p-3 text-base">
                        <option value="">Select State</option>
                        @foreach($states as $state)
                            <option value="{{ $state }}">{{ $state }}</option>
                        @endforeach
                    </select>
                    @error('personalInfo.state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Digital Advisor</label>
                    <input type="text" 
                           wire:model="digitalAdvisorName" 
                           class="w-full border rounded-lg p-3 text-base bg-gray-50" 
                           readonly>
                    <input type="hidden" wire:model="personalInfo.digital_advisor">
                </div>

                <div class="md:col-span-2">
                    <label class="flex items-center space-x-2 p-2 hover:bg-gray-50 rounded-lg">
                        <input type="checkbox" wire:model="personalInfo.has_disability" class="w-5 h-5">
                        <span class="text-sm sm:text-base">Do you have any disability?</span>
                    </label>
                </div>

                <div class="md:col-span-2">
                    <label class="flex items-center space-x-2 p-2 hover:bg-gray-50 rounded-lg">
                        <input type="checkbox" wire:model="personalInfo.consent_given" class="w-5 h-5">
                        <span class="text-sm sm:text-base">I consent to participate in this assessment *</span>
                    </label>
                    @error('personalInfo.consent_given') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Business Information Section -->
        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-lg mb-6 sm:mb-8">
            <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-green-600">Business Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Business Name *</label>
                    <input type="text" wire:model="businessInfo.business_name" class="w-full border rounded-lg p-3 text-base">
                    @error('businessInfo.business_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Business Phone Number *</label>
                    <input type="tel" wire:model="businessInfo.business_phone_number" class="w-full border rounded-lg p-3 text-base">
                    @error('businessInfo.business_phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Business Email *</label>
                    <input type="email" wire:model="businessInfo.business_email" class="w-full border rounded-lg p-3 text-base">
                    @error('businessInfo.business_email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Business State *</label>
                    <select wire:model="businessInfo.business_state" class="w-full border rounded-lg p-3 text-base">
                        <option value="">Select State</option>
                        @foreach($states as $state)
                            <option value="{{ $state }}">{{ $state }}</option>
                        @endforeach
                    </select>
                    @error('businessInfo.business_state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Business City *</label>
                    <input type="text" wire:model="businessInfo.business_city" class="w-full border rounded-lg p-3 text-base">
                    @error('businessInfo.business_city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Business Sector *</label>
                    <select wire:model="businessInfo.business_sector" class="w-full border rounded-lg p-3 text-base">
                        <option value="">Select Sector</option>
                        @foreach($businessSectors as $sector)
                            <option value="{{ $sector }}">{{ $sector }}</option>
                        @endforeach
                    </select>
                    @error('businessInfo.business_sector') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Business Type *</label>
                    <input type="text" wire:model="businessInfo.business_type" class="w-full border rounded-lg p-3 text-base">
                    @error('businessInfo.business_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Business Role *</label>
                    <input type="text" wire:model="businessInfo.business_role" class="w-full border rounded-lg p-3 text-base">
                    @error('businessInfo.business_role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Years in Business *</label>
                    <input type="number" wire:model="businessInfo.years_in_business" class="w-full border rounded-lg p-3 text-base">
                    @error('businessInfo.years_in_business') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm sm:text-base font-medium">Staff Size *</label>
                    <select wire:model="businessInfo.staff_size" class="w-full border rounded-lg p-3 text-base">
                        <option value="">Select Staff Size</option>
                        <option value="1-9">Micro (1–9 employees)</option>
                        <option value="10-49">Small (10–49 employees)</option>
                        <option value="50-249">Medium (50–249 employees)</option>
                    </select>
                    @error('businessInfo.staff_size') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="flex items-center space-x-2 p-2 hover:bg-gray-50 rounded-lg">
                        <input type="checkbox" wire:model="businessInfo.multiple_states" class="w-5 h-5">
                        <span class="text-sm sm:text-base">Do you operate in multiple states?</span>
                    </label>
                    @if($businessInfo['multiple_states'])
                        <div class="mt-2">
                            <input type="text"
                                   wire:model="businessInfo.operating_states"
                                   placeholder="List the states (comma separated)"
                                   class="w-full border rounded-lg p-3 text-base">
                            @error('businessInfo.operating_states') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button wire:click="startAssessment"
                    class="w-full sm:w-auto bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 text-base sm:text-lg">
                Start Assessment
            </button>
        </div>
    @else
        <!-- Assessment Progress Bar -->
        <div class="mb-6 sm:mb-8">
            <!-- Mobile progress indicator (visible on small screens) -->
            <div class="md:hidden mb-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-500">Step {{ $currentSection + 1 }} of {{ count($sectionNames) }}</span>
                    <span class="text-sm font-medium text-green-600">{{ $sectionNames[$currentSection] }}</span>
                </div>
                <div class="mt-2 h-2 bg-gray-200 rounded-full">
                    <div class="h-2 bg-green-600 rounded-full" style="width: {{ (($currentSection + 1) / count($sectionNames)) * 100 }}%"></div>
                </div>
            </div>
            
            <!-- Desktop progress steps (visible on medium screens and up) -->
            <div class="hidden md:block overflow-x-auto">
                <div class="flex items-center justify-between min-w-[600px] px-2">
                    @foreach($sectionNames as $index => $sectionName)
                        <div class="flex flex-col items-center flex-1">
                            <div class="relative flex items-center justify-center w-full">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center {{ $index <= $currentSection ? 'bg-green-600 text-white' : 'bg-gray-300 text-gray-600' }} z-10">
                                    {{ $index + 1 }}
                                </div>
                                @if($index < count($sectionNames) - 1)
                                    <div class="absolute h-1 bg-{{ $index < $currentSection ? 'green' : 'gray' }}-300 left-1/2 right-0 w-full"></div>
                                @endif
                            </div>
                            <span class="text-xs sm:text-sm mt-2 text-center {{ $index <= $currentSection ? 'text-green-500 font-medium' : 'text-gray-500' }}">
                                @php
                                    $words = explode(' ', $sectionName);
                                    $truncated = implode(' ', array_slice($words, 0, 2));
                                @endphp
                                {{ $truncated }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @if(!$showResults)
            <!-- Assessment Questions -->
            <div class="mb-6 sm:mb-8">
                <h2 class="text-xl sm:text-2xl font-bold mb-2 text-green-600">{{ $currentSectionName }}</h2>
                @if(isset($sections[$currentSectionName]['description']))
                    <p class="text-sm sm:text-base text-gray-600 mb-4">{{ $sections[$currentSectionName]['description'] }}</p>
                @endif
                <div class="space-y-4 sm:space-y-6">
                    @foreach($sections[$currentSectionName]['questions'] as $question)
                        <div class="bg-white p-4 sm:p-6 rounded-lg shadow">
                            <p class="text-base sm:text-lg mb-4 font-semibold">{{ $question['question'] }}
                                @if(isset($question['instruction']))
                                    <small class="text-gray-600 block sm:inline">({{ $question['instruction'] }})</small>
                                @endif
                            </p>

                            @if($question['type'] === 'checkbox')
                                <div class="space-y-3">
                                    @foreach($question['options'] as $option)
                                        <label class="flex items-center p-2 hover:bg-gray-50 rounded">
                                            <input type="checkbox"
                                                   wire:model="answers.{{ $question['id'] }}"
                                                   value="{{ $option['text'] }}"
                                                   class="w-5 h-5 mr-3">
                                            <span class="text-sm sm:text-base">{{ $option['text'] }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @elseif($question['type'] === 'select')
                                <select wire:model="answers.{{ $question['id'] }}"
                                        class="w-full p-3 border rounded-lg text-base">
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
            <div class="flex flex-col sm:flex-row justify-between gap-4 mt-6 sm:mt-8">
                @if($currentSection > 0)
                    <button wire:click="previousSection"
                            class="w-full sm:w-auto bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 text-base"
                            wire:loading.attr="disabled"
                            wire:target="previousSection">
                        Previous Section
                    </button>
                @else
                    <div></div>
                @endif

                @if($currentSection < count($sectionNames) - 1)
                    <button wire:click="nextSection"
                            class="w-full sm:w-auto bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 text-base"
                            wire:loading.attr="disabled"
                            wire:target="nextSection">
                        Next Section
                    </button>
                @else
                    <button wire:click="saveAssessment"
                            class="w-full sm:w-auto bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 text-base"
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
            <div class="space-y-6 sm:space-y-8">
                <div class="flex justify-center space-x-4">
                    <img src="{{ asset('images/logos/smedan-logo.png') }}" alt="SMEDAN Logo" class="h-16">
                    <img src="{{ asset('images/partners/partner-logos.png') }}" alt="Partner Logo" class="h-16">
                </div>
                <h2 class="text-xl sm:text-2xl font-bold">Digital Maturity Assessment Results: {{ $businessInfo['business_name'] }}</h2>
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
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mt-6">
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
                            <!-- <div class="flex justify-between items-center text-sm text-gray-600">
                                <span>Section Weight</span>
                                <span>{{ number_format($sections[$sectionName]['weight'] * 100, 0) }}%</span>
                            </div>
                            <div class="flex justify-between items-center text-sm text-gray-600">
                                <span>Contribution to Overall</span>
                                <span>{{ number_format(($score['scaled_percentage'] * $sections[$sectionName]['weight']), 1) }}%</span>
                            </div> -->
                            <p class="mt-2">
                                Maturity Level:
                                <span class="font-bold {{ $sectionTextColor }}">
                                    {{ $level }}
                                </span>
                            </p>
                            @if($sectionName !== 'Validation Section')
                                <div class="mt-4">
                                    <h4 class="text-sm font-semibold mb-2">Recommendations:</h4>
                                    <ul class="list-disc list-inside space-y-1 text-sm text-gray-600">
                                        @foreach($this->getSectionRecommendations($sectionName, $level) as $recommendation)
                                            <li>{{ $recommendation }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row gap-4">
                <button wire:click="downloadPDF"
                        class="w-full sm:w-auto bg-green-500 text-white px-4 py-3 rounded-lg hover:bg-green-600 text-base">
                    Download PDF
                </button>
                <button onclick="window.location.reload()"
                        class="w-full sm:w-auto bg-blue-500 text-white px-4 py-3 rounded-lg hover:bg-blue-600 text-base">
                    Start New Assessment
                </button>
            </div>
        @endif
    @endif

    @error('save')
        <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm sm:text-base">
            {{ $message }}
        </div>
    @enderror
</div>
