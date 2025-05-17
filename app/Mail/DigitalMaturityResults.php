<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Barryvdh\DomPDF\Facade\Pdf;

class DigitalMaturityResults extends Mailable
{
    use Queueable, SerializesModels;

    public $categoryScores, $totalScore, $businessName;

    public function __construct($categoryScores, $totalScore, $businessName)
    {
        // Add recommendations to each section's score data
        foreach ($categoryScores as $section => &$score) {
            $score['level'] = $this->getMaturityLevel($score['percentage']);
            $score['recommendations'] = $this->getSectionRecommendations($section, $score['level']);
        }

        $this->categoryScores = $categoryScores;
        $this->totalScore = $totalScore;
        $this->businessName = $businessName;
    }

    protected function getMaturityLevel($percentage)
    {
        if ($percentage >= 81 && $percentage <= 100) return 'Leader/Transformative';
        if ($percentage >= 61 && $percentage <= 80) return 'Advanced/Strategic';
        if ($percentage >= 41 && $percentage <= 60) return 'Competent/Defined';
        if ($percentage >= 21 && $percentage <= 40) return 'Developing/Emerging';
        if ($percentage >= 0 && $percentage <= 20) return 'Novice/Beginner';
        return 'Novice/Beginner';
    }

    protected function getSectionRecommendations($sectionName, $level)
    {
        $recommendations = [
            'Internet Access, Technology Use and Digital Readiness' => [
                'Novice/Beginner' => [
                    'Establish reliable internet connectivity through wired broadband or mobile data plans with adequate data allowances',
                    'Invest in at least one business smartphone and consider a basic laptop for administrative functions'
                ],
                'Developing/Emerging' => [
                    'Upgrade internet speed and reliability',
                    'Standardise devices across your business with basic security protocols',
                    'Set up a dedicated business email account separate from personal accounts',
                    'Train staff on basic device usage and troubleshooting'
                ],
                'Competent/Defined' => [
                    'Implement network security measures like secure Wi-Fi with strong passwords',
                    'Consider specialised equipment relevant to your industry (POS systems, scanners)',
                    'Begin documenting technology-related procedures and policies'
                ],
                'Advanced/Strategic' => [
                    'Establish dedicated IT support (internal or outsourced)',
                    'Implement comprehensive technology inventory tracking',
                    'Deploy centralized device management where feasible',
                    'Create a formal digital strategy aligned with business goals'
                ],
                'Leader/Transformative' => [
                    'Develop redundant infrastructure for business continuity',
                    'Implement advanced network management and monitoring',
                    'Create a technology innovation team/role',
                    'Establish formal IT governance processes',
                    'Explore emerging technologies specific to your industry'
                ]
            ],
            'Digitalisation of Business Processes, People and Skills' => [
                'Novice/Beginner' => [
                    'Identify one core business process to digitise first (invoicing, inventory, etc.)',
                    'Begin transitioning from paper to digital record-keeping',
                    'Assess digital literacy levels of all staff',
                    'Utilise free digital tools for basic business functions'
                ],
                'Developing/Emerging' => [
                    'Implement digital tools for financial management and inventory',
                    'Create digital templates for recurring business documents',
                    'Develop a basic skills development plan for staff',
                    'Consider digital skills in hiring criteria for new positions'
                ],
                'Competent/Defined' => [
                    'Integrate multiple business systems where possible',
                    'Implement a formal digital training program for all staff',
                    'Create digital process documentation and standard operating procedures',
                    'Begin collecting and using data from digitised processes'
                ],
                'Advanced/Strategic' => [
                    'Implement comprehensive business management software',
                    'Develop a formal digital talent acquisition and development strategy',
                    'Establish metrics to measure efficiency gains from digital processes',
                    'Create digital centers of excellence within the organization'
                ],
                'Leader/Transformative' => [
                    'Fully integrate all business processes in a cohesive digital ecosystem',
                    'Implement advanced analytics for process optimisation',
                    'Establish continuous innovation cycles for process improvement',
                    'Create a culture of digital excellence and experimentation',
                    'Develop specialised digital roles and career paths'
                ]
            ],
            'Digital Presence & Data Management' => [
                'Novice/Beginner' => [
                    'Create basic social media accounts for your business',
                    'Establish a Google Business profile with accurate information',
                    'Implement a simple contact management system (even spreadsheet-based)',
                    'Begin collecting customer contact information digitally'
                ],
                'Developing/Emerging' => [
                    'Develop a simple website with business information and contact details',
                    'Create a content calendar for regular social media posts',
                    'Implement a structured approach to data backup',
                    'Begin collecting basic customer feedback through digital channels'
                ],
                'Competent/Defined' => [
                    'Deploy a comprehensive website with product/service information',
                    'Implement a basic customer relationship management (CRM) system',
                    'Develop a consistent brand voice across digital channels',
                    'Create a data management policy compliant with Nigerian Data Protection Act 2023'
                ],
                'Advanced/Strategic' => [
                    'Implement e-commerce capabilities with multiple payment options',
                    'Develop an integrated multi-channel marketing approach',
                    'Utilise data analytics for customer insights and decision making',
                    'Implement a comprehensive data security and privacy framework'
                ],
                'Leader/Transformative' => [
                    'Create personalised digital experiences based on customer data',
                    'Implement advanced website functionality (chatbots, personalization)',
                    'Develop a formal data governance framework',
                    'Utilise predictive analytics for business forecasting',
                    'Create an omnichannel presence with consistent customer experience'
                ]
            ],
            'Digital Transactions, Cybersecurity, Automation & Emerging Technologies' => [
                'Novice/Beginner' => [
                    'Accept at least one digital payment method (bank transfers)',
                    'Implement basic password management practices',
                    'Install antivirus software on all business computers',
                    'Learn about basic security threats relevant to your business'
                ],
                'Developing/Emerging' => [
                    'Offer multiple digital payment options',
                    'Create a regular data backup procedure',
                    'Implement basic automated responses for common customer inquiries',
                    'Develop a simple incident response plan for cyber incidents'
                ],
                'Competent/Defined' => [
                    'Integrate payment processing directly into business systems',
                    'Implement staff training on cybersecurity best practices',
                    'Deploy two-factor authentication for critical systems',
                    'Begin process automation for repetitive business tasks'
                ],
                'Advanced/Strategic' => [
                    'Implement a comprehensive cybersecurity framework',
                    'Utilise payment analytics to optimize pricing and offerings',
                    'Deploy advanced automation for complex business processes',
                    'Pilot AI tools for specific business functions (customer service, inventory)'
                ],
                'Leader/Transformative' => [
                    'Implement advanced fraud detection and prevention systems',
                    'Develop a cybersecurity culture with regular simulations and training',
                    'Deploy comprehensive process automation across departments',
                    'Integrate AI and emerging technologies into core business operations',
                    'Establish innovation processes to continuously identify automation opportunities'
                ]
            ],
            'Green Digitalisation & Readiness for Digital Transformation' => [
                'Novice/Beginner' => [
                    'Begin transitioning from paper to digital documents where feasible',
                    'Implement basic energy-saving settings on all devices',
                    'Create awareness about green digital practices among staff',
                    'Identify sustainability goals relevant to your business'
                ],
                'Developing/Emerging' => [
                    'Implement digital signatures to eliminate printing',
                    'Set targets for reducing paper consumption',
                    'Research energy efficient technology options',
                    'Begin measuring environmental impact of business operations'
                ],
                'Competent/Defined' => [
                    'Deploy comprehensive digital document management system',
                    'Implement energy-efficient IT equipment procurement policies',
                    'Create formal sustainability metrics and tracking',
                    'Develop a green digitalisation strategy'
                ],
                'Advanced/Strategic' => [
                    'Implement smart energy management systems',
                    'Create a circular economy approach to technology disposal',
                    'Use digital tools to optimise resource usage',
                    'Integrate sustainability metrics into business performance indicators'
                ],
                'Leader/Transformative' => [
                    'Deploy comprehensive sustainability management software',
                    'Utilise digital twins for resource optimisation',
                    'Implement advanced sustainability reporting',
                    'Lead industry sustainability initiatives through digital innovation',
                    'Create a comprehensive green digital transformation roadmap'
                ]
            ]
        ];

        return $recommendations[$sectionName][$level] ?? [];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Digital Maturity Assessment Results',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.digital-maturity-results',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $pdf = PDF::loadView('pdf.digital-maturity-results', [
            'categoryScores' => $this->categoryScores,
            'totalScore' => $this->totalScore,
            'businessName' => $this->businessName
        ]);

        return [
            Attachment::fromData(
                fn () => $pdf->output(),
                'digital-maturity-assessment-results.pdf'
            )
            ->withMime('application/pdf'),
        ];
    }
}
