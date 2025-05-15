<?php

namespace App\Livewire;

use App\Models\AssessmentResponse;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentSection;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Mail\DigitalMaturityResults;
use Illuminate\Support\Facades\Mail;

use function Ramsey\Uuid\v1;

class DigitalMaturityAssessment extends Component
{
    public $currentSection = -1;
    public $answers = [];
    public $showResults = false;
    public $digitalAdvisorName = '';
    public $sections = [];
    public $sectionNames = [];
    public $isSaving = false;

    // Personal Information
    public $personalInfo = [
        'respondent_name' => '',
        'gender' => '',
        'phone_number_1' => '',
        'phone_number_2' => '',
        'email' => '',
        'state' => '',
        'has_disability' => false,
        'digital_advisor' => '',
        'consent_given' => false,
    ];
    
    // Business Information
    public $businessInfo = [
        'business_name' => '',
        'business_phone_number' => '',
        'business_email' => '',
        'business_state' => '',
        'business_city' => '',
        'business_sector' => '',
        'business_type' => '',
        'business_role' => '',
        'years_in_business' => '',
        'staff_size' => '',
        'multiple_states' => false,
        'operating_states' => '',
    ];

    protected $rules = [
        // Personal Information Validation
        'personalInfo.respondent_name' => 'required',
        'personalInfo.gender' => 'required',
        'personalInfo.phone_number_1' => 'required',
        'personalInfo.phone_number_2' => 'required',
        'personalInfo.email' => 'required|email',
        'personalInfo.state' => 'required',
        'personalInfo.has_disability' => 'boolean',
        'personalInfo.consent_given' => 'required|accepted',

        // Business Information Validation
        'businessInfo.business_name' => 'required',
        'businessInfo.business_phone_number' => 'required',
        'businessInfo.business_email' => 'required|email',
        'businessInfo.business_state' => 'required',
        'businessInfo.business_city' => 'required',
        'businessInfo.business_sector' => 'required',
        'businessInfo.business_type' => 'required',
        'businessInfo.business_role' => 'required',
        'businessInfo.years_in_business' => 'required|numeric',
        'businessInfo.staff_size' => 'required',
        'businessInfo.multiple_states' => 'boolean',
        'businessInfo.operating_states' => 'required_if:businessInfo.multiple_states,true',
    ];

    protected $messages = [
        // Personal Information Messages
        'personalInfo.respondent_name.required' => 'Please enter your name',
        'personalInfo.gender.required' => 'Please select your gender',
        'personalInfo.phone_number_1.required' => 'Please enter your primary phone number',
        'personalInfo.phone_number_2.required' => 'Please enter your secondary phone number',
        'personalInfo.email.required' => 'Please enter your email address',
        'personalInfo.email.email' => 'Please enter a valid email address',
        'personalInfo.state.required' => 'Please select your state',
        'personalInfo.consent_given.required' => 'You must give consent to proceed',
        'personalInfo.consent_given.accepted' => 'You must give consent to proceed',

        // Business Information Messages
        'businessInfo.business_name.required' => 'Please enter your business name',
        'businessInfo.business_phone_number.required' => 'Please enter your business phone number',
        'businessInfo.business_email.required' => 'Please enter your business email address',
        'businessInfo.business_email.email' => 'Please enter a valid business email address',
        'businessInfo.business_state.required' => 'Please select your business state',
        'businessInfo.business_city.required' => 'Please enter your business city',
        'businessInfo.business_sector.required' => 'Please select your business sector',
        'businessInfo.business_type.required' => 'Please select your business type',
        'businessInfo.business_role.required' => 'Please select your role in the business',
        'businessInfo.years_in_business.required' => 'Please enter how many years you have been in business',
        'businessInfo.years_in_business.numeric' => 'Years in business must be a number',
        'businessInfo.staff_size.required' => 'Please select your staff size',
        'businessInfo.operating_states.required_if' => 'Please list the states where you operate',
    ];

    // Business sectors in Nigeria
    public $businessSectors = [
        'Agriculture',
        'Manufacturing',
        'Trading',
        'Services',
        'Health',
        'Logistics',
        'Technology',
        'Education',
        'Construction',
        'Oil and Gas',
        'Financial Services',
        'Entertainment',
        'Others'
    ];

    // Nigerian states
    public $states = [
        'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno',
        'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'FCT', 'Gombe', 'Imo',
        'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa',
        'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba',
        'Yobe', 'Zamfara'
    ];

