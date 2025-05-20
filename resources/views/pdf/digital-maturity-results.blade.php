<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 20px;
        }
        .score-section {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            page-break-inside: avoid;
            break-inside: avoid;
        }
        .overall-score {
            text-align: center;
            font-size: 24px;
            margin: 30px 0;
            padding: 30px;
            background-color: #f0fdf4;
            border: 2px solid #86efac;
            border-radius: 8px;
        }
        .maturity-level {
            font-weight: bold;
        }
        .recommendations {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }
        .recommendations ul {
            margin: 0;
            padding-left: 20px;
        }
        .recommendations li {
            margin-bottom: 8px;
            color: #4b5563;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo img {
            max-height: 80px;
            margin: 0 10px;
        }
        .progress-bar {
            width: 100%;
            height: 12px;
            background-color: #e5e7eb;
            border-radius: 6px;
            margin: 10px 0;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 6px;
        }
        .score-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 30px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 15px;
        }
        .score-value {
            font-size: 24px;
            font-weight: bold;
            color: #059669;
        }
        .level-text {
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }
        .level-leader { color: #059669; }
        .level-advanced { color: #10b981; }
        .level-competent { color: #3b82f6; }
        .level-developing { color: #f59e0b; }
        .level-novice { color: #ef4444; }
    </style>
</head>
<body>
    <div class="logo">
        <div style="display: flex; justify-content: center; align-items: center;">
            <img src="{{ public_path('images/logos/smedan-logo.png') }}" alt="SMEDAN Logo">
        </div>
    </div>

    <div class="header">
        <h1>Digital Maturity Assessment Results</h1>
        <p>Report for: {{ $businessName }}</p>
        <p>Date: {{ now()->format('F d, Y') }}</p>
    </div>

    @php
        $overallLevel = isset($totalScore['level']) ? $totalScore['level'] : 'Novice/Beginner';
        $overallColor = match($overallLevel) {
            'Leader/Transformative' => '#059669',
            'Advanced/Strategic' => '#10b981',
            'Competent/Defined' => '#3b82f6',
            'Developing/Emerging' => '#f59e0b',
            'Novice/Beginner' => '#ef4444',
            default => '#ef4444'
        };
    @endphp

    <div class="overall-score">
        <h2>Overall Digital Maturity</h2>
        <div style="margin: 20px 0;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <span style="font-size: 18px;">Overall Score:</span>
                <span style="font-size: 24px; font-weight: bold; color: {{ $overallColor }}">{{ $totalScore['percentage'] ?? 0 }}%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: {{ $totalScore['percentage'] ?? 0 }}%; background-color: {{ $overallColor }}"></div>
            </div>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <span style="font-size: 18px;">Maturity Level:</span>
            <span style="font-size: 24px; font-weight: bold; color: {{ $overallColor }}; margin-left: 10px;">{{ $overallLevel }}</span>
        </div>
    </div>

    <div class="score-grid">
        @foreach($categoryScores as $section => $score)
            @php
                $level = isset($score['level']) ? $score['level'] : 'Novice/Beginner';
                $sectionColor = match($level) {
                    'Leader/Transformative' => '#059669',
                    'Advanced/Strategic' => '#10b981',
                    'Competent/Defined' => '#3b82f6',
                    'Developing/Emerging' => '#f59e0b',
                    'Novice/Beginner' => '#ef4444',
                    default => '#ef4444'
                };
            @endphp
            <div class="score-section">
                <h3 class="section-title">{{ $section }}</h3>
                <div style="margin-bottom: 15px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <span>Score: {{ $score['score'] ?? 0 }} / {{ $score['max'] ?? 0 }}</span>
                        <span style="font-weight: bold; color: {{ $sectionColor }}">{{ $score['percentage'] ?? 0 }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $score['percentage'] ?? 0 }}%; background-color: {{ $sectionColor }}"></div>
                    </div>
                </div>
                <p class="level-text" style="color: {{ $sectionColor }}">Maturity Level: {{ $level }}</p>
                
                @if($section !== 'Validation Section')
                    <div class="recommendations">
                        <h4 style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">Recommendations:</h4>
                        <ul>
                            @foreach($score['recommendations'] ?? [] as $recommendation)
                                <li>{{ $recommendation }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="footer">
        <p>This report was generated automatically by the Digital Maturity Assessment System.</p>
        <p>© {{ date('Y') }} Digital Maturity Assessment. All rights reserved.</p>
        <div style="margin-top: 20px;">
            <img src="{{ public_path('images/partners/partner-logos.png') }}" alt="Partner Logo">
        </div>
    </div>
</body>
</html> 