<?php

namespace Database\Seeders;

use App\Models\AssessmentQuestion;
use App\Models\AssessmentSection;
use Illuminate\Database\Seeder;

class AssessmentQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'name' => 'Internet Access, Technology Use and Digital Readiness',
                'description' => 'Assesses the basic digital infrastructure and technology usage in your business',
                'weight' => 0.15,
                'scaling_factor' => 3.0,
                'questions' => [
                    [
                        'question' => 'Does your business have an active internet connection?',
                        'type' => 'select',
                        'instruction' => 'select one',
                        'options' => [
                            ['text' => 'Yes', 'points' => 1],
                            ['text' => 'No', 'points' => 0],
                        ],
                    ],
                    [
                        'question' => 'Which of the following devices are used in your business?',
                        'type' => 'checkbox',
                        'instruction' => 'select all that apply',
                        'options' => [
                            ['text' => 'Smartphone and/or Tablet', 'points' => 1],
                            ['text' => 'Laptop/Desktop', 'points' => 1],
                            ['text' => 'Point of Sale (POS) terminal', 'points' => 1],
                            ['text' => 'Barcode, QR, or RFID scanner', 'points' => 1],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Digitalisation of Business Processes, People and Skills',
                'description' => 'Evaluates how digital tools are integrated into business operations and staff capabilities',
                'weight' => 0.20,
                'scaling_factor' => 1.82,
                'questions' => [
                    [
                        'question' => 'What business functions have been digitised?',
                        'type' => 'checkbox',
                        'instruction' => 'select all that apply',
                        'options' => [
                            ['text' => 'Inventory Management', 'points' => 1],
                            ['text' => 'Human Resources/Payroll', 'points' => 1],
                            ['text' => 'Customer Relationship Management (CRM)', 'points' => 1],
                            ['text' => 'Supply Chain & Logistics', 'points' => 1],
                            ['text' => 'Digital Banking & Transactions', 'points' => 1],
                            ['text' => 'Sales & Marketing', 'points' => 1],
                            ['text' => 'Book keeping & Accounting', 'points' => 1],
                        ],
                    ],
                    [
                        'question' => 'How does your business store information?',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
                        'options' => [
                            ['text' => 'Physical archives (paper records)', 'points' => 0],
                            ['text' => 'Local storage (hard drives, USBs, etc.)', 'points' => 1],
                            ['text' => 'Cloud storage (google drive, one drive, dropbox, etc.)', 'points' => 1],
                            ['text' => 'Other', 'points' => 1],
                        ],
                    ],
                    [
                        'question' => 'Does your business consider digital skills when hiring?',
                        'type' => 'select',
                        'instruction' => 'Select.',
                        'options' => [
                            ['text' => 'Yes', 'points' => 1],
                            ['text' => 'No', 'points' => 0],
                        ],
                    ],
                    [
                        'question' => 'How often does your business conduct digital training for staff?',
                        'type' => 'select',
                        'instruction' => 'Select.',
                        'options' => [
                            ['text' => 'Never', 'points' => 0],
                            ['text' => 'Annually', 'points' => 1],
                            ['text' => 'More than once a year', 'points' => 1],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Digital Presence & Data Management',
                'description' => 'Measures your business\'s online presence and data handling practices',
                'weight' => 0.20,
                'scaling_factor' => 1.25,
                'questions' => [
                    [
                        'question' => 'Which platforms does your business use?',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
                        'options' => [
                            ['text' => 'Website', 'points' => 1],
                            ['text' => 'Social media (Facebook, Instagram, X, LinkedIn)', 'points' => 1],
                            ['text' => 'Messaging App (WhatsApp, Messenger, Email)', 'points' => 1],
                            ['text' => 'Advance Digital Platforms (CRMs, HRM, Industry process automation Software)', 'points' => 1],
                            ['text' => 'None of the above', 'points' => 0],
                        ],
                    ],
                    [
                        'question' => 'Who manages your digital presence?',
                        'type' => 'checkbox',
                        'instruction' => 'Select one.',
                        'options' => [
                            ['text' => 'Internal staff', 'points' => 1],
                            ['text' => 'External consultant', 'points' => 1],
                            ['text' => 'Not managed', 'points' => 0],
                        ],
                    ],
                    [
                        'question' => 'Do you have a budget for digital solutions? (Such as internet, software subscription etc)',
                        'type' => 'select',
                        'instruction' => 'Select',
                        'options' => [
                            ['text' => 'Yes', 'points' => 1],
                            ['text' => 'No', 'points' => 0],
                        ],
                    ],
                    [
                        'question' => 'What features does your website include?',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
                        'options' => [
                            ['text' => 'Company information', 'points' => 1],
                            ['text' => 'Contact details', 'points' => 1],
                            ['text' => 'Online store', 'points' => 1],
                            ['text' => 'Payment gateway', 'points' => 1],
                            ['text' => 'Customer service', 'points' => 1],
                            ['text' => 'No', 'points' => 0],
                        ],
                    ],
                    [
                        'question' => 'Data Management',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
                        'options' => [
                            ['text' => 'I am aware of the Nigerian Data Protection Act 2023 (NDPC)', 'points' => 1],
                            ['text' => 'We collect customer data', 'points' => 1],
                            ['text' => 'Our business securely stores and backs up data.', 'points' => 1],
                            ['text' => 'Data is used to make informed decisions.', 'points' => 1],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Digital Transactions, Cybersecurity, Automation & Emerging Technologies',
                'description' => 'Evaluates your business\'s digital transaction capabilities and security measures',
                'weight' => 0.20,
                'scaling_factor' => 1.43,
                'questions' => [
                    [
                        'question' => 'How do customers purchase from your business?',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
                        'options' => [
                            ['text' => 'Physical store', 'points' => 1],
                            ['text' => 'Online store (owned)', 'points' => 1],
                            ['text' => 'Third-party platforms (Jumia, Konga, etc.)', 'points' => 1],
                            ['text' => 'Social media (Facebook, WhatsApp, etc.)', 'points' => 1],
                        ],
                    ],
                    [
                        'question' => 'What payment methods do you accept?',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
                        'options' => [
                            ['text' => 'Cash only', 'points' => 1],
                            ['text' => 'Bank transfers', 'points' => 1],
                            ['text' => 'Debit/Credit cards', 'points' => 1],
                            ['text' => 'Mobile payment platforms (Opay, Flutterwave, etc)', 'points' => 1],
                        ],
                    ],
                    [
                        'question' => 'What cybersecurity measures have you implemented?',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
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
                        'question' => 'Automation & Emerging Technologies',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
                        'options' => [
                            ['text' => 'We use simple automation tools (automated invoicing, automated responses).', 'points' => 1],
                            ['text' => 'I am aware of AI tools for businesses (chatbots).', 'points' => 1],
                            ['text' => 'None', 'points' => 0],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Green Digitalisation & Readiness for Digital Transformation',
                'description' => 'Assesses your business\'s commitment to sustainable digital practices',
                'weight' => 0.15,
                'scaling_factor' => 1.25,
                'questions' => [
                    [
                        'question' => 'Green Digitalisation',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
                        'options' => [
                            ['text' => 'We use digital tools to reduce paper usage and minimise waste.', 'points' => 1],
                            ['text' => 'Our business is interested in technologies that help reduce energy consumption.(Solar, Inverter AC/Refrigerator)', 'points' => 1],
                            ['text' => 'We consider environmental impact when choosing new digital tools and solutions.(E-signing, E-invoicing, digital collaboration tools).', 'points' => 1],
                        ],
                    ],
                    [
                        'question' => 'What challenges limit your business\'s digital transformation?',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
                        'options' => [
                            ['text' => 'Lack of funds', 'points' => 1],
                            ['text' => 'Lack of digital knowledge', 'points' => 1],
                            ['text' => 'Resistance to change', 'points' => 1],
                            ['text' => 'Security concerns', 'points' => 1],
                            ['text' => 'I don\'t know', 'points' => 0],
                        ],
                    ],
                    [
                        'question' => 'I will consider adopting digitalisation',
                        'type' => 'select',
                        'options' => [
                            ['text' => 'Yes', 'points' => 1],
                            ['text' => 'No', 'points' => 0],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Validation Section',
                'description' => 'Validates the accuracy of your responses and assesses recent digital initiatives',
                'weight' => 0.10,
                'scaling_factor' => 0.60,
                'questions' => [
                    [
                        'question' => 'Which digital tools have you purchased or implemented in the last 12 months?',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
                        'options' => [
                            ['text' => 'New smartphone for business use.', 'points' => 1],
                            ['text' => 'Upgraded computer/laptop.', 'points' => 1],
                            ['text' => 'Portable payment device (POS terminal, mobile payment device).', 'points' => 1],
                            ['text' => 'Inventory management software.', 'points' => 1],
                            ['text' => 'Bluetooth/wireless connectivity devices.', 'points' => 1],
                            ['text' => 'No new tools purchased or implemented.', 'points' => 0],
                        ],
                    ],
                    [
                        'question' => 'In which areas have you reduced manual work through digital solutions?',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
                        'options' => [
                            ['text' => 'Automated invoice generation', 'points' => 1],
                            ['text' => 'Digital employee time tracking', 'points' => 1],
                            ['text' => 'Online customer form submissions', 'points' => 1],
                            ['text' => 'Automated email responses', 'points' => 1],
                            ['text' => 'Digital document filing', 'points' => 1],
                            ['text' => 'No workflow automation implemented', 'points' => 0],
                        ],
                    ],
                    [
                        'question' => 'What online activities have you undertaken to promote your business?',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
                        'options' => [
                            ['text' => 'Created Business WhatsApp account', 'points' => 1],
                            ['text' => 'Posted product pictures on Instagram', 'points' => 1],
                            ['text' => 'Updated Google Business listing', 'points' => 1],
                            ['text' => 'Shared customer testimonials online', 'points' => 1],
                            ['text' => 'Started email marketing', 'points' => 1],
                            ['text' => 'No online promotional activities', 'points' => 0],
                        ],
                    ],
                    [
                        'question' => 'What specific steps have you taken to secure digital transactions?',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
                        'options' => [
                            ['text' => 'Changed passwords in last 3 months', 'points' => 1],
                            ['text' => 'Installed antivirus software', 'points' => 1],
                            ['text' => 'Used secure WiFi for transactions', 'points' => 1],
                            ['text' => 'Two factor authentication', 'points' => 1],
                            ['text' => 'Enabled transaction alerts', 'points' => 1],
                            ['text' => 'No specific security measures', 'points' => 0],
                        ],
                    ],
                    [
                        'question' => 'How are you reducing environmental impact through digital means?',
                        'type' => 'checkbox',
                        'instruction' => 'Select all that apply.',
                        'options' => [
                            ['text' => 'Reduced printing by using digital documents', 'points' => 1],
                            ['text' => 'Used digital invoicing', 'points' => 1],
                            ['text' => 'Encouraged digital communication over physical', 'points' => 1],
                            ['text' => 'Used energy-saving device settings', 'points' => 1],
                            ['text' => 'Tracked resource consumption digitally', 'points' => 1],
                            ['text' => 'No sustainability efforts', 'points' => 0],
                        ],
                    ],
                ],
            ],
        ];

        $order = 1;
        foreach ($sections as $sectionData) {
            // Create section
            $section = AssessmentSection::create([
                'name' => $sectionData['name'],
                'description' => $sectionData['description'],
                'weight' => $sectionData['weight'],
                'scaling_factor' => $sectionData['scaling_factor'],
                'order' => $order++
            ]);

            // Create questions for this section
            $questionOrder = 1;
            foreach ($sectionData['questions'] as $question) {
                AssessmentQuestion::create([
                    'section_id' => $section->id,
                    'question' => $question['question'],
                    'type' => $question['type'],
                    'instruction' => $question['instruction'] ?? null,
                    'options' => $question['options'],
                    'order' => $questionOrder++
                ]);
            }
        }
    }
} 