    protected $sectionWeights = [
        'Internet Access, Technology Use and Digital Readiness' => 0.15,        // 15%
        'Digitalisation of Business Processes, People and Skills' => 0.20,      // 20%
        'Digital Presence & Data Management' => 0.20,                          // 20%
        'Digital Transactions, Cybersecurity, Automation & Emerging Technologies' => 0.20,  // 20%
        'Green Digitalisation & Readiness for Digital Transformation' => 0.15,  // 15%
        'Validation Section' => 0.10                                           // 10%
    ];

    protected $sectionScalingFactors = [
        'Internet Access, Technology Use and Digital Readiness' => 3.0,        // 5 points → 15 points
        'Digitalisation of Business Processes, People and Skills' => 1.82,     // 11 points → 20 points
        'Digital Presence & Data Management' => 1.25,                         // 16 points → 20 points
        'Digital Transactions, Cybersecurity, Automation & Emerging Technologies' => 1.43,  // 14 points → 20 points
        'Green Digitalisation & Readiness for Digital Transformation' => 1.25, // 8 points → 10 points
        'Validation Section' => 0.6                                           // 25 points → 15 points
    ];

    public function mount()
    {
        // Set digital advisor if user is logged in
        if (Auth::check()) {
            $this->personalInfo['digital_advisor'] = Auth::id();
            $this->digitalAdvisorName = Auth::user()->name;
        }

        // Load sections and questions from database
        $sections = AssessmentSection::ordered()->with(['questions' => function($query) {
            $query->ordered();
        }])->get();
        
        // Group questions by section
        foreach ($sections as $section) {
            $this->sections[$section->name] = [
                'description' => $section->description,
                'weight' => $section->weight,
                'scaling_factor' => $section->scaling_factor,
                'questions' => $section->questions->map(function($question) {
                    return [
                        'id' => 'question_' . $question->id,
                        'type' => $question->type,
                        'question' => $question->question,
                        'instruction' => $question->instruction,
                        'options' => $question->options,
                    ];
                })->toArray()
            ];

            // Initialize answers array for each question
            foreach ($section->questions as $question) {
                if ($question->type === 'checkbox') {
                    $this->answers['question_' . $question->id] = [];
                } else {
                    $this->answers['question_' . $question->id] = '';
                }
            }
        }

        // Get unique section names
        $this->sectionNames = array_keys($this->sections);
    }

    public function saveAssessment()
    {
        if ($this->businessInfo['multiple_states'] && empty($this->businessInfo['operating_states'])) {
            $this->addError('businessInfo.operating_states', 'Please list the operating states.');
            return;
        }

        try {
            $this->isSaving = true;

            $scores = [];
            foreach ($this->sectionNames as $sectionName) {
                $scores[$sectionName] = $this->calculateSectionScore($sectionName);
            }
            $overallScore = $this->calculateOverallScore($scores);

            AssessmentResponse::create([
                // Personal Information
                'respondent_name' => $this->personalInfo['respondent_name'],
                'gender' => $this->personalInfo['gender'],
                'phone_number_1' => $this->personalInfo['phone_number_1'],
                'phone_number_2' => $this->personalInfo['phone_number_2'],
                'email' => $this->personalInfo['email'],
                'state' => $this->personalInfo['state'],
                'has_disability' => $this->personalInfo['has_disability'],
                'user_id' => Auth::id(),
                'consent_given' => $this->personalInfo['consent_given'],

                // Business Information
                'business_name' => $this->businessInfo['business_name'],
                'business_phone_number' => $this->businessInfo['business_phone_number'],
                'business_email' => $this->businessInfo['business_email'],
                'business_state' => $this->businessInfo['business_state'],
                'business_city' => $this->businessInfo['business_city'],
                'business_sector' => $this->businessInfo['business_sector'],
                'business_type' => $this->businessInfo['business_type'],
                'business_role' => $this->businessInfo['business_role'],
                'years_in_business' => $this->businessInfo['years_in_business'],
                'staff_size' => $this->businessInfo['staff_size'],
                'multiple_states' => $this->businessInfo['multiple_states'],
                'operating_states' => $this->businessInfo['operating_states'],

                // Assessment Data
                'assessment_answers' => $this->answers,
                'section_scores' => $scores,
                'overall_score' => $overallScore['percentage'],
                'maturity_level' => $overallScore['level']
            ]);

            // Send email with results
            Mail::to($this->personalInfo['email'])
                ->send(new DigitalMaturityResults(
                    $scores,
                    $overallScore,
                    $this->businessInfo['business_name']
                ));

            $this->showResults = true;
        } catch (\Exception $e) {
            $this->addError('save', 'An error occurred while saving your assessment. Please try again.');
        } finally {
            $this->isSaving = false;
        }
    }

