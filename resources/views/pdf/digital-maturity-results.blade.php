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
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 20px;
        }
        .score-section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .overall-score {
            text-align: center;
            font-size: 24px;
            margin: 30px 0;
            padding: 20px;
            background-color: #e9ecef;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .maturity-level {
            font-weight: bold;
            color: #0056b3;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
        }
    </style>
</head>
<body>
    <div class="logo">
        <div style="display: flex; justify-content: center; align-items: center; gap: 20px;">
            <img src="{{ public_path('images/logos/smedan-logo.png') }}" alt="SMEDAN Logo" style="max-height: 80px;">
            <img src="{{ public_path('images/partners/partner-logos.png') }}" alt="Partner Logo" style="max-height: 80px;">
        </div>
    </div>

    <div class="header">
        <h1>Digital Maturity Assessment Results</h1>
        <p>Report for: {{ $respondentName }}</p>
        <p>Date: {{ now()->format('F d, Y') }}</p>
    </div>

    <div class="overall-score">
        <h2>Overall Score: {{ $totalScore['percentage'] }}%</h2>
        <p>Your Digital Maturity Level: <span class="maturity-level">{{ $totalScore['level'] }}</span></p>
    </div>

    <h3>Section Scores:</h3>
    @foreach($categoryScores as $section => $score)
        <div class="score-section">
            <h4>{{ $section }}</h4>
            <p>Score: {{ $score['percentage'] }}%</p>
            <p>Points: {{ $score['score'] }}/{{ $score['max'] }}</p>
        </div>
    @endforeach

    <div class="footer">
        <p>This report was generated automatically by the Digital Maturity Assessment System.</p>
        <p>© {{ date('Y') }} Digital Maturity Assessment. All rights reserved.</p>
    </div>
</body>
</html> 