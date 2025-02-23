<?php

namespace App\Livewire;

use App\Models\AssessmentResponse;
use Livewire\Component;

use function Ramsey\Uuid\v1;

class DigitalMaturityAssessment extends Component
{
    public $currentSection = '';
    public $answers = [];
    public $showResults = false;

    // Basic Information
    public $basicInfo = [
        'respondent_name' => '',
        'business_name' => '',
        'gender' => '',
        'phone_number' => '',
        'email' => '',
        'state' => '',
        'nationality' => '',
        'business_sector' => '',
        'employee_count' => '',
        'role' => '',
        'years_in_business' => '',
        'digital_advisor' => '',
        'has_disability' => false,
        'consent_given' => false,
        'multiple_states' => false,
        'operating_states' => '',
        'staff_size' => ''
    ];

    protected $rules = [
        'basicInfo.respondent_name' => 'required',
        'basicInfo.business_name' => 'required',
        'basicInfo.gender' => 'required',
        'basicInfo.phone_number' => 'required',
        'basicInfo.email' => 'required|email',
        'basicInfo.state' => 'required',
        //      'basicInfo.nationality' => 'required',
        'basicInfo.business_sector' => 'required',
        'basicInfo.employee_count' => 'required|numeric',
        'basicInfo.role' => 'required',
        'basicInfo.years_in_business' => 'required|numeric',
        'basicInfo.consent_given' => 'required|accepted',
        'basicInfo.staff_size' => 'required'
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

    public function saveAssessment()
    {
        if ($this->basicInfo['multiple_states'] && empty($this->basicInfo['operating_states'])) {
            $this->addError('operating_states', 'Please list the operating states.');
            return;
        }

        $scores = [];
        foreach ($this->sections as $sectionName => $questions) {
            $scores[$sectionName] = $this->calculateSectionScore($sectionName);
        }
        $overallScore = $this->calculateOverallScore($scores);

        AssessmentResponse::create([
            // Basic Information
            'respondent_name' => $this->basicInfo['respondent_name'],
            'business_name' => $this->basicInfo['business_name'],
            'gender' => $this->basicInfo['gender'],
            'phone_number' => $this->basicInfo['phone_number'],
            'email' => $this->basicInfo['email'],
            'state' => $this->basicInfo['state'],
            'nationality' => $this->basicInfo['nationality'],
            'business_sector' => $this->basicInfo['business_sector'],
            'employee_count' => $this->basicInfo['employee_count'],
            'role' => $this->basicInfo['role'],
            'years_in_business' => $this->basicInfo['years_in_business'],
            'digital_advisor' => $this->basicInfo['digital_advisor'],
            'has_disability' => $this->basicInfo['has_disability'],
            'consent_given' => $this->basicInfo['consent_given'],
            'multiple_states' => $this->basicInfo['multiple_states'],
            'operating_states' => $this->basicInfo['operating_states'],
            'staff_size' => $this->basicInfo['staff_size'],

            // Assessment Data
            'assessment_answers' => $this->answers,
            'section_scores' => $scores,
            'overall_score' => $overallScore['percentage'],
            'maturity_level' => $overallScore['level']
        ]);
    }

    public function startAssessment()
    {
        $this->validate();

        if (!$this->basicInfo['consent_given']) {
            $this->addError('consent', 'You must give consent to proceed with the assessment.');
            return;
        }

        $this->currentSection = 0;
    }

    protected $sections = [
        // category 1
        'Business Information & Digital Strategy' => [
            [

                'id' => 'category_1_q2',
                'type' => 'checkbox',
                'question' => 'In which of the following ways is your enterprise prepared for (more) digitalization? ',
                'instruction' => 'select all that apply.',
                'options' => [
                    ['text' => 'My business has a clear digital plan (e.g., website, social media, mobile platforms).', 'points' => 1],
                    ['text' => 'We regularly review our digital approach to stay competitive.', 'points' => 1],
                    ['text' => 'Our digital strategy is aligned with our overall business goals.', 'points' => 1],
                    ['text' => 'We set measurable goals for our digital initiatives.', 'points' => 1],
                    ['text' => 'We actively use digital channels (social media, online ads) to promote our products/services.', 'points' => 1],
                    ['text' => 'We monitor digital trends and competitor activities to update our digital strategy', 'points' => 1],
                    ['text' => 'We have secured the necessary financial resources and IT infrastructure for digitalization.', 'points' => 1],
                    ['text' => 'We regularly track customer feedback and performance data from online interactions.', 'points' => 1],
                ],
            ],

        ],

        // category 2
        'Internet Access, Technology Use & Digital Readiness' => [
            [

                'id' => 'category_2_q1',
                'type' => 'select',
                'question' => 'Does your business have an active internet connection?',
                'instruction' => '',
                'options' => [
                    ['text' => 'Yes', 'points' => 1],
                    ['text' => 'No', 'points' => 0],
                ],
            ],

            [

                'id' => 'category_2_q2',
                'type' => 'checkbox',
                'question' => 'Which of the following devices are used in your business? ',
                'instruction' => 'Select all that apply.',
                'options' => [
                    ['text' => 'Smartphone', 'points' => 1],
                    ['text' => 'Laptop/Desktop', 'points' => 1],
                    ['text' => 'Tablet', 'points' => 1],
                    ['text' => 'Point of Sale (POS) terminal', 'points' => 1],
                    ['text' => 'Barcode, QR, or RFID scanner', 'points' => 1],
                    ['text' => 'Other', 'points' => 1],
                ],
            ],

            [

                'id' => 'category_2_q3',
                'type' => 'checkbox',
                'question' => 'Which of the following digital technologies and solutions are already used by your enterprise? (Select all that apply) ',
                'instruction' => 'Select all that apply.',
                'options' => [
                    ['text' => 'Connectivity & Cloud Services (e.g., Google Drive, OneDrive, high-speed fiber internet, cloud computing, remote office access)', 'points' => 1],
                    ['text' => 'Digital tools (Email, Zoom, Google Meet, online payment systems, POS, inventory management software, digital marketing, accounting software, WhatsApp, Facebook Messenger)', 'points' => 1],
                    ['text' => 'Digital devices (computers, smartphones, tablets Smartphone, Laptop/Desktop, Tablet, Point of Sale (POS) terminal, Barcode, QR, or RFID scanner)', 'points' => 1],
                    ['text' => 'Digital Presence & Communication (website, online forms, blogs, live chats, social media, chatbots)', 'points' => 1],
                    ['text' => 'Digital Commerce & Marketing (e-commerce sales, online ads, social media promotion)', 'points' => 1],
                    ['text' => 'External Digital Interaction (e-government services, online public procurement)', 'points' => 1],
                    ['text' => 'Internal Collaboration & Management (teleworking platforms, videoconferencing, intranet, ERP/CRM/SCM systems)', 'points' => 1],
                ],
            ],

        ],

        // category 3
        'Digitalization of Business Processes & People & Skills' => [
            [
                'id' => 'category_3_q1',
                'type' => 'checkbox',
                'question' => 'What business functions have been digitized? ',
                'instruction' => 'Select all that apply.',
                'options' => [
                    ['text' => 'Inventory Management', 'points' => 1],
                    ['text' => 'Human Resources/Payroll', 'points' => 1],
                    ['text' => 'Customer Relationship Management (CRM)', 'points' => 1],
                    ['text' => 'Supply Chain & Logistics', 'points' => 1],
                    ['text' => 'Digital Banking & Transactions', 'points' => 1],
                ],
            ],

            [
                'id' => 'category_3_q2',
                'type' => 'checkbox',
                'question' => 'How does your business store information?',
                'instruction' => 'Select all that apply.',
                'options' => [
                    ['text' => 'Physical archives (paper records)', 'points' => 0],
                    ['text' => 'Local storage (hard drives, USBs, etc.)', 'points' => 1],
                    ['text' => 'Cloud storage', 'points' => 1],
                ],
            ],

            [
                'id' => 'category_3_q3',
                'type' => 'checkbox',
                'question' => 'How digitalized are your team members and processes?',
                'instruction' => 'Select all that apply.',
                'options' => [
                    ['text' => 'My business use digital platforms for supplier and Customer interactions', 'points' => 1],
                    ['text' => 'My business collect and analyze customer or operational data', 'points' => 1],
                    ['text' => 'My business allow employees to work remotely', 'points' => 1],
                    ['text' => 'Employees receive training on using essential digital tools.', 'points' => 1],
                    ['text' => 'My team is comfortable using smartphones, computers, and business software.', 'points' => 1],
                    ['text' => 'We have a designated person (or team) responsible for managing our digital channels and technology.', 'points' => 1],
                    ['text' => 'Staff are encouraged to share ideas for digital improvements.', 'points' => 1],
                    ['text' => 'Employees can often troubleshoot basic digital issues on their own.', 'points' => 1],
                    ['text' => 'We provide informal learning opportunities (online tutorials, workshops) to enhance staff digital skills.', 'points' => 1],

                ],
            ],
        ],

        // category 4
        'Digital Presence & Data Management' => [
            [
                'id' => 'category_4_q1',
                'type' => 'checkbox',
                'question' => 'Which platforms does your business use?',
                'instruction' => 'Select all that apply.',
                'options' => [
                    ['text' => 'Website', 'points' => 1],
                    ['text' => 'Social media (Facebook, Instagram, X, LinkedIn)', 'points' => 1],
                    ['text' => 'Messaging App (WhatsApp, Messenger, Email)', 'points' => 1],
                    ['text' => 'Advance Digital Platforms (CRMs, HRM, Industry process automation Software)', 'points' => 1],
                    ['text' => 'Other', 'points' => 1],
                ],
            ],

            [
                'id' => 'category_4_q2',
                'type' => 'radio',
                'question' => 'Who manages your digital presence?',
                'instruction' => 'Select one.',
                'options' => [
                    ['text' => 'Internal staff/External consultant', 'points' => 1],
                    ['text' => 'Not managed', 'points' => 0],
                ],
            ],

            [
                'id' => 'category_4_q3',
                'type' => 'select',
                'question' => 'Do you have a designated budget for digitalisation?',
                'options' => [
                    ['text' => 'Yes', 'points' => 1],
                    ['text' => 'No', 'points' => 0],
                ],
            ],

            [
                'id' => 'category_4_q4',
                'type' => 'checkbox',
                'question' => 'What features does your website include? ',
                'instruction' => 'Select all that apply.',
                'options' => [
                    ['text' => 'Company information', 'points' => 1],
                    ['text' => 'Contact details', 'points' => 1],
                    ['text' => 'Online store', 'points' => 1],
                    ['text' => 'Payment gateway', 'points' => 1],
                    ['text' => 'Customer service', 'points' => 1],
                    ['text' => 'Other', 'points' => 1],
                ],
            ],

            [
                'id' => 'category_4_q5',
                'type' => 'checkbox',
                'question' => 'Data Management',
                'instruction' => 'Select all that apply.',
                'options' => [
                    ['text' => 'I am aware of Data Privacy Protection principles', 'points' => 1],
                    ['text' => 'We collect customer data and use it to improve our service.', 'points' => 1],
                    ['text' => 'Our business has basic systems in place to securely store and back up data.', 'points' => 1],
                    ['text' => 'Data is used to make informed decisions.', 'points' => 1],
                    ['text' => 'We ensure customer data privacy by following clear guidelines or policies.', 'points' => 1],
                    ['text' => 'Our business uses simple data analytics to gauge performance.', 'points' => 1],
                    ['text' => 'We regularly review and update our data storage practices.', 'points' => 1],
                ],
            ],
        ],

        // category 5
        'Digital Transactions, Cybersecurity, Automation & Emerging Technologies' => [
            [
                'id' => 'category_5_q1',
                'type' => 'checkbox',
                'question' => 'How do customers purchase from your business? ',
                'instruction' => 'Select all that apply.',
                'options' => [
                    ['text' => 'Physical store', 'points' => 1],
                    ['text' => 'Own website', 'points' => 1],
                    ['text' => 'Third-party platforms (Jumia, Konga, etc.)', 'points' => 1],
                    ['text' => 'Social media (Facebook, WhatsApp, etc.)', 'points' => 1],
                ],
            ],

            [
                'id' => 'category_5_q2',
                'type' => 'checkbox',
                'question' => 'What payment methods do you accept?',
                'instruction' => 'Select all that apply.',
                'options' => [
                    ['text' => 'Cash', 'points' => 0],
                    ['text' => 'Bank transfers', 'points' => 1],
                    ['text' => 'Debit/Credit cards', 'points' => 1],
                    ['text' => 'Mobile payment platforms (Opay, Flutterwave, etc)', 'points' => 1],
                ],
            ],

            [
                'id' => 'category_5_q3',
                'type' => 'radio',
                'question' => 'How important is cybersecurity for your business?',
                'options' => [
                    ['text' => 'Not important', 'points' => 0],
                    ['text' => 'Important', 'points' => 1],
                    ['text' => 'Very important', 'points' => 1],
                ],
            ],

            [
                'id' => 'category_5_q4',
                'type' => 'checkbox',
                'question' => 'What cybersecurity measures have you implemented?',
                'instruction' => 'Select all that apply.?',
                'options' => [
                    ['text' => 'Regular software updates', 'points' => 1],
                    ['text' => 'Antivirus software', 'points' => 1],
                    ['text' => 'Data backups', 'points' => 1],
                    ['text' => 'Two-step authentication', 'points' => 1],
                    ['text' => 'Staff cybersecurity training', 'points' => 1],
                    ['text' => 'None', 'points' => 0],
                ],
            ],

            [
                'id' => 'category_5_q5',
                'type' => 'checkbox',
                'question' => 'Automation & Emerging Technologies',
                'instruction' => 'Select all that apply.?',
                'options' => [
                    ['text' => 'We use automation (automated invoicing, SMS reminders, digital appointment scheduling).', 'points' => 1],
                    ['text' => 'I am aware of simple AI or analytics tools that can help boost our efficiency (chatbots, basic data analytics).', 'points' => 1],
                    ['text' => 'If affordable, I would consider adopting more automated solutions.', 'points' => 1],
                ],
            ],
        ],

        // category 6
        'Green Digitalisation & Readiness for Digital Transformation' => [
            [
                'id' => 'category_6_q1',
                'type' => 'checkbox',
                'question' => 'Green Digitalisation',
                'instruction' => 'Select all that apply.',
                'options' => [
                    ['text' => 'We use digital tools to reduce paper usage and minimize waste.', 'points' => 1],
                    ['text' => 'Our business is interested in technologies that help reduce energy consumption.', 'points' => 1],
                    ['text' => 'We consider environmental impact when choosing new digital tools and solutions.', 'points' => 1],
                ],
            ],

            [
                'id' => 'category_6_q2',
                'type' => 'select',
                'question' => 'Does your business have sufficient technological infrastructure?',
                'options' => [
                    ['text' => 'Yes', 'points' => 1],
                    ['text' => 'No', 'points' => 0],
                ],
            ],

            [
                'id' => 'category_6_q3',
                'type' => 'select',
                'question' => 'Are you interested in increasing your business’s level of digitalization?',
                'options' => [
                    ['text' => 'Yes', 'points' => 1],
                    ['text' => 'No', 'points' => 0],
                ],
            ],

            [
                'id' => 'category_6_q4',
                'type' => 'checkbox',
                'question' => 'What challenges limit your business’s digital transformation? ',
                'options' => [
                    ['text' => 'Lack of funds', 'points' => 1],
                    ['text' => 'Lack of digital knowledge', 'points' => 1],
                    ['text' => 'Resistance to change', 'points' => 1],
                    ['text' => 'Security concerns', 'points' => 1],
                    ['text' => 'Other', 'points' => 1],
                    ['text' => 'I don\'t know', 'points' => 0],
                ],
            ],

            [
                'id' => 'category_6_q5',
                'type' => 'select',
                'question' => 'Does your business consider digital skills when hiring?',
                'options' => [
                    ['text' => 'Yes', 'points' => 1],
                    ['text' => 'No', 'points' => 0],
                ],
            ],

            [
                'id' => 'category_6_q6',
                'type' => 'select',
                'question' => 'How often does your business conduct digital training for staff?',
                'options' => [
                    ['text' => 'Never', 'points' => 0],
                    ['text' => 'Annually', 'points' => 1],
                    ['text' => 'More than once a year', 'points' => 1],
                ],
            ],
        ],

        // category 7
        'Digitalisation Exposure/Knowledge' => [
            [
                'id' => 'category_7_q1',
                'type' => 'checkbox',
                'question' => 'Which of the following digital terminologies/technologies are you familiar with or already used by your enterprise? ',
                'instruction' => 'Select all that apply',
                'options' => [
                    ['text' => 'Digitalisation, Innovation, Technology, Digital Transformation.', 'points' => 1],
                    ['text' => 'Virtual Reality, Augmented Reality, Artificial Intelligence, Robotics, Emerging Technology.', 'points' => 1],
                    ['text' => 'Digital Media, Digital Marketing, Innovation, Customer Relationship Management, Human Resource Management Software.', 'points' => 1],
                    ['text' => 'Software As A Service, Platform As A Service.', 'points' => 1],
                    ['text' => 'Computer-Aided Design (CAD) & Manufacturing (CAM).', 'points' => 1],
                    ['text' => 'Manufacturing Execution Systems.', 'points' => 1],
                    ['text' => 'Internet of Things (IoT) And Industrial Internet of Things (I-IoT).', 'points' => 1],
                    ['text' => 'Blockchain Technology.', 'points' => 1],
                    ['text' => 'Cyber Security, Data Analytics, Software Engineering.', 'points' => 1],
                    ['text' => 'Additive Manufacturing (E.G. 3D Printers).', 'points' => 1],
                ],
            ],

        ],
    ];

    public function mount()
    {
        foreach ($this->sections as $sectionName => $questions) {
            foreach ($questions as $question) {
                if ($question['type'] === 'checkbox') {
                    $this->answers[$question['id']] = [];
                } else {
                    $this->answers[$question['id']] = '';
                }
            }
        }
    }

    public function nextSection()
    {
        if ($this->currentSection < count($this->sections) - 1) {
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

        foreach ($this->sections[$sectionName] as $question) {
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

        return [
            'score' => $totalPoints,
            'max' => $maxPoints,
            'percentage' => $maxPoints > 0 ? round(($totalPoints / $maxPoints) * 100) : 0
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

    public function calculateOverallScore($scores)
    {
        if (empty($scores)) {
            return [
                'percentage' => 0,
                'level' => 'Novice/Beginner'
            ];
        }

        $totalPercentage = 0;
        $sectionsCount = count($scores);

        foreach ($scores as $score) {
            $totalPercentage += $score['percentage'];
        }

        $averagePercentage = round($totalPercentage / $sectionsCount);

        return [
            'percentage' => $averagePercentage,
            'level' => $this->getMaturityLevel($averagePercentage)
        ];
    }

    public function render()
    {
        $sectionNames = array_keys($this->sections);
        $currentSectionName = $this->currentSection >= 0 ? $sectionNames[$this->currentSection] : 'Basic Information';

        $scores = [];
        $overallScore = null;

        if ($this->showResults) {
            foreach ($this->sections as $sectionName => $questions) {
                $scores[$sectionName] = $this->calculateSectionScore($sectionName);
            }
            $overallScore = $this->calculateOverallScore($scores);

        }

        return view('livewire.digital-maturity-assessment', [
            'sections' => $this->sections,
            'currentSectionName' => $currentSectionName,
            'sectionNames' => $sectionNames,
            'scores' => $scores,
            'overallScore' => $overallScore,
        ]);
    }

}
