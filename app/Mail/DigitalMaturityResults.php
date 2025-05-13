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

    public $categoryScores, $totalScore, $respondentName;

    public function __construct($categoryScores, $totalScore, $respondentName)
    {
        $this->categoryScores = $categoryScores;
        $this->totalScore = $totalScore;
        $this->respondentName = $respondentName;
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
            'respondentName' => $this->respondentName
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