    public function startAssessment()
    {
        $this->validate();

        if (!$this->personalInfo['consent_given']) {
            $this->addError('personalInfo.consent_given', 'You must give consent to proceed with the assessment.');
            return;
        }

        $this->currentSection = 0;
    }

    public function nextSection()
    {
        if ($this->currentSection < count($this->sectionNames) - 1) {
            $this->currentSection++;
        } else {
            $this->saveAssessment();
            $this->showResults = true;
        }
    }

    public function previousSection()
    {
        if ($this->currentSection > 0) {
            $this->currentSection--;
        }
    }

    public function calculateSectionScore($sectionName)
    {
        $totalPoints = 0;
        $maxPoints = 0;
        $section = $this->sections[$sectionName];

        foreach ($section['questions'] as $question) {
            if ($question['type'] === 'checkbox') {
                $selectedOptions = is_array($this->answers[$question['id']]) ? $this->answers[$question['id']] : [];

                foreach ($question['options'] as $option) {
                    $maxPoints += $option['points'];
                    if (in_array($option['text'], $selectedOptions)) {
                        $totalPoints += $option['points'];
                    }
                }
            } else {
                foreach ($question['options'] as $option) {
                    if ($this->answers[$question['id']] === $option['text']) {
                        $totalPoints += $option['points'];
                    }
                }
                $maxPoints += max(array_column($question['options'], 'points'));
            }
        }

        // Calculate original percentage
        $originalPercentage = $maxPoints > 0 ? round(($totalPoints / $maxPoints) * 100) : 0;

        // Apply scaling factor for overall score contribution
        $scalingFactor = $section['scaling_factor'];
        $scaledMaxPoints = $maxPoints * $scalingFactor;
        $scaledTotalPoints = $totalPoints * $scalingFactor;
        $scaledPercentage = $scaledMaxPoints > 0 ? round(($scaledTotalPoints / $scaledMaxPoints) * 100) : 0;

        return [
            'score' => $totalPoints,                    // Original points
            'max' => $maxPoints,                        // Original max points
            'percentage' => $originalPercentage,        // Original percentage
            'scaled_score' => $scaledTotalPoints,       // Scaled points
            'scaled_max' => $scaledMaxPoints,          // Scaled max points
            'scaled_percentage' => $scaledPercentage    // Scaled percentage
        ];
    }

    public function calculateOverallScore($scores)
    {
        $totalWeightedScore = 0;
        $totalWeight = 0;

        foreach ($scores as $sectionName => $score) {
            $weight = $this->sections[$sectionName]['weight'];
            $totalWeightedScore += $score['scaled_percentage'] * $weight;
            $totalWeight += $weight;
        }

        $overallPercentage = $totalWeight > 0 ? round($totalWeightedScore / $totalWeight) : 0;

        return [
            'percentage' => $overallPercentage,
            'level' => $this->getMaturityLevel($overallPercentage)
        ];
    }

    public function getMaturityLevel($percentage)
    {
        if ($percentage >= 81 && $percentage <= 100) return 'Leader/Transformative';
        if ($percentage >= 61 && $percentage <= 80) return 'Advanced/Strategic';
        if ($percentage >= 41 && $percentage <= 60) return 'Competent/Defined';
        if ($percentage >= 21 && $percentage <= 40) return 'Developing/Emerging';
        if ($percentage >= 0 && $percentage <= 20) return 'Novice/Beginner';
        return 'Novice/Beginner';
        
    }

    public function render()
    {
        $currentSectionName = $this->currentSection >= 0 ? $this->sectionNames[$this->currentSection] : 'Basic Information';

        $scores = [];
        $overallScore = null;

        if ($this->showResults) {
            foreach ($this->sectionNames as $sectionName) {
                $scores[$sectionName] = $this->calculateSectionScore($sectionName);
            }
            $overallScore = $this->calculateOverallScore($scores);
        }

        return view('livewire.digital-maturity-assessment', [
            'sections' => $this->sections,
            'currentSectionName' => $currentSectionName,
            'sectionNames' => $this->sectionNames,
            'scores' => $scores,
            'overallScore' => $overallScore,
        ]);
    }
}
