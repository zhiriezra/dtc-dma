<!-- resources/views/livewire/digital-maturity-assessment.blade.php -->
<div class="max-w-4xl mx-auto p-6">
    @if($currentSection < 0)
        <!-- Basic Information Section -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-bold mb-6 text-red-500">Preliminary Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2">Respondent Name *</label>
                    <input type="text" wire:model="basicInfo.respondent_name" class="w-full border rounded p-2">
                    @error('basicInfo.respondent_name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Business Name *</label>
                    <input type="text" wire:model="basicInfo.business_name" class="w-full border rounded p-2">
                    @error('basicInfo.business_name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Gender *</label>
                    <select wire:model="basicInfo.gender" class="w-full border rounded p-2">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    @error('basicInfo.gender') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Phone Number *</label>
                    <input type="tel" wire:model="basicInfo.phone_number" class="w-full border rounded p-2">
                    @error('basicInfo.phone_number') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Respondent Email *</label>
                    <input type="email" wire:model="basicInfo.email" class="w-full border rounded p-2">
                    @error('basicInfo.email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">State *</label>
                    <select wire:model="basicInfo.state" class="w-full border rounded p-2">
                        <option value="">Select State</option>
                        @foreach($states as $state)
                            <option value="{{ $state }}">{{ $state }}</option>
                        @endforeach
                    </select>
                    @error('basicInfo.state') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                {{-- <div>
                    <label class="block mb-2">Nationality *</label>
                    <input type="text" wire:model="basicInfo.nationality" class="w-full border rounded p-2">
                    @error('basicInfo.nationality') <span class="text-red-500">{{ $message }}</span> @enderror
                </div> --}}

                <div>
                    <label class="block mb-2">Business Sector *</label>
                    <select wire:model="basicInfo.business_sector" class="w-full border rounded p-2">
                        <option value="">Select Sector</option>
                        @foreach($businessSectors as $sector)
                            <option value="{{ $sector }}">{{ $sector }}</option>
                        @endforeach
                    </select>
                    @error('basicInfo.business_sector') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Employee Count *</label>
                    <input type="number" wire:model="basicInfo.employee_count" class="w-full border rounded p-2">
                    @error('basicInfo.employee_count') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Role in Business *</label>
                    <input type="text" wire:model="basicInfo.role" class="w-full border rounded p-2">
                    @error('basicInfo.role') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Years in Business *</label>
                    <input type="number" wire:model="basicInfo.years_in_business" class="w-full border rounded p-2">
                    @error('basicInfo.years_in_business') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Staff Size *</label>
                    <select wire:model="basicInfo.staff_size" class="w-full border rounded p-2">
                        <option value="">Select Staff Size</option>
                        <option value="1-9">Micro (1–9 employees)</option>
                        <option value="10-49">Small (10–49 employees)</option>
                        <option value="50-249">Medium (50–249 employees)</option>
                    </select>
                    @error('basicInfo.staff_size') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2">Digital Advisor</label>
                    <input type="text" wire:model="basicInfo.digital_advisor" class="w-full border rounded p-2">
                </div>

                <div class="col-span-2">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="basicInfo.multiple_states">
                        <span>Do you operate in multiple states?</span>
                    </label>
                    @if($basicInfo['multiple_states'])
                        <div class="mt-2">
                            <input type="text"
                                   wire:model="basicInfo.operating_states"
                                   placeholder="List the states (comma separated)"
                                   class="w-full border rounded p-2">
                            @error('operating_states') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>

                <div class="col-span-2">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="basicInfo.has_disability">
                        <span>Do you have any disability?</span>
                    </label>
                </div>

                <div class="col-span-2">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="basicInfo.consent_given">
                        <span>I consent to participate in this assessment *</span>
                    </label>
                    @error('basicInfo.consent_given') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6">
                <button wire:click="startAssessment"
                        class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">
                    Start Assessment
                </button>
            </div>
        </div>
    @else
        <!-- Assessment Progress Bar -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                @foreach(array_keys($sections) as $index => $sectionName)
                    <div class="flex flex-col items-center">
                        <div class="relative">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $index <= $currentSection ? 'bg-red-500 text-white' : 'bg-gray-300 text-gray-600' }}">
                                {{ $index + 1 }}
                            </div>
                            @if($index < count($sections) - 1)
                                <div class="absolute w-full h-1 bg-{{ $index < $currentSection ? 'red' : 'gray' }}-300 top-1/2 left-full"></div>
                            @endif
                        </div>
                        <span class="text-sm mt-2 text-center {{ $index <= $currentSection ? 'text-red-500 font-medium' : 'text-gray-500' }}">
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
                <h2 class="text-2xl font-bold mb-4 text-red-500">{{ $currentSectionName }}</h2>
                <div class="space-y-6">
                    @foreach($sections[$currentSectionName] as $question)
                        <div class="bg-white p-6 rounded-lg shadow">
                            <p class="text-lg mb-4 font-semibold">{{ $question['question'] }}
                                <small>
                                    @if(isset($question['instruction']))
                                        {{ $question['instruction'] }}
                                    @endif
                                </small>
                            </p>

                            @if($question['type'] === 'radio')
                                <div class="space-y-2">
                                    @foreach($question['options'] as $option)
                                        <label class="flex items-center">
                                            <input type="radio"
                                                   wire:model="answers.{{ $question['id'] }}"
                                                   value="{{ $option['text'] }}"
                                                   class="mr-2">
                                            {{ $option['text'] }}
                                        </label>
                                    @endforeach
                                </div>

                            @elseif($question['type'] === 'checkbox')
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
            <div class="flex justify-between">
                @if($currentSection > 0)
                    <button wire:click="previousSection"
                            class="bg-gray-500 text-white px-4 py-2 rounded">
                        Previous
                    </button>
                @else
                    <div></div>
                @endif

                <button wire:click="nextSection"
                        class="bg-red-500 text-white px-4 py-2 rounded">
                    {{ $currentSection < count($sections) - 1 ? 'Next' : 'View Results' }}
                </button>
            </div>

        @else
            <!-- Results Section -->
            <div class="space-y-8">
                <h2 class="text-2xl font-bold">Digital Maturity Assessment Results: {{ $basicInfo['business_name'] }}</h2>
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

                    $scoreColor = match($overallScore['level']) {
                        'Leader/Transformative' => 'text-green-600',
                        'Advanced/Strategic' => 'text-green-500',
                        'Competent/Defined' => 'text-blue-600',
                        'Developing/Emerging' => 'text-yellow-600',
                        'Novice/Beginner' => 'text-orange-600',
                        default => 'text-red-600'
                    };
                @endphp

                <div class="p-6 rounded-lg shadow-lg border-2 {{ $bgColor }}">
                    <h3 class="text-2xl font-bold mb-4 {{ $textColor }}">Overall Digital Maturity</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg">Overall Score:</span>
                            <span class="text-2xl font-bold {{ $scoreColor }}">{{ $overallScore['percentage'] }}%</span>
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
        </div>
    @endif
@endif
</div>
